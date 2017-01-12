REM set PATH=%PATH%;d:\server\bin

echo off

REM use CA config file
set OPENSSL_CONF=d:\server\conf\openssl-ca.cfg

REM create the root key
openssl genrsa -aes256 -passout pass:abcd -out certificates\ca\private\root.key 4096
openssl rsa -passin pass:abcd -in certificates\ca\private\root.key -out certificates\ca\private\root.key

REM create the root certificate
openssl req -key certificates\ca\private\root.key -new -x509 -days 7300 -sha256 -extensions v3_ca -out certificates\ca\certs\root.crt -subj "/C=CA/ST=Ontario/L=Oshawa/O=Webserver Pro Local CA/CN=Webserver Pro Local CA"



REM use Intermediate config file
set OPENSSL_CONF=d:\server\conf\openssl-intermediate.cfg

REM create the intermediate key and csr
openssl genrsa -aes256 -passout pass:abcd -out certificates\intermediate\private\intermediate.key 4096
openssl rsa -passin pass:abcd -in certificates\intermediate\private\intermediate.key -out certificates\intermediate\private\intermediate.key
openssl req -new -sha256 -key certificates\intermediate\private\intermediate.key -out certificates\intermediate\csr\intermediate.csr -subj "/C=CA/ST=Ontario/L=Oshawa/O=Webserver Pro Local CA/CN=Webserver Pro Local CA"

REM use CA config file
set OPENSSL_CONF=d:\server\conf\openssl-ca.cfg

REM sign the intermediate key and csr
openssl ca -batch -extensions v3_intermediate_ca -days 3650 -notext -md sha256 -in certificates\intermediate\csr\intermediate.csr -out certificates\intermediate\certs\intermediate.crt


copy certificates\intermediate\certs\intermediate.crt + certificates\ca\certs\root.crt certificates\ca-bundle.crt


REM use Intermediate config file
set OPENSSL_CONF=d:\server\conf\openssl-intermediate.cfg


openssl genrsa -aes256 -passout pass:abcd -out certificates\localhost.key 2048
openssl rsa -passin pass:abcd -in certificates\localhost.key -out certificates\localhost.key
openssl req -new -sha256 -key certificates\localhost.key -out certificates\localhost.csr -subj "/C=CA/ST=Ontario/L=Oshawa/O=Webserver Pro Local CA/CN=localhost"

openssl ca -batch -extensions server_cert -days 375 -notext -md sha256 -in certificates\localhost.csr -out certificates\localhost.crt