# P2API

基于方法注释的API接口文档生成工具

快速通用、方便简单、基于同方法注释，在写注释的同时就把API文档给写完了。

同时你也可开发自定义接口文档模板、灵活添加注释字段满足更多个性化的需求，可搭配IDE的自动注释生成。


要求
------------
- PHP 5.6+


安装使用
------------
只要有注释，理论上都可以使用P2API，甚至不限于PHP语言。

将项目克隆到本地：

```
git clone https://github.com/shuyudao/P2API
```

然后进入项目，可以看到 `config.php` 文件，配置父级公共目录，这个公共目录，主要作用就是让你在class配置里少复制一段路径。

`class`，是注释API的文件，一般是框架的控制器文件，如果有多个，就配置多个。

同时需要注意的是，`publicPath+class['你的文件']` 拼接起的路径必须为完整路径

```
//配置实例
$config = array(
    "publicPath"=>"C:\Users\sad\Desktop\test\app\controller\", //公共目录，绝对路径，是下面class所有文件共同的父目录
    "class"=>[
        "StudentCtrl.php",
        "haha/IndexCtrl.php"
    ],//含有API接口注释的类文件
    "preface"=>["API接口项目名","项目描述，支持HTML"], //文档首页
    "outpath"=>"C:\Users\sad\Downloads\mydoc" //生成文档的保存位置，必须为目录，绝对路径
); 

```

给你的控制器或者相关的PHP类方法上添加要求的注释

然后，在P2API项目根目录使用php命令执行，必须使用php命令执行该文件，也就是php-cli
```
php index.php 
```


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



默认效果
------
![image.png](https://i.loli.net/2020/04/10/g49AHbGWRZkDOlI.png)

![image.png](https://i.loli.net/2020/04/10/eqABSYx3N9WTwsP.png)

![image.png](https://i.loli.net/2020/04/10/gHA3flF2o76LYCX.png)


更多实现
------
- [x] 自定义模板支持

- [ ] 多种输出方式

- [ ] 模拟测试请求

- [ ] 更多自定义

- [ ] 文档管理


License
------
[The MIT License (MIT)](https://github.com/shuyudao/P2API/blob/master/LICENSE)