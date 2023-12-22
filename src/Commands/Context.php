<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class Context {
    private int $keys;
    private int $shards;
    private int $mems;
    private int $strlen;
    private bool $serialize;
    private array $knobs;
    private bool $dump;

    public function __construct(int $keys, int $shards, int $mems, float $wrongtype, float $write,
                                float $del, float $flush, float $raw, bool $serialize,
                                bool $dump, int $strlen)
    {
        $this->keys = $keys;
        $this->shards = $shards;
        $this->mems = $mems;
        $this->serialize = $serialize;
        $this->dump = $dump;
        $this->strlen = max(10, $strlen);

        if ($this->strlen % 2 != 0)
            $this->strlen++;

        $this->knobs = [
            'wrongtype' => $wrongtype,
            'write' => $write,
            'del' => $del,
            'flush' => $flush,
            'raw' => $raw,
        ];
    }

    public function dump(): bool {
        return $this->dump;
    }

    public function keys(): int {
        return $this->keys;
    }

    public function shards(): int {
        return $this->shards;
    }

    public function mems(): int {
        return $this->mems;
    }

    public function serialize(): bool {
        return $this->serialize;
    }

    public function strlen(): int {
        return $this->strlen;
    }

    public function rng_pick(string|float $weight): bool {
        if (is_string($weight)) {
            if ( ! isset($this->knobs[$weight]))
                die("Error:  Unknown weighted property '$weight'\n");
            $weight = $this->knobs[$weight];
        }

        $weight = max(0, min($weight, 1));
        $random = mt_rand() / mt_getrandmax();
        return $random < $weight;
    }

    public function rng_wrongtype(): bool {
        return $this->rng_pick('wrongtype');
    }

    public function rng_flags(array $weights): int {
        $flags = 0;

        foreach ($weights as $weight => $flag) {
            $flags |= $this->rng_pick($weight) ? $flag : 0;
        }

        return $flags;
    }
}
