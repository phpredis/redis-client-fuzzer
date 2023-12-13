<?php

namespace Phpredis\RedisClientFuzzer;

class Stats {
    public $count = 0;
    public $false = 0;
    public $true = 0;
    public $int = 0;
    public $null = 0;
    public $strlen = 0;

    public function inc($res) {
        $this->count++;

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
}
