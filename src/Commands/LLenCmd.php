<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LLenCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\ListCmd;
}
