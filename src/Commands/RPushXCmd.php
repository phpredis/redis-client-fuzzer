<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class RPushXCmd extends KeyValCmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;
}
