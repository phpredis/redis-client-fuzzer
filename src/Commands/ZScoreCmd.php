<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZScoreCmd extends KeyMemCmd {
    use Traits\ReadCmd;
    use Traits\ZSetCmd;
}
