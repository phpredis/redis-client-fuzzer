<?php

namespace Phpredis\RedisClientFuzzer;

class CmdLoader {
    private array $commands;

    public function __construct(Commands\Context $context) {
        $this->commands = self::load($context);
    }

    private function find_pattern(array $needles, string $haystack): bool {
        foreach ($needles as $needle) {
            if (fnmatch($needle, $haystack))
                return true;
        }

        return false;
    }

    public function filter(array $include, array $exclude): int {
        $filtered = 0;

        foreach ($this->commands as $cmd => $obj) {
            if (($include && ! $this->find_pattern($include, $cmd)) ||
                $this->find_pattern($exclude, $cmd))
            {
                unset($this->commands[$cmd]);
                $filtered++;
            }
        }

        return $filtered;
    }

    private static function load(Commands\Context $context) {
        $commands = [];

        $path = __DIR__ . '/Commands';

        foreach (new \DirectoryIterator($path) as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $class_name = $file->getBasename('.php');
                $full_name  = "\\Phpredis\\RedisClientFuzzer\\Commands\\$class_name";
                $reflector = new \ReflectionClass($full_name);
                if ($reflector->isAbstract())
                    continue;


                if (class_exists($full_name) &&
                    is_subclass_of($full_name, 'Phpredis\\RedisClientFuzzer\\Commands\Cmd'))
                {
                    $obj = new $full_name($context);
                    $commands[$obj->cmd()] = $obj;
                }
            }
        }

        uasort($commands, function ($a, $b) { return strcmp($a->cmd(), $b->cmd()); });

        return $commands;
    }

    public function commands(): array {
        return $this->commands;
    }

    public function rng_cmd(): Commands\Cmd {
        return $this->commands[array_rand($this->commands)];
    }
}
