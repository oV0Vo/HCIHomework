# HCIHomework
1.安装wamp，将项目导到www文件夹下

2.修改bin/apache/apache2.4.9/conf/httpd.conf文件，将
\#LoadModule rewrite_module modules/mod_rewrite.so
的#去掉，和
\# Virtual hosts
\#Include conf/extra/httpd-vhosts.conf
Include前的include去掉

3.修改\bin\apache\apache2.4.9\conf\extra\httpd-vhosts.conf文件，添加<br/>
<VirtualHost *:80>
    ServerAdmin qwe97886@qq.com
    DocumentRoot "D:/wamp/www/healthweb/public"
    ServerName www.healthweb.com
    ErrorLog "logs/www.health.com-error.log"
    CustomLog "logs/www.health.com-access.log" common
</VirtualHost>

3.修改hosts文件，添加
127.0.0.1 www.health.com

4.使用sql.txt脚本文件建立数据库

5.进入http://www.health.com/index ,如果成功的话会显示首页的

项目结构：
  app文件夹下是代码，app\Http\routes.php是导航，app\Http\Controllers下控制器文件，app\Model下是Model文件，resources\views下是视图文件，
  public下有css、js、image等文件夹
关于lavarel的教程见http://www.golaravel.com/

项目有点赶，很多方法都是空的，有坑一起填哈:)
