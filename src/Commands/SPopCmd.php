<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SPopCmd extends KeyOptCountCmd {
    use Traits\SetCmd;
    use Traits\WriteCmd;
}
