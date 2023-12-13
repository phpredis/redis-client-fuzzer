<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class RangeCmd extends Cmd {
    use Traits\ReadCmd;

    protected function rng_range() {
        // Define the range for the random numbers
        // Assuming -100 to 100 as an example range
        $min = $this->context->mems() * -1;
        $max = $this->context->mems();

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
