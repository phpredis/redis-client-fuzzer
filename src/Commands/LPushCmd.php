<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LPushCmd extends MMemCmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;
}
