<?php

namespace Phpredis\RedisClientFuzzer;

class Stats {
    public $count = 0;
    public $false = 0;
    public $errors = 0;
    public $true = 0;
    public $int = 0;
    public $null = 0;
    public $strlen = 0;

    public function inc($res, $error) {
        $this->count++;
        if ($error)
            $this->errors++;

        if ($res === false) {
            $this->false++;
        } else if ($res === true) {
            $this->true++;
        } else if ($res === NULL) {
            $this->null++;
        } else if (is_int($res)) {
            $this->int++;
        } else {
            $this->strlen += strlen(serialize($res));
        }
    }

    public function stats_string() {
        $arr = [
            'count' => $this->count,
            'errors' => $this->errors,
            'false' => $this->false,
            'true' => $this->true,
            'int' => $this->int,
            'null' => $this->null,
            'strlen' => $this->strlen,
        ];

        foreach ($arr as $k => $v) {
            $eles[] = str_pad("$k = $v", 12);
        }

        return implode(', ', $eles);
    }

    public static function sum(array $stats): Stats {
        $res = new Stats;

        foreach ($stats as $obj) {
            $res->count += $obj->count;
            $res->errors += $obj->errors;
            $res->false += $obj->false;
            $res->true += $obj->true;
            $res->int += $obj->int;
            $res->null += $obj->null;
            $res->strlen += $obj->strlen;
        }

        return $res;
    }
}

