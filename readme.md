## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

<<<<<<< HEAD
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.
=======
3.修改\bin\apache\apache2.4.9\conf\extra\httpd-vhosts.conf文件，添加 <br/>
<VirtualHost *:80> <br/>
    ServerAdmin qwe97886@qq.com<br/>
    DocumentRoot "D:/wamp/www/healthweb/public"<br/>
    ServerName www.healthweb.com<br/>
    ErrorLog "logs/www.health.com-error.log"<br/>
    CustomLog "logs/www.health.com-access.log" common<br/>
</VirtualHost>

3.修改hosts文件，添加
127.0.0.1 www.health.com
>>>>>>> a8625a40783f533a81b592a7e22d1bb11c0f1279

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

<<<<<<< HEAD
## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
=======
5.进入http://www.health.com/index ,如果成功的话会显示首页的

项目结构：
  app文件夹下是代码，app\Http\routes.php是导航，app\Http\Controllers下控制器文件，app\Model下是Model文件，resources\views下是视图文件，
  public下有css、js、image等文件夹
关于lavarel的教程见http://www.golaravel.com/

项目有点赶，很多方法都是空的，有坑一起填哈:)
>>>>>>> a8625a40783f533a81b592a7e22d1bb11c0f1279
