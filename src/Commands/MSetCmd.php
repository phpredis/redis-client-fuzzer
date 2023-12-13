<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class MSetCmd extends Cmd {
    use Traits\StringCmd;
    use Traits\WriteCmd;

    public function get_key_vals(): array {
        $kv = [];
        foreach ($this->rng_keys() as $key) {
            $kv[$key] = $this->get_val();
        }
        return $kv;
    }

    public function args(): array {
        return [$this->get_key_vals()];
    }

    public function raw_args(): array {
        return $this->get_key_vals();
    }
}
