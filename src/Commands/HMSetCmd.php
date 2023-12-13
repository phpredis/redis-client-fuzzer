<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HMSetCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\HashCmd;

    protected function key_vals(): array {
        $kv = [];
        foreach ($this->get_mems() as $mem) {
            $kv[$mem] = uniqid();
        }
        return $kv;
    }

    public function args(): array {
        return [$this->get_key(), $this->key_vals()];
    }

    public function raw_args(): array {
        return [$this->get_key(), ...$this->key_vals()];
    }
}