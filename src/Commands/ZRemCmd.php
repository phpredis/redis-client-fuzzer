<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZRemCmd extends KeyNMemsCmd {
    use Traits\WriteCmd;
    use Traits\ZSetCmd;
}
