<?php
/*
 * @Autor: 术与道
 * @email: shuyudao@gmail.com
 * @Date: 2020-04-09 15:52:19
 * @LastEditors: 术与道
 * @LastEditTime: 2020-04-10 00:03:16
 */
namespace app;

use Exception;

//生成输出
class Output{
    
    /**
     * @description: API生成接口
     * @param {type} 
     * @return: 
     * @author: 术与道
     */
    static public function out($data,$conf)
    {
        $outData = array(); //输出数据

        foreach($data as $class){
            foreach($class as $temp){
                $tk = explode(" ",$temp['des']);
                if(count($tk)==2&&$tk[1]!=""){
                    $temp['des'] = $tk[1];
                    $outData[$tk[0]][$tk[1]] = $temp;
                }else{
                    $outData[$temp['des']] = $temp;
                }
            }
        }

        self::end($outData,$conf);
        
    }

    /**
     * @description: 多层级接口HTML
     * @param {type} 
     * @return: 
     * @author: 术与道
     */
    static public function multistage($name,$t){
        $key = array_keys($t);
        
        $html = '<li>
        <a href="#">
            <span class="glyphicon glyphicon-duplicate f12" aria-hidden="true"></span>
            <span>'.$name.'</span>
            <span class="glyphicon f12 fr glyphicon-menu-down" aria-hidden="true"></span>
        </a>
        <ul class="nav-left-container-small">';

        foreach($t as $k){
            $html.= '<li>
                <a class="J_menuItem" href="#"><span class="hidedata">'.json_encode($k,JSON_UNESCAPED_UNICODE).'</span>'.$k["des"].'</a>
                </li>';
        }
        $html.="</ul>
        </li>";
        return $html;
    }

    /**
     * @description: 结束周期 输出HTML 官方默认方式
     * @param {type} 
     * @return: 
     * @author: 术与道
     */
    static public function end($outData,$conf){

        if(!file_exists($conf['outpath'])){
            mkdir($conf['outpath']);
        }

        //未定义自定义模板
        if(!isset($conf['template'])){ //官方默认
            //取模板数据
            $templatePath = P2ROOT."/template/index.html";
            $handle = fopen($templatePath, "r");
            $contents = fread($handle, filesize ($templatePath));
            fclose($handle);
            //生成HTML内容
            $html = '<li class="active">
            <a class="J_menuItem" href="#"><span class="hidedata">'.json_encode($conf['preface'],JSON_UNESCAPED_UNICODE).'</span><em>序言</em></a>
            </li>';

            $keys = array_keys($outData);
            foreach($keys as $t){
                if(isset($outData[$t]['des'])){ //无子集
                    $html.= '<li>
                    <a class="J_menuItem" href="#"><span class="hidedata">'.json_encode($outData[$t],JSON_UNESCAPED_UNICODE).'</span>'.$outData[$t]["des"].'</a>
                    </li>';
                }else{         
                    $html.=self::multistage($t,$outData[$t]);
                }
            }
            //输出
            $docHtml = fopen($conf['outpath']."/index.html", "w");
            if(!file_exists($conf['outpath']."/static")){
                mkdir($conf['outpath']."/static");
            }
            copy(P2ROOT."/template/static/base.css",$conf['outpath']."/static/base.css");
            copy(P2ROOT."/template/static/jquery-kq-nav-left.css",$conf['outpath']."/static/jquery-kq-nav-left.css");
            fwrite($docHtml, str_replace("{{content}}",$html,$contents));
            fclose($docHtml);
        }else{ 
            $outData["preface"]["title"] = $conf["preface"][0];
            $outData["preface"]["content"] = $conf["preface"][1];
            //自定义
            $templatePath = $conf['template'];
            if(is_file($templatePath)){
                $handle = fopen($templatePath, "r");
                $contents = fread($handle, filesize ($templatePath));
                fclose($handle);
                //输出
                $docHtml = fopen($conf['outpath']."/index.html", "w");
                //输出JSON内容，其它由开发者对模板进行处理；
                fwrite($docHtml, str_replace("{{content}}",json_encode($outData,JSON_UNESCAPED_UNICODE),$contents));
                fclose($docHtml);
            }else{
                throw new Exception("模板文件不存在,请检查重试");
                die;
            }
        }
        echo "已输出至：".$conf['outpath']."\n";
        echo "生成成功！！";
        die;
        
    }
}