<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZDiffStoreCmd extends KeyArrKeysCmd {
    use Traits\WriteCmd;
    use Traits\ZSetCmd;
}
