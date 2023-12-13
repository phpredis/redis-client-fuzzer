<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZCardCmd extends KeyCmd {
    use Traits\ZSetCmd;
    use Traits\ReadCmd;
}
