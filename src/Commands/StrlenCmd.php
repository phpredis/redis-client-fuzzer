<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class StrlenCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\StringCmd;
}
