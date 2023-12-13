<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SRemCmd extends KeyNMemsCmd {
    use Traits\WriteCmd;
    use Traits\SetCmd;
}
