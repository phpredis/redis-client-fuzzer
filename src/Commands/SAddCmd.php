<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SAddCmd extends MMemCmd {
    use Traits\WriteCmd;
    use Traits\SetCmd;
}
