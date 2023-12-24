<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GeoHashCmd extends KeyNMemsCmd {
    use Traits\ReadCmd;
    use Traits\GeoCmd;
}
