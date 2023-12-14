<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class StrLenCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\StringCmd;
}
