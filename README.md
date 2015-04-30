这是一个yii2 作为restful api.
angularjs 做前端的实验项目.
通过nginx的反响代理解决api的跨域请求

目录:
client 客户端
  dev  开发时的网站代码.
  dist 部署时的网站代码
  test 单元测试
server 服务器

config 服务器配置

安装
server
composer install
client
npm install

开发环境需要 nodejs npm grunt-cli compass karma-cli ruby composer codecept
部署
make deploy


grunt serve 开启测试