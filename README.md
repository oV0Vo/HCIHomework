# HCIHomework
1.安装wamp，将项目导到www文件夹下

2.修改bin/apache/apache2.4.9/conf/httpd.conf文件，将
\#LoadModule rewrite_module modules/mod_rewrite.so
的#去掉，和
\# Virtual hosts
\#Include conf/extra/httpd-vhosts.conf
Include前的include去掉

3.修改hosts文件，添加
127.0.0.1 www.health.com

4.使用sql.txt脚本文件建立数据库

5.进入http://www.health.com/index ,如果成功的话会显示首页的
