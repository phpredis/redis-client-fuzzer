<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZMScoreCmd extends KeyNMemsCmd {
    use Traits\ReadCmd;
    use Traits\ZSetCmd;
}
