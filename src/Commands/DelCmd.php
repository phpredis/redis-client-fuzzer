<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class DelCmd extends MKeyCmd {
    use Traits\DelCmd;
    use Traits\AnyType;
}
