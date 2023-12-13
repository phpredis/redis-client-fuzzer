<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ExpireTimeCmd extends KeyCmd {
    use Traits\AnyType;
    use Traits\ReadCmd;
}
