<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class ZRangeGenericCmd extends RangeCmd {
    use Traits\ReadCmd;
    use Traits\ZSetCmd;

    private function rng_opts(int $rng, &$bylex): array {
        $res = [];

        $byscore = $bylex = $withscores = false;

        if (($rng & (1 << 1)) !== 0) {
            $withscores = true;
            $res['WITHSCORES'] = true;
        } else if (($rng & (1 << 2)) !== 0) {
            $withscores = true;
            $res[] = 'WITHSCORES';
        }

        if (($rng & (1 << 4)) !==  0) {
            $res[] = 'BYSCORE';
            $byscore = true;
        } else if (!$this->cmd() == 'ZREVRANGE' && !$withscores && ($rng & (1 << 5)) !== 0) {
            $res[] = 'BYLEX';
            $bylex = true;
        }

        if (($byscore || $bylex) && ($rng & (1 << 3)) !== 0)
            $res['LIMIT'] = $this->rng_range($this->context->mems());

        return $res;
    }

    public function args(): array {
        $opt = NULL;
        $rng = rand();

        $bylex = false;
        if ($rng % 2 == 0)
            $opt = $this->rng_opts($rng, $bylex);

        if ($bylex) {
            // TODO:  Proper random range here
            list($s, $e) = ['a', 'z'];
        } else {
            list($s, $e) = $this->rng_range($this->context->mems());
        }

        if ($opt)
            return [$this->rng_key(), $s, $e, $opt];
        else
            return [$this->rng_key(), $s, $e];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
