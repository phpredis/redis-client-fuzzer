<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SetNXCmd extends KeyValCmd {
    use Traits\StringCmd;
    use Traits\WriteCmd;
}
