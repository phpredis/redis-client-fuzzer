<?php

namespace Phpredis\RedisClientFuzzer;

require_once __DIR__ . '/../vendor/autoload.php';

use Phpredis\RedisClientFuzzer\CmdLoader;
use Phpredis\RedisClientFuzzer\Stats;

$opt = getopt('', [
    'class:', 'host:', 'port:', 'include:', 'exclude:', 'seed:', 'dump', 'exit-on-error'
]);

$host = $opt['host'] ?? 'localhost';
$port = $opt['port'] ?? 7000;
$include = array_filter(explode(',', $opt['include'] ?? ''));
$exclude = array_filter(explode(',', $opt['exclude'] ?? ''));
$seed = $opt['seed'] ?? hrtime(true);
$class = strtolower($opt['class'] ?? 'relay');
$dump = isset($opt['dump']);
$exit_on_error = isset($opt['exit-on-error']);

$client = new \Relay\Relay($host, $port);
$cluster = $client->rawCommand('cluster', 'info') !== false;

if ($cluster) {
    if ($class != 'redis') {
        $client = new \Relay\Cluster(NULL, ["$host:$port"]);
    } else {
        $client = new \RedisCluster(NULL, ["$host:$port"]);
    }
} else {
    if ($class != 'redis') {
        $client = new \Relay\Relay($host, $port);
    } else {
        $client = new \Redis;
        $client->connect($host, $port);
    }
}

$context = new Commands\Context(100, 100, 0, .1, .1, .1, 0, false, $dump, 10);
$loader = new CmdLoader;


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

if ( ! $cmds) {
    fprintf(STDERR, "Error:  No commands selected, aborting!\n");
    exit(1);
}

echo "    Class: " . get_class($client) . "\n";
echo "Seed Node: $host:$port\n";
echo "  Exclude: " . ($opt['exclude'] ?? '') . "\n";
echo "  Include: " . ($opt['include'] ?? '') . "\n";
echo " RNG Seed: " . $seed . "\n";
echo "  Cluster: " . ($cluster ? 'yes' : 'no') . "\n";
echo "     CMDS: " . implode(',', array_keys($cmds)) . "\n";

srand($seed);

$returns = [];
$st = microtime(true);

while (true) {
    $obj = $cmds[array_rand($cmds)];

    $cmdname = $obj->cmd();

    $res = $obj->exec($client);
    if ($exit_on_error && $client->getLastError()) {
        fprintf(STDERR, "Error({$obj->cmd()}): {$client->getLastError()}\n");
        exit(1);
    }

    if ( ! isset($returns[$cmdname]))
        $returns[$cmdname] = new Stats($cmdname);
    $returns[$cmdname]->inc($res, $client->getLastError());
    $client->clearLastError();

    if (($et = microtime(true)) - $st > 1.0) {
        system('clear');
        ksort($returns);
        $stats = array_map(function ($v) { return $v->as_array(); }, $returns);
        $table = Stats::get_table($stats);
        $table->display();
        $st = $et;
    }
}
