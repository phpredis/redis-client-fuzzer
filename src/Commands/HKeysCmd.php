<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HKeysCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;
}
