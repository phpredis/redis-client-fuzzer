<?php

namespace Phpredis\RedisClientFuzzer\Commands;

use Phpredis\RedisClientFuzzer\Crc16;

abstract class Cmd {
    public const READ_CMD  = 1;
    public const WRITE_CMD = 2;
    public const DEL_CMD   = 4;
    public const FLUSH_CMD = 8;
    public const BLOCKING_CMD = 16;

    protected $context;
    private $cmd_name = NULL;
    private $keys_by_slot = NULL;
    private int $shard;

    private int $rng;
    private int $rng_bit;

    public const ANY_TYPE = [
        'hll', 'int', 'float', 'geo', 'string', 'list', 'hash', 'set', 'stream', 'zset'
    ];

    protected function gen_shard(): int {
        return rand(0, $this->context->shards() - 1);
    }

    public function __construct(Context $context) {
        $this->context = $context;
        $this->shard = $this->gen_shard();
        $this->rng = mt_rand();
        $this->rng_bit = 0;
    }

    public function rng(): int {
        if ($this->rng === NULL)
            $this->rng = mt_rand();

        return $this->rng;
    }

    public function rng_max(): int {
        return mt_getrandmax();
    }

    public function rng_choice(): bool {
        if ($this->rng === NULL || ($this->rng_bit && $this->rng_bit % 32 == 0))
            $this->rng = mt_rand();

        return (($this->rng & (1 << ($this->rng_bit++ % 32))) != 0);
    }

    public function wrong_type() {
        $types = ['string' => 1, 'list' => 1, 'hash' => 1, 'set' => 1, 'zset' => 1];
        if ( ! is_array($this->type()))
            unset($types[$this->type()]);
        return array_rand($types);
    }

    protected function key_type(): string {
        if ($this->context->rng_wrongtype()) {
            return $this->wrong_type();
        } else {
            $type = $this->type();
            if (is_array($type)) {
                return $type[array_rand($type)];
            } else {
                return $type;
            }
        }
    }

    protected function mem_type(): string {
        switch ($this->key_type()) {
            case 'string':
                return NULL;
            case 'list':
            case 'hll':
                return 'element';
            case 'hash':
                return 'field';
            case 'set':
            case 'zset':
                return 'member';
            case 'geo':
                return 'position';
            default:
                die("Error:  Unknown key type '{$this->key_type()}'\n");
        }
    }

    public function rng_lex_range(): array {
        $base = $this->mem_type();

        $lo = rand(0, $this->context->mems());
        $hi = $lo + rand(0, $this->context->mems() - $lo);

        return [
            ($this->rng_choice() ? '[' : '(') . "$base:$lo",
            ($this->rng_choice() ? '[' : '(') . "$base:$hi"
        ];
    }

    function rng_float($min = 0, $max = 1) {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    public function get_key(int $id, bool $anyshard = false): string {
        $shard = $anyshard ? rand(0, $this->context->shards() - 1) : $this->shard;
        return sprintf("{%s:%d}:%d", $this->key_type(), $shard, $id);
    }

    public function get_mem(int $id): string {
        return sprintf("%s:%d", $this->mem_type(), $id);
    }

    public function rng_mem(): string {
        return $this->get_mem(rand(0, $this->context->mems() - 1));
    }

    public function rng_key(bool $anyshard = false): string {
        return $this->get_key(rand(0, $this->context->keys() - 1), $anyshard);
    }

    public function rng_val(): mixed {
        $dlen = $this->context->strlen() / 2;
        if ($dlen % 2 != 0)
            $dlen++;

        $data = bin2hex(random_bytes($dlen));
        if ( ! $this->context->serialize())
            return $data;
        else
            return str_split($data, $this->context->strlen() / 4);
    }

    public function rng_keys(bool $anyshard = false): array {
        $res = [];

        $count = rand(1, $this->context->keys() - 1);
        $ids = range(0, $count - 1);

        for ($i = 0; $i < rand(1, $this->context->keys() - 1); $i++) {
            $res[] = $this->rng_key($anyshard);
        }

        return $res;
    }

    public function rng_xslot_keys(): array {
        return $this->rng_keys(true);
    }

    public function rng_mems() {
        $res = [];

        for ($i = 0; $i < rand(1, $this->context->mems() - 1); $i++) {
            $res[] = $this->rng_mem();
        }

        return $res;
    }

    public function cmd(): string {
        if ($this->cmd_name === NULL) {
            $full = get_class($this);
            $className = substr($full, strrpos($full, '\\') + 1);
            $this->cmd_name = strtoupper(substr($className, 0, -3));
        }

        return $this->cmd_name;
    }

    protected function is_cluster($client) {
        return ($client InstanceOf \Relay\Cluster) ||
               ($client InstanceOf \RedisCluster);
    }

    public function exec($client): mixed {
        $args = $this->is_cluster($client) ? $this->cluster_args() : $this->args();

        $this->shard = $this->gen_shard();

        if ($this->context->dump()) {
            printf("call_user_func_array([%s, '%s'], %s);\n",
                   '$rc', $this->cmd(), var_export($args, true));
        }

        return call_user_func_array([$client, $this->cmd()], $args);
    }

    public function raw_exec($client): mixed {
        return call_user_func_array([$client, $this->cmd()], $this->raw_args());
    }

    abstract public function flags(): int;
    abstract public function type(): mixed;
    abstract public function args(): array;
    abstract public function raw_args(): array;

    public function cluster_args(): array {
        return $this->args();
    }

    public function cluster_raw_args(): array {
        return $this->cluster_args();
    }
}
