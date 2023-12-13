<?php

namespace Phpredis\RedisClientFuzzer;

require_once __DIR__ . '/../vendor/autoload.php';

use Phpredis\RedisClientFuzzer\CmdLoader;
use Phpredis\RedisClientFuzzer\Stats;

$opt = getopt('', ['class:', 'host:', 'port:', 'include:', 'exclude:', 'seed:']);
$host = $opt['host'] ?? 'localhost';
$port = $opt['port'] ?? 7000;
$include = array_filter(explode(',', $opt['include'] ?? ''));
$exclude = array_filter(explode(',', $opt['exclude'] ?? ''));
$seed = $opt['seed'] ?? hrtime(true);
$class = $opt['class'] ?? 'relay';

$context = new Commands\Context(100, 100, 0, .1, .1, .1, 0, false);
$loader = new CmdLoader;

if ($class != 'redis') {
    $rc = new \Relay\Cluster(NULL, ["$host:$port"]);
} else {
    $rc = new RedisCluster(NULL, ["$host:$port"]);
}


$include = array_map(function ($v) { return trim(strtoupper($v)); }, $include);
$exclude = array_map(function ($v) { return trim(strtoupper($v)); }, $exclude);

$cmds = [];

foreach ($loader->commands() as $cmd) {
    $obj = new $cmd($context);
    if (array_search($obj->cmd(), $exclude) !== false) {
        continue;
    } else if ($include && array_search($obj->cmd(), $include) === false) {
        continue;
    }

    $cmds[$obj->cmd()] = $obj;
}

uasort($cmds, function ($a, $b) { return strcmp($a->cmd(), $b->cmd()); });

echo "    Class: " . get_class($rc) . "\n";
echo "Seed Node: $host:$port\n";
echo "  Exclude: " . ($opt['exclude'] ?? '') . "\n";
echo "  Include: " . ($opt['include'] ?? '') . "\n";
echo " RNG Seed: " . $seed . "\n";
echo "     CMDS: " . implode(',', array_keys($cmds)) . "\n";

srand($seed);

$counts = $returns = [];
$on = 0;
$st = microtime(true);

while (true) {
    $obj = $cmds[array_rand($cmds)];

    $cmdname = $obj->cmd();

    $res = $obj->exec($rc);
    if ($rc->getLastError())
        die($rc->getLastError() . "\n");

    if ( ! isset($returns[$cmdname]))
        $returns[$cmdname] = new Stats;
    $returns[$cmdname]->inc($res);

    if (($et = microtime(true)) - $st > 1.0) {
        printf("Total commands: %s\n", number_format(array_sum($counts)));
        foreach ($returns as $cmd => $stats) {
            echo str_pad($cmd, 15) . ' ' . $stats->stats_string() . "\n";
        }
        $st = $et;
    }

    $on++;
}
