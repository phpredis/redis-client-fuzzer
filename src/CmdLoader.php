<?php

namespace Phpredis\RedisClientFuzzer;

class CmdLoader {
    public static function commands() {
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
                    $commands[] = $full_name;
                }
            }
        }

        return $commands;
    }
}
