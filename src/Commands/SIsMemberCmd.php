<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SIsMemberCmd extends KeyMemCmd {
    use Traits\ReadCmd;
    use Traits\SetCmd;
}
