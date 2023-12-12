<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class RPushCmd extends MMemCmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;
}
