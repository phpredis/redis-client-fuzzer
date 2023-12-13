<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/Context.php';

abstract class Cmd {
    protected $context;
    private $cmd_name = NULL;

    public const READ_CMD  = 1;
    public const WRITE_CMD = 2;
    public const DEL_CMD   = 4;
    public const FLUSH_CMD = 8;

    public const ANY_TYPE = [
        'num', 'geo', 'string', 'list', 'hash', 'set', 'stream', 'zset'
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

    public function get_mem(): string {
        return sprintf("%s:%d", $this->mem_type(), rand(0, $this->context->mems() - 1));
    }

    public function get_key(): string {
        return sprintf("%s:%d", $this->key_type(), rand(0, $this->context->keys() - 1));
    }

    public function get_val(): mixed {
        if ($this->context->serialize()) {
            return [uniqid(), [1, 2, 3, [uniqid()]]];
        } else {
            return uniqid();
        }
    }

    public function get_keys() {
        $res = [];

        for ($i = 0; $i < rand(1, $this->context->keys() - 1); $i++) {
            $res[] = $this->get_key();
        }

        return $res;
    }

    public function get_mems() {
        $res = [];

        for ($i = 0; $i < rand(1, $this->context->mems() - 1); $i++) {
            $res[] = $this->get_mem();
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

    public function exec($client): mixed {
        $args = $this->args();
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
