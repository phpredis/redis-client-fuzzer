<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SMIsMemberCmd extends KeyNMemsCmd {
    use Traits\ReadCmd;
    use Traits\SetCmd;
}
