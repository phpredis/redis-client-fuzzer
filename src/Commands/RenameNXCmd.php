<?php

namespace Phpredis\RedisCLientFuzzer\Commands;

class RenameNXCmd extends KeyKeyCmd {
    use Traits\WriteCmd;
    use Traits\AnyType;
}
