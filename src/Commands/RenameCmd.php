<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class RenameCmd extends KeyKeyCmd {
    use Traits\WriteCmd;
    use Traits\AnyType;
}
