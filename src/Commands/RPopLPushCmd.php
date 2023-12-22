<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class RPopLPushCmd extends KeyKeyCmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;
}
