<?php

namespace Phpredis\RedisClientFuzzer;
use jc21\CliTable;

class Stats {
    public $cmd;
    public $count = 0;
    public $false = 0;
    public $errors = 0;
    public $true = 0;
    public $int = 0;
    public $null = 0;
    public $string = 0;
    public $strlen = 0;
    public $elements = 0;

    public function __construct($cmd) {
        $this->cmd = $cmd;
    }

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
        } else if (is_array($res)) {
            $this->elements += count($res);
        } else if (is_string($res)) {
            $this->string++;
            $this->strlen += strlen($res);
        }
    }

//    public function stats_string() {
//        $arr = [
//            'count' => $this->count,
//            'errors' => $this->errors,
//            'false' => $this->false,
//            'true' => $this->true,
//            'int' => $this->int,
//            'null' => $this->null,
//            'string' => $this->string,
//            'strlen' => $this->strlen,
//        ];
//
//        foreach ($arr as $k => $v) {
//            $eles[] = str_pad("$k = $v", 12);
//        }
//
//        return implode(', ', $eles);
//    }

//    public static function sum(array $stats): Stats {
//        $res = new Stats;
//
//        foreach ($stats as $obj) {
//            $res->count += $obj->count;
//            $res->errors += $obj->errors;
//            $res->false += $obj->false;
//            $res->true += $obj->true;
//            $res->int += $obj->int;
//            $res->null += $obj->null;
//            $res->strlen += $obj->strlen;
//        }
//
//        return $res;
//    }

    public function as_array(): array {
        return [
            'CMD' => $this->cmd,
            'COUNT' => $this->count,
            'ERRORS' => $this->errors,
            'FALSE' => $this->false,
            'TRUE' => $this->true,
            'INT' => $this->int,
            'NULL' => $this->null,
            'STRING' => $this->string,
            'STRLEN' => $this->strlen,
            'ELEMENTS' => $this->elements,
        ];
    }

    public static function get_table(array $data): CliTable {
        $table = new CliTable;

        $table->setTableColor('blue');
        $table->setHeaderColor('cyan');
        $table->addField('CMD', 'CMD');
        $table->addField('COUNT', 'COUNT');
        $table->addField('ERRORS', 'ERRORS');
        $table->addField('FALSE', 'FALSE');
        $table->addField('TRUE', 'TRUE');
        $table->addField('INT', 'INT');
        $table->addField('NULL', 'NULL');
        $table->addField('STRING', 'STRING');
        $table->addField('STRLEN', 'STRLEN');
        $table->addField('ELEMENTS', 'ELEMENTS');
        $table->injectData($data);

        return $table;
    }
}
