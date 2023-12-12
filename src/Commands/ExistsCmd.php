<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ExistsCmd extends MKeyCmd {
    use Traits\ReadCmd;
    use Traits\AnyType;
}
