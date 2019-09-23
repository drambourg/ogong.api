# Authentication management

## Generate the SSH keys
````
mkdir config/jwt
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

openssl rsa -in config/jwt/private.pem -out config/jwt/private2.pem
mv config/jwt/private.pem config/jwt/private.pem-back
mv config/jwt/private2.pem config/jwt/private.pem
````