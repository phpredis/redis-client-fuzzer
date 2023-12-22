<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LPushXCmd extends MMemCmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;
}

