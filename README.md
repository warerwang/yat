####这是一个yii2 作为restful api.angularjs 做前端的实验项目.通过nginx的反响代理解决api的跨域请求

##目录:
###client 客户端
 * dev  开发时的网站代码.
 * dist 部署时的网站代码
 * test 单元测试

###server 服务器
 * modules 模块
 * controllers 控制器
 * models 模型
 * dev 域名绑定目录
 * config 服务器配置

##安装
开发环境需要一下组建 nodejs npm  gulp compass karma-cli ruby composer codecept
安装命令
```shell
npm -g install gulp compass karma-cli ruby composer codecept
```

###安装服务端
```shell
cd yat/server
make composer_prepare
make composer_install
make prepare
bower install
```
###客户端
```shell
cd yat/client
make prepare
gulp serve
```

##部署
make deploy