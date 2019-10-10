## Configuración

Requisitos para proyecto

--Ubuntu Server<br>
--Nginx<br>
--PHP 7.2<br>
--git<br>


--Se agrega el repositorio: <br>
sudo add-apt-repository ppa:ondrej/php


--Se actualiza la lista de paquetes: <br>
sudo apt-get update


--Se instala mongodb (omitir si esta instalado): <br>
sudo apt-get install -y mongodb-server 
sudo apt-get install -y mongodb-org


--Se activa el servicio (omitir si esta instalado): <br>
sudo systemctl start mongodb 
sudo systemctl enable mongodb

--Se debe ingresar al shell de mongo:<br>
mongo
--Se selecciona la base de datos admin:<br>
use admin<br> 
--Se crea el usuario admin con role root (omitir si esta creado el usuario, tener encuenta en el archivo .env)::<br> 
db.createUser({user:"admin", pwd:"admin123", roles:[{role:"root", db:"admin"}]})<br> 
--Se crear la db para el REST: <br>
use test_loro<br> 
--se sale del shell de mongo: <br>
exit


--Se recarga el servicio:<br> 
sudo systemctl daemon-reload 
sudo service mongodb restart 

--Se prueba el acceso a mongo con el usuario admin: <br> 
mongo -u admin -p admin123 --authenticationDatabase admin

--Se debe buscar la siguiente linea en el archivo /lib/systemd/system/mongod.service y se agrega el argumento "--auth" :<br> 

Original : ExecStart=/usr/bin/mongod --unixSocketPrefix=${SOCKETPATH} --config ${CONF} $DAEMON_OPTS <br> 
Modificada : ExecStart=/usr/bin/mongod --unixSocketPrefix=${SOCKETPATH} --auth --config ${CONF} $DAEMON_OPTS <br> 

--Se instala php7.2 (omitir si esta instalado): <br>
sudo apt-get install php7.2 php7.2-bcmath php7.2-common php7.2-json php7.2-mbstring php7.2-xml php7.2-pgsql php7.2-curl php7.2-mongodb

--Se activa la libreria de mongodb en php.ini: <br>
sudo bash <br> 
sudo echo "extension=mongodb" >> /etc/php/7.2/fpm/php.ini

--Se deben activar las siguientes librerias en el archivo /etc/php/7.2/fpm/php.ini: <br>
curl, mbstring, openssl, mongodb

--Se instala la última versión de nginx (omitir si esta instalado): <br>
sudo apt-get install nginx

--Se instala la última versión de composer x: <br>
sudo apt-get install composer

cd /var/www/html/

--Se crea la carpeta del repositorio: <br>
mkdir test_loro.com

--Se modifican los permisos temporalmente para evitar conflictos con ubuntu y composer: <br>
sudo chown -R $USER:$USER test_loro.com/

--Se clona el proyecto del repositorio: <br>
git clone --single-branch --branch release/v1.0.0 https://github.com/ReyesPedro/test_loro.git test_loro.com

--Se reasignan los permisos <br>
sudo chown -R $USER:www-data test_loro.com/

--Se ajustan los permisos de la carpeta del proyecto <br> 
cd test_loro.com/

sudo chmod -R 777 .

sudo chgrp -R www-data storage bootstrap/cache

sudo chmod -R ug+rwx storage bootstrap/cache

sudo chown $USER:www-data -R storage/

sudo chown $USER:www-data -R bootstrap/

sudo chown $USER:www-data -R bootstrap/cache

sudo chmod 775 -R storage/

sudo chmod 775 -R bootstrap/

sudo chmod 775 -R bootstrap/cache

--En el archivo .env se debe modificar lo siguiente ( los campos DB_USERNAME, DB_PASSWORD dependen si ya existe un usuario en el ambiente de producción, si no usar los mencionados) <br> 

APP_NAME=TestLoro<br>
APP_ENV=local<br>
APP_KEY=base64:05PgsUFchtXJBrxgxScn2R46gzIgjtxeRZLB32Lmnpw=<br>
APP_DEBUG=false<br>

DB_CONNECTION=mongodb<br>
DB_HOST=127.0.0.1<br>
DB_PORT=27017<br>
DB_DATABASE=test_loro<br>
DB_USERNAME=admin<br>
DB_PASSWORD=admin123<br>


--Se obtienen las dependencias <br> 
composer install


--Se crear el archivo test_loro.com.conf en la carpeta /etc/nginx/sites-available con el siguiente contenido recomendado por Laravel<br> 

#################################################################################
server {
    listen 80;
    server_name test_loro.com; #debe ir aqui la IP del servidor de produccion
    root /var/www/html/test_loro.com/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

}
#################################################################################


 --Una vez creado el .conf, se debe crear el enlace simbolico en la carpeta /etc/nginx/sites-enabled/ <br> 
sudo ln -s /etc/nginx/sites-available/test_loro.com.conf /etc/nginx/sites-enabled/


--Se valida la configuración de nginx <br> 
sudo nginx -t

--Se reinicia nginx <br> 
sudo service nginx restart 

Listo
