@echo off

echo Initializing MySQL tables
d:\server\bin\mysqld.exe --defaults-file=d:\server\my.ini --plugin-dir=d:\bin\modules\mysql --initialize --console > d:\server\mysql.pass
type d:\server\mysql.pass

echo Generating Private/Public Keypair for Download script
set OPENSSL_CONF=d:\server\conf\openssl-ca.cfg
d:\server\bin\openssl.exe genrsa -des3 -out d:\server\var\www\default\html\downloads\PRIVATE_KEY.pem 2048
d:\server\bin\openssl.exe rsa -in d:\server\var\www\default\html\downloads\PRIVATE_KEY.pem -out d:\server\var\www\default\html\downloads\PRIVATE_KEY.pem
d:\server\bin\openssl.exe rsa -in d:\server\var\www\default\html\downloads\PRIVATE_KEY.pem -outform PEM -pubout -out d:\server\var\www\default\html\downloads\PUBLIC_KEY.pem