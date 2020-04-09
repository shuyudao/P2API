<?php
/*
 * @Autor: 术与道
 * @email: shuyudao@gmail.com
 * @Date: 2020-04-09 04:18:42
 * @LastEditors: 术与道
 * @LastEditTime: 2020-04-09 23:06:32
 */
namespace app;

use Exception;

//注释解析
 class Doc{
    
    static $result = array();

    /**
     * @description: 读取配置中含注释的类
     * @param {type} 
     * @return: 结果数组
     * @author: 术与道
     */
    static function getApiFile($conf){
        foreach($conf['class'] as $temp){
            $tRes = Doc::docParse($temp);
            $result[] = $tRes;
        }
        return $result;
    }


    /**
     * @description: 类中方法注释内容解析
     * @param {type} 
     * @return: 参数数组
     * @author: 术与道
     */
    static function docParse($class){
        
        //注释参数
        $data = array();

        $reflection = new \ReflectionClass($class);

        //取得方法
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC + \ReflectionMethod::IS_PROTECTED);

        foreach ($methods as $method) {
            $temp_data = array();//方法注释内容
            $doc = $method->getDocComment();
            $arr = explode(PHP_EOL,$doc); //注释分割
            
            foreach($arr as $p){
                $p = trim($p);
                $isMatch = preg_match("/^\* @\S+ */",$p); //匹配配置有效注释行内容
                if($isMatch){
                    $p = preg_replace("/^\* @/","",$p,1);//去除其它字符
                    $temp_arr = explode(" ",$p,2);//分割key、value
                    if(isset($temp_arr[1])){
                        $temp_data[$temp_arr[0]] = $temp_arr[1];//
                    }else{
                        throw new Exception($class."下".$method->getName."注释中出现未赋值错误");
                        die;
                    }
                    
                }
            }

            //默认参数值
            $temp_data["parameter"] = isset($temp_data["parameter"])?$temp_data["parameter"]:[];
            $temp_data["returnParameter"] = isset($temp_data["returnParameter"])?$temp_data["returnParameter"]:[];
            $temp_data["response"] = isset($temp_data["response"])?$temp_data["response"]:"暂无示例";
            $temp_data["tips"] = isset($temp_data["tips"])?$temp_data["tips"]:"无";

            $data[] = $temp_data;//
        }
        return $data;
    }

 }