<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SUnionCmd extends SInterDiffUnionCmd {
    use Traits\ReadCmd;
}
