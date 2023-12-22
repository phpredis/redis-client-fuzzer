<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SUnionStoreCmd extends SInterDiffUnionCmd {
    use Traits\WriteCmd;
}
