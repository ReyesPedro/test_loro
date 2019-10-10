<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Configuración

Requisitos para proyecto

-Ubuntu Server
-Nginx
-PHP 7.2
-git



--Se agrega el repositorio
sudo add-apt-repository ppa:ondrej/php


--Se actualiza la lista de paquetes
sudo apt-get update


--Se instala mongodb (omitir si esta instalado)
sudo apt-get install -y mongodb-server
sudo apt-get install -y mongodb-org


--Se activa el servicio (omitir si esta instalado)
sudo systemctl start mongodb
sudo systemctl enable mongodb

--Se debe ingresar al shell de mongo
mongo
//Se selecciona la base de datos admin
>use admin
//Se crea el usuario admin con role root (omitir si esta creado el usuario, tener encuenta en el archivo .env)
>db.createUser({user:"admin", pwd:"admin123", roles:[{role:"root", db:"admin"}]})
//Se crear la db para el REST
use test_loro
//se sale del shell de mongo
>exit


--Se recarga el servicio
sudo systemctl daemon-reload

sudo service mongodb restart

--Se prueba el acceso a mongo con el usuario admin
mongo -u admin -p admin123 --authenticationDatabase admin

--Se debe buscar la siguiente linea en el archivo /lib/systemd/system/mongod.service y se agrega el argumento --auth

Original : ExecStart=/usr/bin/mongod --unixSocketPrefix=${SOCKETPATH} --config ${CONF} $DAEMON_OPTS
Modificada : ExecStart=/usr/bin/mongod --unixSocketPrefix=${SOCKETPATH} --auth --config ${CONF} $DAEMON_OPTS

--Se instala php7.2 (omitir si esta instalado)
sudo apt-get install php7.2 php7.2-bcmath php7.2-common php7.2-json php7.2-mbstring php7.2-xml php7.2-pgsql php7.2-curl php7.2-mongodb

--Se activa la libreria de mongodb en php.ini
sudo bash
sudo echo "extension=mongodb" >> /etc/php/7.2/fpm/php.ini

--Se deben activar las siguientes librerias en el archivo /etc/php/7.2/fpm/php.ini
curl, mbstring, openssl, mongodb

--Se instala la última versión de nginx (omitir si esta instalado)
sudo apt-get install nginx

--Se instala la última versión de composer x
sudo apt-get install composer

cd /var/www/html/

--Se crea la carpeta del repositorio
mkdir test_loro.com

--Se modifican los permisos temporalmente para evitar conflictos con ubuntu y composer
sudo chown -R $USER:$USER test_loro.com/

--Se clona el proyecto del repositorio
git clone --single-branch --branch release/v1.0.0 https://github.com/ReyesPedro/test_loro.git test_loro.com

--Se reasignan los permisos 
sudo chown -R $USER:www-data test_loro.com/

--Se ajustan los permisos de la carpeta del proyecto
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

--En el archivo .env se debe modificar lo siguiente ( los campos DB_USERNAME, DB_PASSWORD dependen si ya existe un usuario en el ambiente de producción, si no usar los mencionados)

APP_NAME=TestLoro
APP_ENV=local
APP_KEY=base64:05PgsUFchtXJBrxgxScn2R46gzIgjtxeRZLB32Lmnpw=
APP_DEBUG=false

DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=test_loro
DB_USERNAME=admin
DB_PASSWORD=admin123


--Se obtienen las dependencias
composer install


--Se crear el archivo test_loro.com.conf en la carpeta /etc/nginx/sites-available con el siguiente contenido recomendado por Laravel

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


 --Una vez creado el .conf, se debe crear el enlace simbolico en la carpeta /etc/nginx/sites-enabled/
sudo ln -s /etc/nginx/sites-available/test_loro.com.conf /etc/nginx/sites-enabled/


--Se valida la configuración de nginx
sudo nginx -t

--Se reinicia nginx
sudo service nginx restart

