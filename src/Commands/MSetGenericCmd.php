<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class MSetGenericCmd extends Cmd {
    use Traits\StringCmd;
    use Traits\WriteCmd;

    public function rng_key_vals(): array {
        $kv = [];
        foreach ($this->rng_keys() as $key) {
            $kv[$key] = $this->rng_val();
        }
        return $kv;
    }

    public function args(): array {
        return [$this->rng_key_vals()];
    }

    public function raw_args(): array {
        return $this->rng_key_vals();
    }
}
