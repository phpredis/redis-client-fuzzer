<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class MGetCmd extends MKeyCmd {
    use Traits\ReadCmd;
    use Traits\StringCmd;
}
