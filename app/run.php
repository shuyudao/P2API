<?php
/*
 * @Autor: 术与道
 * @email: shuyudao@gmail.com
 * @Date: 2020-04-09 04:11:59
 * @LastEditors: 术与道
 * @LastEditTime: 2020-04-09 23:26:06
 */
namespace app;

use Exception;

class Run{

    static function start($conf){

        $res = Doc::getApiFile($conf);

        \app\Output::out($res,$conf);
    }

    static function autoLoad($class)
    {
        $class = str_replace("\\","/",$class);
        $file = $class.".php";
        if(file_exists($file)){
            include $file;
        }else{
            throw new Exception("无法找到该文件:".$class);
            return false;
        }
    }

}