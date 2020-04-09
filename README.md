# P2API

面向PHP，基于方法注释的API接口文档生成器

可开发自定义接口文档模板、灵活添加注释字段满足更多需求，搭配IDE的自动注释生成，简直起飞。


要求
------------
- PHP 5.6+
- Composer/Git

安装使用
------------
理论上都可以使用P2API

```
composer require shuyudao/p2api
```

在你的项目入口或者框架入口**结尾**，添加如下代码：

```
$config = array(
    "class"=>[
        "app\\controller\\index"
    ],//含有接口注释的类，比如这个就是index控制器类，如果有namespace，请完整填写，将会扫描所有的方法
    "preface"=>["API接口项目名","项目描述，支持HTML"], //文档首页
    "outpath"=>"C:\Users\sad\Downloads\xxxx" //生成文档的保存位置，必须为目录，绝对路径
); 

$p2api = new P2api($config);

$p2api->run();
```

给你的控制器或者相关的PHP类方法上添加要求的注释

然后，使用php命令执行，必须使用php命令执行该文件，也就是php-cli
```
php index.php 
```
如有问题请issue

注释要求
--------

标准完整注释
```
    /**
     * @des 用户注册
     * @paths /user/reg
     * @method POST
     * @parameter ["user","是","string","用户名"],["password","是","string","密码"]
     * @returnParameter ["code","int","状态"]
     * @response {"code":200}
     * @tips 这是接口备注
    */
    public function FunctionName(){...}
```
其中 `@parameter`、`@returnParameter`、`@response`、`@tips`可以不需要，如果注释了，就一定要赋值，不要留空。

同时你也可以添加新的字段以`@xxx `的形式，在自己开发的模板中使用。

#### 注释释义

- `@des` - 接口描述，如果值类似于`用户模块 注册`，则会自动分级显示，最多支持两级。`必填`✔
- `@paths` - 请求路径，接口的请求URL。`必填`✔
- `@method` - 请求方法，POST/GET/PUT... 其实都不限制你的值内容，写个SB都行。`必填`✔
- `@parameter` - 请求参数列表，一个参数信息包含在`[]`中，须有四个参数为：`参数名称`、`参数必选`、`参数类型`、`参数说明`，多个参数以半角逗号分割
- `@returnParameter` - 响应参数列表，四个参数为：`参数名称`、`参数类型`、`参数说明`，其它同上
- `@response` - 返回示例，正常的响应返回内容，json格式字符串，一行
- `@tips` - 接口备注

其中，`@response`、 `@tips`可以不写上去以外，其它的均建议写上，除非参数列表实在没有。

再次说明，可选参数注释要么不写上去，要么就不要留空。注释参数值，其实任何值都行，如果你使用自定义的模板，可以随你怎么填值，但是三个必填注释，必须有。

更多...
