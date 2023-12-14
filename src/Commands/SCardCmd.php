<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SCardCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\SetCmd;
}
