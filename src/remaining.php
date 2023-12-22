<?php

namespace Phpredis\RedisClientFuzzer;

require_once __DIR__ . '/../vendor/autoload.php';

use Phpredis\RedisClientFuzzer\CmdLoader;

$context = new Commands\Context(100, 10, 100, 0, .1, .1, .1, 0, false, false, 0);
$loader = new CmdLoader($context);

$redis = new \Redis; $redis->connect('localhost', 6379);
$all = array_flip(array_map(function ($v) { return strtoupper($v[0]); }, $redis->command()));
ksort($all);

foreach ($loader->commands() as $cmd) {
    $obj = new $cmd($context);
    $cmd = $obj->cmd();
    unset($all[$cmd]);
}

foreach (array_keys($all) as $cmd) {
    echo "$cmd\n";
}
