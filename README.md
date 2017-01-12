## Purpose

Webserver Pro was designed to implement a secure (as much as reasonably possible) and full stack implementation of the most popular technologies for a server-side environment. It has gone through many years of testing and fine-tuning while blending the current versions of servers into the mix. This solution was kept in-house since 2001.

## Implementation

The initial public release is fixed to work from `d:\server`, however we plan on releasing a tool to allow you to quickly change that. It works best in a short path that is close to root with no spaces in it.

#### Components (Thread-safe VC14)

* NodeJS and NPM (`npm install -g` places the components in `/bin/node_modules/`)
* MySQL 5.7.17 + SSL support (x64)
* Apache 2.4.25 (x64 from apachelounge.com)
* OpenSSL 1.0.2j
* MongoDB 3.5.1-154-g166a966 (x64)
* UPX 3.92w
* PHP 7.1.0 (x64)

#### Modules

* xsendfile
* xdebug 2.5.0

#### Folder Structure

Everything is completely self-contained, and is virtual hosting ready.

![image](https://cloud.githubusercontent.com/assets/11585632/21901417/a1d8d5ec-d8c5-11e6-8146-465adc14241f.png)

The folder structure is laid out similar to the modern layout of apache installs on Ubuntu/Debian as follows :

`bin` - This folder contains all binaries. Adding `d:\server\bin` to your system path will enable access to all commands like nodejs, npm, etc.
----
`conf` - Every config file is located in here, except for `php.ini`, `openssl.cfg` (default), `browscap.ini`, and `cacert.pem`

Inside this folder are the following subfolders :

* `conf-available` - For available config files that are not site or module specific.
* `conf-enabled` - For config files you wish to have loaded that are not site or module specific.
* `mods-available` - Apache modules that are available for loading. (php5 is not part of this distribution, but is kept for future use)
* `mods-enabled` - Apache modules you wish to have loaded. (.load and .conf files are copied here from `mods-available`) The number preceding is to ensure proper load order.
* `sites-available` - Website conf files for sites that are available.
* `sites-enabled` - Website conf files for sites that are enabled.

*Enabled* - This means that the .load/.conf files are loaded when the server starts
*Available* - This contains only what is available. Folders with this are not loaded when the server starts.

If you ran `make-ca.bat` then you will have the additional folders :

`ca` - This is your ROOT CA. No more self-signed certificates. You now have your own CA for signing.
`certificates` - Where your certificates are located when creating them with your CA.

You also have the following files in this folder for general configuration :

`httpd.conf` - Apache config file. Generally, you won't even need to touch this anymore.
`ports.conf` - Assign which port(s) Apache is listening on. Enabling the SSL module will trigger the SSL port flag in this config.
`openssl-ca.cfg` - You shouldn't need to touch this. It is used to help build your CA (Certificate Authority)
`openssl-intermediate.cfg` - You shouldn't need to touch this. It is used to build your Intermediate Certificate Authority for your CA.
`openssl.cnf` - General openssl config.
`mongod.cfg` - MongoDB configuration.

----

`data` - Your database file(s) will be stored inside a folder here. MySQL will be stored in `/data/mysql` and MongoDB will be stored in `/data/mongodb`

----

`var` - This is where the bulk of your dynamic data will be placed, inside their respective subfolders similar to Linux.

The immediate subfolders are :

* `log` - Contains general log files (apache startup, apache error, mysql slow, etc)
* `run` - Contains (or should contain) pid/lock files for Apache / MySQL / etc while they are running.
* `www` - This is the direct root where you will have all your website structures (domains) located. It also contains `php-libraries` for placing classes you commonly use without needing to copy to every site, and `sessions` which should contain any session files.

Inside `www`, the structure is derived similar to a home folder for a user. The direct decendant folder is the main container pertaining to a web-entity/domain. Inside that container, you will have `html` (this is where you will place the website content), and `log` (this is were site specific log data is contained)

![image](https://cloud.githubusercontent.com/assets/11585632/21902847/7d1dbd66-d8cb-11e6-8b3a-2a18dae86643.png)

#### Capabilities

This server is complete with the following features :

* Fully functional Certificate Authority (CA)
* Fully functional Intermediate Certificate Authority
* Virtual Hosting with SSL (multiple domains with multiple SSL certificates)
* Ready to go Nodejs with NPM without cluttering your main drive. (AppData, etc are not used)
* Completely self-contained. - You can backup the root folder and have everything ready to deploy on another box.
* Built-in PHP debugger (without the debug version of PHP) using xdebug.
* Reduced memory footprint delivering files (using xsendfile - no need to `fread` + `print` files)
* x64 Thread Safe environment.
* PHP is hardened for production use.
* PHP directive override using `.php.ini` in whichever folder you wish to override the directives in.
* .htaccess and mod_rewrite are enabled and functional.
* Easy enabling/disabling of sites and modules
* Headache-free config file editing.
* Over 15 years of testing and upgrading. (Private project started in 2002)

