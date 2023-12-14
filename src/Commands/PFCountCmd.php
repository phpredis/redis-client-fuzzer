<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class PFCountCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\HLLType;
}
