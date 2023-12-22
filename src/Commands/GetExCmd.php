<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GetExCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\StringCmd;

    private $options = [
        'EX', 'PX', 'EXAT', 'PXAT', 'PERSIST'
    ];

    private function rng_option(&$opt) {
        $type = $this->options[array_rand($this->options)];

        if ($type == 'PERSIST') {
            $opt[] = 'PERSIST';
            return;
        }

        if ($type == 'EX' || $type == 'PX') {
            $val = rand(1, 60) * ($type == 'PX' ? 1000 : 1);
        } else if ($type == 'EXAT' || $type == 'PXAT') {
            $val = (time() + rand(1, 60)) * ($type == 'PXAT' ? 1000 : 1);
        }

        $opt[$type] = $val;
    }

    public function args(): array {
        $args = [$this->rng_key()];

        if ($this->rng_choice()) {
            $options = [];

            if ($this->rng_choice()) {
                $this->rng_option($options);
            }

            $args[] = $options;
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
