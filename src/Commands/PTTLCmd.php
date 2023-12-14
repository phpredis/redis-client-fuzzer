<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class PTTLCmd extends KeyCmd {
    use Traits\AnyType;
    use Traits\ReadCmd;
}
