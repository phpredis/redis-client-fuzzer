<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SetCmd extends KeyValCmd {
    use Traits\WriteCmd;
    use Traits\StringCmd;
}
