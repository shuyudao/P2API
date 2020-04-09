<?php
/*
 * @Autor: 术与道
 * @email: shuyudao@gmail.com
 * @Date: 2020-04-09 04:00:56
 * @LastEditors: 术与道
 * @LastEditTime: 2020-04-10 01:15:57
 */
include "app/run.php";
define("P2ROOT",dirname(__FILE__));
ini_set("display_error","On");

spl_autoload_register("\app\Run::autoLoad");

class P2Api{

    private $config;

    function __construct($config){
        $this->$config = $config;
    }

    public function run()
    {
        //限制cli下执行
        if('cli'==PHP_SAPI){
            \app\Run::start($this->config);
        }
    }

}
