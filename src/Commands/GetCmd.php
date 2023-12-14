<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GetCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\StringCmd;
}
