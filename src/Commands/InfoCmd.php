<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class InfoCmd extends Cmd {
    use Traits\AnyType;
    use Traits\ReadCmd;

    private $sections = [
        'server',
        'clients',
        'memory',
        'persistence',
        'stats',
        'replication',
        'cpu',
        'modules',
        'errorstats',
        'cluster',
        'keyspace',
    ];

    public function args(): array {
        $args = [];

        while ($this->rng_choice())
            $args[] = $this->sections[array_rand($this->sections)];

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }

    public function cluster_args(): array {
        $args = [$this->rng_key()];

        while ($this->rng_choice())
            $args[] = $this->sections[array_rand($this->sections)];

        return $args;
    }
}
