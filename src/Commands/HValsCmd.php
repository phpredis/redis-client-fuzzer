<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HValsCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;
}
