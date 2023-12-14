<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HLenCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;
}
