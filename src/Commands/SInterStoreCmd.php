<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SInterStoreCmd extends SInterDiffUnionCmd {
    use Traits\WriteCmd;
}

