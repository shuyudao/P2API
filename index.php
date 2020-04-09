<?php
/*
 * @Autor: 术与道
 * @email: shuyudao@gmail.com
 * @Date: 2020-04-09 04:00:56
 * @LastEditors: 术与道
 * @LastEditTime: 2020-04-10 00:07:15
 */
include "app/run.php";
define("P2ROOT",dirname(__FILE__));
ini_set("display_error","On");

spl_autoload_register("\app\Run::autoLoad");

$config = array(
    "class"=>[
        "app\\test\\test",
        "app\\test\\RKK"
    ],//注释的类
    "preface"=>["APP接口","这是接口文件序言内容"],
    "outpath"=>"C:\Users\sad\Downloads\xxxx", //目录
    //"template"=>"C:\Users\sad\Downloads\xxxx\a.txt" //自定义模板文件位置 ,如果配置了,将会替换{{content}}为JSON字符串，不会输出官方默认的
);

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
