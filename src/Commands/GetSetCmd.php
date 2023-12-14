<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GetSetCmd extends KeyValCmd {
    use Traits\WriteCmd;
    use Traits\StringCmd;
}

