<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/Context.php';

use Phpredis\RedisClientFuzzer\Crc16;

abstract class Cmd {
    protected $context;
    private $cmd_name = NULL;

    private $keys_by_slot = NULL;

    public const READ_CMD  = 1;
    public const WRITE_CMD = 2;
    public const DEL_CMD   = 4;
    public const FLUSH_CMD = 8;

    public const ANY_TYPE = [
        'int', 'float', 'geo', 'string', 'list', 'hash', 'set', 'stream', 'zset'
    ];

    public function __construct(Context $context) {
        $this->context = $context;
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

    private function mem_type(): string {
        switch ($this->key_type()) {
            case 'string':
                return NULL;
            case 'list':
                return 'element';
            case 'hash':
                return 'field';
            case 'set':
            case 'zset':
                return 'member';
            default:
                die("Error:  Unknown key type '{$this->key_type()}'\n");
        }
    }

    function rng_float($min = 0, $max = 1) {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    public function get_key(int $id): string {
        return sprintf("%s:%d", $this->key_type(), $id);
    }

    public function get_mem(int $id): string {
        return sprintf("%s:%d", $this->mem_type(), $id);
    }

    public function rng_mem(): string {
        return $this->get_mem(rand(0, $this->context->mems() - 1));
    }

    public function rng_key(): string {
        return $this->get_key(rand(0, $this->context->keys() - 1));
    }

    public function get_val(): mixed {
        $dlen = $this->context->strlen() / 2;
        if ($dlen % 2 != 0)
            $dlen++;

        $data = bin2hex(random_bytes($dlen));
        if ( ! $this->context->serialize())
            return $data;
        else
            return str_split($data, $this->context->strlen() / 4);
    }

    public function rng_keys(): array {
        $res = [];

        $count = rand(1, $this->context->keys() - 1);
        $ids = range(0, $count - 1);

        for ($i = 0; $i < rand(1, $this->context->keys() - 1); $i++) {
            $res[] = $this->rng_key();
        }

        return $res;
    }

    private function calc_slot_keys(): array {
        $res = [];

        for ($i = 0; $i < $this->context->keys(); $i++) {
            $key = $this->get_key($i);
            $res[$this->get_slot($key)][] = $key;
        }

        return $res;
    }

    /* Return two keys that will live in the same slot */
    public function rng_slot_key_pair(): array {
        $key1 = $this->rng_key();
        $key2 = sprintf("{%s}-dst", $key1);
        $keys = [$key1, $key2];

        shuffle($keys);

        return $keys;
    }

    public function rng_slot_keys(): array {
        if ($this->keys_by_slot === NULL)
            $this->keys_by_slot = $this->calc_slot_keys();

        return $this->keys_by_slot[array_rand($this->keys_by_slot)];
    }

    private function get_slot($key) {
        return Crc16::hash($key) % 16384;
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
