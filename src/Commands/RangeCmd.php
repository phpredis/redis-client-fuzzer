<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class RangeCmd extends Cmd {
    use Traits\ReadCmd;

    protected function rng_range($max) {
        $min = $max * -1;

        // Generate two random numbers for start and end
        $start = rand($min, $max);
        $end = rand($min, $max);

        // Ensure that start is less than or equal to end
        // Swap if start is greater than end
        if ($start > $end) {
            list($start, $end) = array($end, $start);
        }

        // Special case handling (e.g., 0..-1, which means the whole range in Redis)
        if ($start == 0 && $end == -1) {
            // Optionally handle this case specially if needed
        }

        // Return the range in Redis format
        return [$start, $end];
    }
}
