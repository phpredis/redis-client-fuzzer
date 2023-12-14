<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HGetAllCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;
}
