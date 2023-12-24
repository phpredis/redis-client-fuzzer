<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GeoRadiusCmd extends GeoCmd {
    use Traits\ReadCmd;
    use Traits\GeoCmd;

    private $units = ['M', 'KM', 'MI', 'FT'];

    protected function rng_radius($unit): int {
        $ranges = [
            'MI' => [1, 5000],    'KM' => [1, 10000],
            'M' => [100, 1000000], 'FT' => [500, 3000000]
        ];

        list($lo, $hi) = $ranges[$unit];
        return rand($lo, $hi);
    }

    public function args(): array {
        $unit = $this->units[array_rand($this->units)];

        $args = [
            $this->rng_key(),
            $this->rng_longitude(),
            $this->rng_latitude(),
            $this->rng_radius($unit),
            $unit,
        ];

        if ($this->rng_choice()) {
            $opts = [];
            if ($this->rng_choice())
                $opts[] = 'WITHCOORD';
            if ($this->rng_choice())
                $opts[] = 'WITHDIST';
            if ($this->rng_choice())
                $opts[] = 'WITHHASH';
            if ($this->rng_choice())
                $opts[] = 'ASC';
            else if ($this->rng_choice())
                $opts[] = 'DESC';

            if ($this->rng_choice()) {
                if ($this->rng_choice()) {
                    $opts['COUNT'] = [rand(1, 100), $this->rng_choice()];
                } else {
                    $opts['COUNT'] = rand(1, 100);
                }
            }

            $args[] = $opts;
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
