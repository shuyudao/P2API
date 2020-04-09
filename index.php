<?php
/*
 * @Autor: 术与道
 * @email: shuyudao@gmail.com
 * @Date: 2020-04-09 04:00:56
 * @LastEditors: 术与道
 * @LastEditTime: 2020-04-10 03:32:25
 */
include "app/run.php";
include "config.php";
define("P2ROOT",dirname(__FILE__));
ini_set("display_error","On");

spl_autoload_register("\app\Run::autoLoad");

class P2Api{

    private $config;

    function __construct($config){
        $this->config = $config;
    }

    public function run()
    {
        //限制cli下执行
        if('cli'==PHP_SAPI){
            \app\Run::start($this->config);
        }
    }

}

$p2api = new P2Api($config);
$p2api->run();