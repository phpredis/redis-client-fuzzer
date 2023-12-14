<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SMembersCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\SetCmd;
}
