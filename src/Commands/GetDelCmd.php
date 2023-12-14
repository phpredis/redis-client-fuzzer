<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GetDelCmd extends KeyCmd {
    use Traits\StringCmd;
    use Traits\WriteCmd;
}
