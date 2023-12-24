<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GeoPosCmd extends KeyNMemsCmd {
    use Traits\ReadCmd;
    use Traits\GeoCmd;
}
