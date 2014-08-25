/*
Title: How to Install Phalcon in Openlitespeed
Description: Installing phalcon framework in openlitespeed web server
Date: 2014/08/25
Category: Phalcon
Keywords: PHP, Phalcon, Openlitespeed
Template: post
*/

Introduction
---

This guide will show you how to install phalcon framework in openlitespeed web server in ubuntu 14.04.

> Phalcon is a web framework implemented as a C extension offering high performance and lower resource consumption.

And 

> OpenLiteSpeed is a high-performance, lightweight, open source HTTP server which has rich feature such as apache2 rewrite rule compatible, web admin GUI, high performance page caching and many more 

Based on product tagline we will install high performance php framework `phalcon` along with high performance web server `openlitespeed`

Intalling Openlitespeed
---
upgrade ubuntu package with
~~~.sh
sudo apt-get update
sudo apt-get upgrade
~~~

Install latest version of `openlitespeed`
~~~.sh
sudo apt-get install build-essential
sudo apt-get install libpcre3-dev libexpat1-dev libssl-dev libgeoip-dev zlib1g-dev
cd /usr/local/src
wget http://open.litespeedtech.com/packages/openlitespeed-1.4.0.tgz
tar zxfv openlitespeed-1.4.0.tgz
cd openlitespeed-1.4.0
/.configure
sudo make
sudo make install
~~~

If there is no error, open `openlitespeed` web admin GUI in `https://localhost:7080` with username/password `admin/123456`

In order `openlitespeed` work with `PHP` we must compile `PHP` using `LSAPI`. This action can be found in web admin console `action` -> `compile php`.

Select `PHP` version from dropdown list, I prefer compile latest PHP version. You may compile PHP version your own parameter but in this tutorial I will use paramater that I use for my production server. Here is my parameter

~~~
'--with-litespeed' '--with-libdir=lib64' '--enable-cli' '--with-mcrypt' '--enable-mbstring' '--with-openssl' '--with-mysql' '--with-mysqli' '--with-mysql-sock=/var/lib/mysql/mysql.sock' '--with-pdo-mysql' '--with-gd' '--with-zlib' '--with-gmp' '--with-sqlite' '--enable-pdo' '--enable-gd-native-ttf' '--enable-fileinfo' '--disable-debug' '--with-pic' '--with-bz2' '--with-curl' '--with-curlwrappers' '--without-gdbm' '--with-gettext' '--with-iconv' '--with-pspell' '--with-pcre-regex' '--enable-exif' '--enable-ftp' '--enable-magic-quotes' '--enable-sockets' '--disable-sysvsem' '--disable-sysvshm' '--disable-sysvmsg' '--enable-wddx' '--with-kerberos' '--enable-ucd-snmp-hack' '--enable-shmop' '--enable-calendar' '--enable-gd-jis-conv' '--enable-dom' '--disable-dba' '--enable-xmlreader' '--enable-xmlwriter' '--with-tidy' '--enable-xml' '--with-xmlrpc' '--with-xsl' '--enable-bcmath' '--enable-soap' '--enable-zip' '--enable-inline-optimization' '--with-mhash' '--enable-mbregex' '--with-freetype-dir=lib64' '--with-jpeg-dir=lib64' '--with-png-dir=lib64'
~~~

Becore you compile `PHP` you have to satisfied `PHP` dependency by installing some libs

~~~
sudo apt-get install mcrypt libc6-dev gcc-multilib make manpages-dev automake1.9 libtool flex bison gdb gcc-doc libstdc++6-4.6-dev g++-4.6 libstdc++6 libstdc++6-4.6-doc g++ libxml2-dev libcurl4-gnutls-dev libpng12-dev libjpeg8-dev libxpm-dev libreadline-dev libmcrypt-dev zlibc libexif-dev libgmp-dev libxslt1-dev autoconf imagemagick libgif-dev ttf-freefont libfreetype6-dev libiconv-hook-dev libmagickcore3-extra ghostscript netpbm libicu44 libicu-dev libevent-dev libevent-2.0-5 t1lib-bin libvpx-dev libt1-dev libpspell-dev libtidy-dev
~~~

After finished installing `PHP` dependency you may continue you `PHP` compilation process.

If there an error when compiling PHP it usually depencency problem, You can fix it by install required dependency.

When compilation process is done, you may run this command to make sure `PHP` already instally in your sistem

~~~.sh
/usr/local/lsws/lsphp5/bin/lsphp -v
~~~

It should return your current `PHP` version and installed zend extension.

Installing Phalcon
---
First you have to make symbolic link your current lsphp and its component to /bin or /usr/local/bin

~~~.sh
sudo ln -s /usr/local/lsws/lsphp5/bin/lsphp /bin/php
sudo ln -s /usr/local/lsws/lsphp5/bin/phpize /bin/phpize
sudo ln -s /usr/local/lsws/lsphp5/bin/phpcgi /bin/php-cgi
sudo ln -s /usr/local/lsws/lsphp5/bin/php-config /bin/php-config
~~~

Then download install phalcon v1.3.x

~~~.sh
git clone --depth=1 git://github.com/phalcon/cphalcon.git
cd cphalcon/build
sudo ./install
~~~

copy `php.ini` template from /usr/local/lsws/phpbuild/php-`your-php-version`/

There is 2 version of PHP ini provided `development` and `production` in this tutorial we will use `php.ini` for `development`

~~~.sh
cp /usr/local/lsws/phpbuild/php-5.4.19/php.ini-production /usr/local/lsws/lsphp5/lib/php.ini
~~~

finally add phalcon extension to your php.ini by add this line to your php.ini

~~~.sh
extension=phalcon.so
~~~

check if phalcon already installed to your php by run this code

~~~.sh
php -i | grep phalcon
~~~

You should see phalcon version and other setting displayed on your console.

Closing Words
---
Thanks for following my tutorial. If you found any error you can shoot me via email :)