<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class ZRangeGenericCmd extends RangeCmd {
    use Traits\ReadCmd;
    use Traits\ZSetCmd;

    private function rng_opts(int $rng): array {
        $res = [];

        if (($rng & (1 << 1)) !== 0)
            $res['WITHSCORES'] = true;
        else if (($rng & (1 << 2)) !== 0)
            $res[] = 'WITHSCORES';

        if (($rng & (1 << 3)) !== 0)
            $res['LIMIT'] = $this->rng_range($this->context->mems());
        if (($rng & (1 << 4)) !==  0)
            $res[] = 'BYSCORE';
        else if (($rng & (1 << 5)) !== 0)
            $res[] = 'BYLEX';

        return $res;
    }

    public function args(): array {
        $opt = NULL;
        $rng = rand();

        list($s, $e) = $this->rng_range($this->context->mems());

        if ($rng % 2 == 0)
            $opt = $this->rng_opts($rng);

        if ($opt)
            return [$this->rng_key(), $s, $e, $opt];
        else
            return [$this->rng_key(), $s, $e];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
