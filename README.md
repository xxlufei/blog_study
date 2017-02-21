php版本:>=5.5.9
apache要开启rewrite以及AllowOverride all

如果要传大文件,需修改php.ini
upload_max_filesize = 2048M (根据情况自己调整)
post_max_size = 2048M(根据情况自己调整)


后台账号 admin   admin123

数据库配置
/.env

站点配置
/config/C.php


