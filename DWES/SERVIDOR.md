# Examen DAW - Ubuntu 22.04
# Guía de Uso de `sudo` en un Servidor Ubuntu
En un servidor Ubuntu con Apache, PHP, MySQL, etc., el uso de `sudo` depende de la tarea que estés realizando y de los permisos requeridos para esa tarea específica. A continuación se presenta una guía general sobre cuándo usar `sudo`:
## Cuándo Usar `sudo`:
### Instalación y Actualización de Software
- Al instalar nuevos paquetes o software con `apt` o `apt-get`.
- Al actualizar el sistema o software instalado.
### Modificar Configuraciones del Sistema
- Al editar archivos de configuración que requieren permisos de root, como archivos en `/etc/apache2`, `/etc/php`, `/etc/mysql`.
- Al modificar configuraciones relacionadas con el sistema operativo o servicios del sistema (por ejemplo, Apache, MySQL).
### Gestión de Servicios del Sistema
- Al iniciar, detener o reiniciar servicios del sistema como Apache (`apache2`), MySQL, u otros servicios de sistema.
- Al habilitar o deshabilitar servicios para que se inicien en el arranque.
### Manipulación de Archivos o Directorios Protegidos
- Al cambiar permisos o propietarios de archivos/directorios que están fuera de tu directorio de usuario.
- Al acceder o modificar directorios protegidos, como `/var/www` para sitios web.
### Operaciones de Red
- Al abrir puertos en el cortafuegos o realizar configuraciones de red que requieren privilegios elevados.
### Tareas de Administración del Sistema
- Al añadir o modificar usuarios del sistema o grupos.
- Al configurar tareas programadas con `cron` que requieren permisos de root.
## Cuándo No Usar `sudo`:
### Operaciones Dentro de tu Directorio de Usuario
- Al trabajar dentro de tu directorio personal (`/home/tu_usuario`), generalmente no necesitas `sudo` para crear, editar o borrar archivos.
### Lectura de Archivos de Configuración
- Si solo estás leyendo (no editando) archivos de configuración o logs que son accesibles para tu usuario, no necesitas `sudo`.
### Uso de Aplicaciones de Usuario
- Al ejecutar comandos o programas que no afectan el sistema a nivel global y están diseñados para ser ejecutados como tu usuario regular.
### Desarrollo y Pruebas
- Al escribir o probar tu código, a menos que específicamente necesites simular un entorno con permisos elevados.
## Consideraciones Importantes
- **Seguridad**: Usar `sudo` otorga poderes significativos y puede afectar la estabilidad y seguridad de tu sistema. Debe usarse con precaución.
- **Entorno de Producción**: En un servidor de producción, es especialmente crítico ser cauteloso al usar `sudo`, ya que los errores pueden tener impactos significativos.

En resumen, `sudo` se utiliza para tareas que requieren permisos elevados más allá de los de un usuario normal, como la gestión de configuraciones de sistema, servicios y software a nivel de sistema. En otros casos, es preferible usar el usuario regular para evitar riesgos de seguridad o errores críticos.
# COMANDOS SALVAVIDAS
## MATAR PID EN UN PUERTO
```
sudo netstat -tulpn | grep :8093
```
```
tcp  0  0  0.0.0.0:8093  0.0.0.0:*  LISTEN 1163/lighttpd
```
### Mata pa siempre
```
sudo kill 1163
```
### Mata pa un rato (se reinicia)
```
sudo kill -9 1163
```
## BUSCAR ARCHIVOS
### Buscar archivos por nombre
```
find /ruta/a/buscar -name "nombre_archivo*"
```
### Buscar archivos por extensión
```
find /ruta/a/buscar -name "*.extensión"
```
### Buscar directorios
```
find /ruta/a/buscar -type d -name "nombre_directorio*"
```
### Buscar archivos por tamaño
```
find /ruta/a/buscar -size +1M
```
### Buscar archivos por permisos
```
find /ruta/a/buscar -perm 777
```
### Buscar archivos por usuario
```
find /ruta/a/buscar -user usuario
```
### Buscar archivos por grupo
```
find /ruta/a/buscar -group grupo
```
### Buscar y ejecutar un comando
```
find /ruta/a/buscar -exec comando {} \;
```
```
find /ruta/a/buscar -type f -exec chmod 644 {} \;
```
### Buscar una cadena de texto en un archivo
```
grep -r "cadena_de_texto" /ruta/a/buscar
```
### Buscar una cadena de texto en un archivo y mostrar el número de línea
```
grep -rnw /ruta/a/buscar -e "cadena_de_texto"
```
### Ignorar mayúsculas y minúsculas
```
grep -i /ruta/a/buscar -e "cadena_de_texto"
```
## Instalación de GIT
### Instalación de GIT en el servidor
Para instalar GIT en el servidor, ejecutamos el siguiente comando:
```
sudo apt install git
```
## Configuraciones de GIT
### Configuración de GIT en el servidor
#### Configurar el nombre de usuario y el email
##### Usuario
```
git config --global user.name "Nombre Apellido"
```
##### Email
```
git config --global user.email "mailDelUsuario@mail.com"
```
### Configurar el nombre de la rama principal
Cambiar el nombre de master a main:
```
git config --global init.defaultBranch main
```
## Manejo de repositorios
### Creación de un repositorio bare
#### Crear el directorio
```
mkdir /home/usuario/repositorio
```
#### Ir al directorio
```
cd /home/usuario/repositorio
```
#### Inicializar el repositorio bare
```
git init --bare mi-repositorio.git
```
### Creación de un repositorio
#### Crear el directorio
```
mkdir /home/usuario/repositorio
```
#### Ir al directorio
```
cd /home/usuario/repositorio
```
#### Inicializar el repositorio
```
git init
```
### Borrar un repositorio bare
```
cd /home/usuario
rm -rf /repositorio
```
### Borrar un repositorio
```
cd /home/usuario/repositorio
rm -rf .git/
```
### Clonación de un repositorio bare
```
git clone /home/usuario/repositorio
```
### Clonación de un repositorio 
#### Con SSH
```
git clone usuario@servidor:/home/usuario/repositorio.git
```
#### Con HTTPS
```
git clone https://servidor/repositorio.git
```
## Uso de repositorios
### Ver estado:
```
git status
```
### Añadir archivos al repositorio
```
git add .
```
### Crear commit
```
git commit -m "Mensaje"
```
### Subir archivos al repositorio
```
git push
```
### Actualizar repositorio
```
git pull
```
### Crear rama
#### Crearla
```
git branch rama
```
#### Cambiarse a ella
```
git checkout rama
```
#### Crearla y cambiarse a ella
```
git checkout -b rama
```
### Fusionar ramas
#### Primero ir a la rama a la que le queremos fusionar la otra
```
git checkout main
```
#### Una vez allí, fusionar la rama
```
git merge rama
```
### Ver ramas
```
git branch
```
### Eliminar rama
```
git branch -d rama
```
### Ver historial
```
git log
```
#### Historial de un archivo
```
git log archivo
```
#### Historial de una rama
```
git log rama
```
#### Historial gráfico
```
git log --graph
```
 #### Todo lo anterior en una línea
```
git log --all --graph --oneline
```
### Ver diferencias
```
git diff
```
### Ver diferencias entre ramas
```
git diff rama1 rama2
```
### Ver diferencias entre commits
```
git diff commit1 commit2
```
### Ignorar archivos
```
nano .gitignore
```
### Amend
#### Añadir archivos al último commit
```
git commit -m 'Commit message'
git add archivo_olvidado
git commit --amend
```
#### Cambiar el mensaje del último commit
```
git commit -m 'Commit message'
git add archivo_olvidado
git commit --amend -m 'Nuevo mensaje'
```
### Reset
#### Resetear el último commit
```
git reset --soft HEAD~1
```
#### Resetear el último commit y quitar los archivos del staging area
```
git reset --mixed HEAD~1
```
#### Resetear el último commit y quitar los archivos del staging area y del working directory
```
git reset --hard HEAD~1
```
#### Resetear el último commit, quitar los archivos del staging area y del working directory y aplicar al ancestro primero
```
git reset --hard HEAD^
```

### Revert
#### Revertir el último commit
```
git revert HEAD
```
#### Revertir un commit concreto
```
git revert numero_commit
```
### Stash
#### Guardar cambios en el stash
```
git stash
```
#### Ver los cambios guardados en el stash
```
git stash list
```
#### Aplicar los cambios guardados en el stash
```
git stash apply
```
#### Eliminar los cambios guardados en el stash
```
git stash drop
```
#### Aplicar y eliminar los cambios guardados en el stash
```
git stash pop
```

Y añadimos los archivos que queremos ignorar, por ejemplo:
```
*.log
/tmp
*.idea
```
## WSL
### Manejo de imágenes WSL
Para ver las imágenes instaladas:
```
wsl --list --verbose
```
Para exportar una imagen:
```
wsl --export Ubuntu-22.04 c:\wsl\ubuntu2204.tar
```
Para importar una imagen:
```
wsl --import UbuntuServidor c:\wsl\UbuntuServidor c:\wsl\ubuntu2204.tar
```
Para iniciar una imagen
```
wsl -d UbuntuServidor
```
Poner el usuario por defecto una vez DENTRO de ubuntu
```
sudo nano /etc/wsl.conf
```
Y añadir las líneas:
```
[user]
default=usuario
````
Salir de WSL y volver a entrar.
```
wsl --terminate UbuntuServidor
```
```
wsl -d UbuntuServidor
```

## Claves SSH
Para generar una clave SSH, ejecutamos los siguientes comandos en GIT Bash:
```
ssh-keygen
```
Una vez ejecutado te pide la ruta donde guardar la clave, por defecto tanto en linux como en windows es:
```
/home/nombre_usuario/.ssh/id_rsa
```
```
C:\Users\nombre_usuario\.ssh\id_rsa
```
Para copiar la clave SSH, ejecutamos los siguientes comandos en GIT Bash:
```
ssh-copy-id -i /ruta/a/la/clave/publica.pub usuario@servidor
```
Para conectarnos por SSH. Una vez conectados es como si estuviésemos en el servidor:
```
ssh usuario@servidor
```
Para salir, ejecutamos el siguiente comando:
```
exit
```
Verificar que el usuario tiene permisos de sudoer:
```
groups usuario
```
Si no los tiene, ejecutamos los siguientes comandos:
```
sudo usermod -aG sudo usuario
```
## Instalación de Apache
### Preparación del servidor
#### Actualizar el sistema
```
sudo apt update
```
```
sudo apt upgrade
```
#### Instalar OpenSSH
```
sudo apt install openssh-server
```
#### Verificar el estado de ufw
```
sudo ufw status
```
#### Si no está activado
```
sudo ufw enable
```
#### Vemos las aplicaciones que tiene ufw
```
sudo ufw app list
```
#### Añadimos OpenSSH
```
sudo ufw allow OpenSSH
```
#### Comprobamos que está activado
```
sudo ufw status
```
### Instalación de Apache2
```
sudo apt install apache2
```
#### Añadir a ufw:
```
sudo ufw allow 'Apache Full'
```
#### Comprobar el estado de apache:
```
sudo systemctl status apache2
```
#### Verificar ip del servidor:
```
ip addr
```

### Comprobación de que funciona
#### Comprobar que se accede desde el cliente con curl:
```
curl http://ip-servidor
```
#### Comprobar que se accede desde el navegador del cliente: 
```
http://ip-servidor
```
#### Engañar al cliente para que acceda con un nombre de dominio
##### En Windows
```
C:\Windows\System32\drivers\etc
```
##### Modificamos el archivo hosts y añadimos la ip del servidor y el nombre de dominio:
```
ip-servidor nombre_dominio.com
```
##### En linux es igual pero en la ruta
```
sudo nano /etc/hosts
```

### Comandos de control de Apache
#### INICIAR
```
sudo systemctl start apache2
```
#### PARAR
```
sudo systemctl stop apache2
```
#### REINICIAR
```
sudo systemctl restart apache2
```
#### RECARGAR
```
sudo systemctl reload apache2
```
#### COMPROBAR ESTADO
```
sudo systemctl status apache2
```
#### COMPROBAR CONFIGURACIÓN
```
sudo apache2ctl configtest
```
#### ACTIVAR INICIO AL ARRANCAR EL SERVIDOR
```
sudo systemctl enable apache2
```
#### DESACTIVAR INICIO AL ARRANCAR EL SERVIDOR
```
sudo systemctl disable apache2
```
#### LISTAR MODULOS
```
sudo apache2ctl -M
```
#### LISTAR VIRTUALHOSTS
```
sudo apache2ctl -S
```
### Configuración de Apache
#### Configuración de los Virtualhosts
##### Crear directorio para el dominio
```
sudo mkdir /var/www/nombre_dominio
```
##### Modificar owner del directorio
```
sudo chown -R $USER:$USER /var/www/nombre_dominio
```
##### Modificar permisos del directorio
```
sudo chmod -R 755 /var/www/nombre_dominio
```
##### Crear archivo index.html
```
sudo nano /var/www/nombre_dominio/index.html
```
#### Añadir el siguiente código
```html
<html>
    <head>
        <title>Nombre Dominio</title>
    </head>
    <body>
        <h1>Funciona! Se accede desde nombre-dominio.com</h1>
    </body>
</html>
```
#### Copiar el archivo de configuración por defecto
```
sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/nombre_dominio.conf
```
#### Modificar el archivo de configuración que acabamos de copiar
```
sudo nano /etc/apache2/sites-available/nombre_dominio.conf
```
#### Añadir el siguiente código al archivo de configuración
```apache
<VirtualHost *:80> #escuchar a todas las peticiones que lleguen al puerto 80
    ServerAdmin webmaster@localhost #email del administrador
    ServerName nombre_dominio #nombre del dominio
    ServerAlias www.nombre_dominio #alias del dominio
    DocumentRoot /var/www/nombre_dominio #directorio donde se encuentra el contenido web
    
    ErrorLog ${APACHE_LOG_DIR}/nombre_dominio.error.log #directorio donde se guardan los logs de error
    CustomLog ${APACHE_LOG_DIR}/nombre_dominio.access.log combined #directorio donde se guardan los logs de acceso
</VirtualHost>
```
#### Por cada directorio se puede crear un archivo de configuración que sobreescriba la configuración del archivo de configuración del dominio
```
sudo nano /var/www/nombre_dominio/.htaccess
```
#### Añadir el siguiente código en el archivo .conf del dominio: ALL para permitir todo, NONE para denegar todo.
```apache
<Directory /var/www/nombre_dominio>
    AllowOverride All
</Directory>
```
#### Activar el sitio
```
sudo a2ensite nombre_dominio.conf
```
#### Desactivar el sitio por defecto
```
sudo a2dissite 000-default.conf
```
#### Comprobar que la configuración es correcta y reiniciar apache
```
sudo apache2ctl configtest
Syntax OK
sudo systemctl reload apache2
```
#### Comprobar que funciona
```
curl http://nombre_dominio
```
```
http://nombre_dominio
```
## Familiarizándose con APACHE2
### Carpeta de contenido web
```
/var/www/
```
### Configuración del server
#### Directorio de configuración
```
/etc/apache2/
```
#### Archivo de configuración principal
```
/etc/apache2/apache2.conf
```
#### Archivo de configuración de puertos
Se suelen configurar el puerto 80 (http) y el 443 (https)
```
/etc/apache2/ports.conf
```
#### Directorio de sitios disponibles
La configuración de este directorio solamente se pone en uso cuando el sitio se activa y se forma un link simbólico en la carpeta `/sites-enabled/`.
```
/etc/apache2/sites-available/
```
#### Habilitar un sitio
```
sudo a2ensite nombre_dominio.conf
```
#### Deshabilitar un sitio
```
sudo a2dissite nombre_dominio.conf
```
#### Directorio de sitios activos
Aquí se guardan los symlinks de los sitios activos.
Cada vez que se modifiquen hay que recargar la configuración de apache2.
```
/etc/apache2/sites-enabled/
```
#### Directorios de configuración
Los directorios de configuración disponible y configuración activa tienen la misma relación que los directorios de sitios disponibles y sitios activos.
```
/etc/apache2/conf-available/
```
```
/etc/apache2/conf-enabled/
```
Y sus comandos para habilitarlos y deshabilitarlos son:
```
sudo a2enconf archivo_de_configuracion.conf
```
```
sudo a2disconf archivo_de_configuracion.conf
```
#### Directorios de módulos
Además, también están los directorios de módulos disponibles y módulos activos:
```
/etc/apache2/mods-available/
```
```
/etc/apache2/mods-enabled/
```
Que siguen el mismo patrón:
```
sudo a2enmod nombre_modulo
```
```
sudo a2dismod nombre_modulo
```
Listar los módulos disponibles:
```
/etc/init.d/apache2 -l
```

### Logs
Los logs de apache se guardan en:
```
/var/log/apache2/
```
Cada request genera archivos de log en:
```
/var/log/apache2/access.log
```
Y los errores en:
```
/var/log/apache2/error.log
```
Además, cada sitio puede tener sus logs en el directorio que le hayamos introducido en las directivas ErrorLog y CustomLog.
```apache
ErrorLog ${APACHE_LOG_DIR}/nombre_dominio.error.log
```
```apache
CustomLog ${APACHE_LOG_DIR}/nombre_dominio.access.log combined
```

### Directivas de error
#### ErrorDocument
```apache
ErrorDocument 404 /error404.html
```
#### Redirect
```apache
Redirect 404 /error404.html
```
#### RedirectMatch
```apache
RedirectMatch 404 /error404.html
```
## Asegurando Apache
### Certificado SSL
#### Instalar el programa de certificación
```
sudo apt install certbot python3-certbot-apache
```
#### Obtener el certificado SSL
Nos hará varias preguntas, respondemos según lo que nos interese.
```
sudo certbot --apache
```
### Configuración de Apache para SSL
#### Crear un archivo de configuración para el dominio SSL
```
sudo nano /etc/apache2/sites-available/nombre_dominio-le-ssl.conf
```
#### Añadir el siguiente código al archivo de configuración SSL
```apache
<IfModule mod_ssl.c>
    <VirtualHost *:443>
        ServerAdmin webmaster@localhost
        ServerName nombre_dominio
        ServerAlias www.nombre_dominio
        DocumentRoot /var/www/nombre_dominio

        ErrorLog ${APACHE_LOG_DIR}/nombre_dominio.error.log
        CustomLog ${APACHE_LOG_DIR}/nombre_dominio.access.log combined

        Include /etc/letsencrypt/options-ssl-apache.conf
        SSLCertificateFile /etc/letsencrypt/live/nombre_dominio/fullchain.pem
        SSLCertificateKeyFile /etc/letsencrypt/live/nombre_dominio/privkey.pem
    </VirtualHost>
</IfModule>
```
#### Activar el sitio
```
sudo a2ensite nombre_dominio-le-ssl.conf
```
#### Comprobar que la configuración es correcta
```
sudo apache2ctl configtest
```
```
Syntax OK
```
#### Recargar la configuración de Apache
```
sudo systemctl reload apache2
```
#### Comprobar que funciona
```
curl https://nombre_dominio
```
```
https://nombre_dominio
```
### Certificado auto-firmado
#### Activar el modulo SSL
```
sudo a2enmod ssl
```
#### Reiniciar apache
```
sudo systemctl restart apache2
```
#### Crear el certificado TLS
```
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/nombre_dominio.key -out /etc/ssl/certs/nombre_dominio.crt
```
Nos hará varias preguntas, respondemos según lo que nos interese.
```
Country Name (2 letter code) [XX]:ES
State or Province Name (full name) []:Ejemplo
Locality Name (eg, city) [Default City]:Ejemplo 
Organization Name (eg, company) [Default Company Ltd]:Ejemplo Inc
Organizational Unit Name (eg, section) []:Ejemplo Dept
Common Name (eg, your name or your server's hostname) []:nombre_dominio_o_ip
Email Address []:webmaster@ejemplo.com
```
### Configurar apache para que use el certificado SSL
#### Crear un archivo de configuración para el dominio SSL
```
sudo nano /etc/apache2/sites-available/nombre_dominio-le-ssl.conf
```
#### Añadir el siguiente código al archivo de configuración SSL
```apache
<IfModule mod_ssl.c>
    <VirtualHost *:443>
        ServerAdmin webmaster@localhost
        ServerName nombre_dominio
        ServerAlias www.nombre_dominio
        DocumentRoot /var/www/nombre_dominio

        ErrorLog ${APACHE_LOG_DIR}/nombre_dominio.error.log
        CustomLog ${APACHE_LOG_DIR}/nombre_dominio.access.log combined

        SSLEngine on
        SSLCertificateFile /etc/ssl/certs/nombre_dominio.crt
        SSLCertificateKeyFile /etc/ssl/private/nombre_dominio.key
    </VirtualHost>
</IfModule>
```
#### Activar el sitio
```
sudo a2ensite nombre_dominio-le-ssl.conf
```
#### Redireccionar el tráfico HTTP a HTTPS
```
sudo nano /etc/apache2/sites-available/nombre_dominio.conf
```
#### Modificar el virtualhost
```apache
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    ServerName nombre_dominio
    ServerAlias www.nombre_dominio
    DocumentRoot /var/www/nombre_dominio

    ErrorLog ${APACHE_LOG_DIR}/nombre_dominio.error.log
    CustomLog ${APACHE_LOG_DIR}/nombre_dominio.access.log combined

    Redirect permanent / https://nombre_dominio/
</VirtualHost>
```
#### Comprobar que la configuración es correcta y reiniciar apache
```
sudo apache2ctl configtest
Syntax OK
sudo systemctl reload apache2
```
### Ocultar información de Apache
#### Abrir el archivo de configuración de seguridad
```
sudo nano /etc/apache2/conf-available/security.conf
```
#### Añadir las siguientes líneas al final
```apache
ServerTokens Prod
ServerSignature Off
```
#### Comprobamos la configuración y reiniciamos apache
```
sudo apache2ctl configtest
```
```
Syntax OK
```
```
sudo systemctl reload apache2
```
### Desactivar listado de directorios
#### Abrir el archivo de configuración de apache
```
sudo nano /etc/apache2/apache2.conf
```
#### Añadir las siguientes líneas
```apache
<Directory /var/www/>
    Options -Indexes
</Directory>
```
#### Comprobamos la configuración y reiniciamos apache
```
sudo apache2ctl configtest
Syntax OK
sudo systemctl restart apache2
```
### Desactivar el acceso a carpetas git
#### Abrimos la configuración de apache
```
sudo nano /etc/apache2/apache2.conf
```
#### Añadimos el siguiente código para denegar el acceso a las carpetas .git
```apache
<DirectoryMatch "^/.*/\.git/">
    Require all denied
</DirectoryMatch>
```
#### Añadimos el siguiente código para denegar el acceso a los archivos .git
```apache
<FilesMatch "^\.git">
    Require all denied
</FilesMatch>
```
#### Redirigimos las peticiones a los archivos .git a la página de error 404
```apache
RedirectMatch 404 /\.git
```
#### Comprobamos la configuración y reiniciamos apache
```
sudo apache2ctl configtest
Syntax OK
sudo systemctl restart apache2
```
### Directivas REQUIRE
### Las directivas REQUIRE se pueden usar en cualquier contexto de configuración de Apache.
#### ALL
Todos los usuarios, incluidos los anónimos.
```apache
Require all granted
```
```apache
Require all denied
```
#### LOCAL
Usuarios que se autentican con un módulo de autenticación local.
```apache
Require local
```
#### IP
Usuarios que se autentican desde una dirección IP o rango de direcciones IP.
```apache
Require ip 192.168.1.37
```
```apache
Require ip 192.168.1.0/24
```
#### HOST
Usuarios que se autentican desde un nombre de host o patrón de nombre de host.
```apache
Require host dominio.com
```
#### USER
Usuarios que se autentican con un módulo de autenticación local o externo. Requiere el módulo de autenticación.
```apache
Require user usuario
```
### Añadir autentificación básica
#### Instalar apache2-utils
```
sudo apt install apache2-utils
```
#### Listar los nombres de los servidores virtuales
```
cat /etc/apache2/sites-available/*.conf | grep ServerName
```
#### Crear archivo de contraseñas
La opción -c es sólo la primera vez que se crea el archivo, si ya existe no se pone. Te pedirá la contraseña de usuario.
```
sudo htpasswd -c /etc/apache2/.htpasswd usuario
```
#### Añadir al archivo de contraseñas
```
sudo htpasswd /etc/apache2/.htpasswd usuario
```
#### Verificar que se ha añadido
```
cat /etc/apache2/.htpasswd
```
#### Editar el archivo de configuración del dominio
```
sudo nano /etc/apache2/sites-available/nombre_dominio.conf
```
#### Añadir el siguiente código
`AuthType Basic` establece el tipo de autenticación.

`AuthName` es el mensaje que verán los usuarios al solicitarles la autenticación.

`AuthUserFile` especifica la ruta al archivo de contraseñas.

`Require valid-user` indica que cualquier usuario válido en el archivo puede acceder.
```apache
<Directory /var/www/nombre_dominio>
    AuthType Basic
    AuthName "Contenido restringido"
    AuthUserFile /etc/apache2/.htpasswd
    Require valid-user
</Directory>
```
#### Comprobamos la configuración y reiniciamos apache
```
sudo apache2ctl configtest
Syntax OK
sudo systemctl restart apache2
```
## Ver informes de estado
#### Habilitar `mod_status`
```
sudo a2enmod status
```
#### Modificar el archivo de configuración de apache
```
sudo nano /etc/apache2/apache2.conf
```
#### Añadir las siguientes líneas
Si queremos mejorar la seguridad, cambiamos `/server-status` por una ruta que sólo nosotros conozcamos.
```apache
<Location /server-status>
    SetHandler server-status
    Require host dominio.com
</Location>
```
#### Comprobamos la configuración y reiniciamos apache
```
sudo apache2ctl configtest
Syntax OK
sudo systemctl restart apache2
```

## Ejecutar apache con varios usuarios
### Instalar MPM-ITK
```
sudo apt-get install libapache2-mpm-itk
```
### Habilitar MPM-ITK
```
sudo a2enmod mpm_itk
```
Si da error porque hay otros módulos MPM, deshabilitarlos;
```
sudo a2dismod mpm_event
sudo a2dismod mpm_prefork
sudo a2dismod.... los que liste el error
```
### Configurar MPM-ITK para cada sitio
```
sudo nano /etc/apache2/sites-available/nombre_dominio.conf
```
Añadir las siguientes líneas:
```apache
<IfModule mpm_itk_module>
    AssignUserId usuario grupo
</IfModule>
```
### Asignar propietario y permisos a los directorios de los sitios
```
sudo chown -R usuario:grupo /var/www/nombre_dominio
```
```
sudo chmod -R 755 /var/www/nombre_dominio
```
### Comprobamos la configuración y reiniciamos apache
```
sudo apache2ctl configtest
Syntax OK
sudo systemctl restart apache2
```

## MySQL
### Instalación de MySQL
Para instalar MySQL, ejecutamos los siguientes comandos:
```
sudo apt install mysql-server
```
Si tras la instalación no podemos iniciar el comando `mysql_secure_installation`, ejecutamos los siguientes comandos:
```
sudo mysql
```
Una vez en la consola de MySQL, ejecutamos los siguientes comandos:
```mysql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
```
```mysql
FLUSH PRIVILEGES;
```
```
exit
```
Y volvemos a intentar iniciar el comando `mysql_secure_installation`.

Nos pregunta si queremos instalar el plugin Validate Password, le decimos que no.

Nos pregunta si queremos cambiar la contraseña del usuario root, le decimos que sí.

Nos pregunta si queremos eliminar los usuarios anónimos, le decimos que sí.

Nos pregunta si queremos desactivar el inicio de sesión remoto del usuario root, le decimos que sí.

Nos pregunta si queremos eliminar la base de datos de prueba, le decimos que sí.

Nos pregunta si queremos recargar los privilegios de las tablas, le decimos que sí.

## MariaDB
### Instalación de MariaDB
Sigue la misma guía que MySQL, pero en vez de instalar el paquete `mysql-server`, instalamos el paquete `mariadb-server`.
```
sudo apt install mariadb-server
```
El resto de la guía es igual. Si ya tenemos instalado MySQL, MariaDB nos dirá que ya está instalado y nos preguntará si queremos sustituirlo por MariaDB, le decimos que sí.

## BACKUPS DE MYSQL Y DE APACHE
### BACKUP DE MYSQL
#### Crear backup
```
sudo mysqldump -u root -p nombre_bd > /home/usuario/nombre_backup.sql
```
#### Crear backup con fecha
```
sudo mysqldump -u root -p nombre_bd > /home/usuario/nombre_backup-$(date +%Y%m%d).sql
```
#### Restaurar backup
```
sudo mysql -u root -p nombre_bd < /home/usuario/nombre_backup.sql
```
### BACKUP DE APACHE
#### Crear backup
```
sudo tar -czvf /home/usuario/nombre_backup.tar.gz /var/www/nombre_dominio
```
#### Restaurar backup
```
sudo tar -xzvf /home/usuario/nombre_backup.tar.gz -C /var/www/nombre_dominio
```
### AUTOMATIZAR EL PROCESO
#### Crear un archivo bash
```
sudo nano /home/usuario/backup_nombre_dominio.sh
```
#### Añadir el siguiente código
```bash
#!/bin/bash
#Variables de la BD
DB_USER="root"
DB_PASS="password"
DB_NAME="nombre_bd"

#Directorios
BACKUP_DIR="/home/usuario/backups"
APACHE_DIR="/var/www/nombre_dominio"

#Fechas
DATE=$(date +%Y%m%d)

#Backup de la BD
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_backup_$DB_NAME-$DATE.sql

#Backup de Apache
tar -czvf $BACKUP_DIR/apache_backup_$DATE.tar.gz $APACHE_DIR

echo "Backup realizado: $DATE"
```

#### Dar permisos de ejecución al archivo
```
sudo chmod +x /home/usuario/backup_nombre_dominio.sh
```

#### Ejecutar el archivo
```
sudo /home/usuario/backup_nombre_dominio.sh
```

#### Se puede establecer un cron
```
sudo crontab -e
```
#### Añadir la siguiente línea
Todos los días a las 2:00 am
```
0 2 * * * /home/usuario/backup_nombre_dominio.sh
```
#### Verificar crontab
```
sudo crontab -l
```
## PHP
### Descarga de PHP
```
sudo apt install php libapache2-mod-php php-mysql
```
### Comprobación de PHP
```
php -v
```
```
PHP 8.1.2 (cli) (built: Mar  4 2022 18:13:46) (NTS)
Copyright (c) The PHP Group Zend Engine v4.1.2, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.2, Copyright (c), by Zend Technologies
```
### Configurando apache para PHP
Los archivos .html tienen prioridad sobre los archivos .php, por lo que si tenemos un archivo index.html y un archivo index.php, se mostrará el index.html.


Para cambiar esto y que se muestre el index.php de forma global
#### Abrimos el archivo de configuración de directorios
```
sudo nano /etc/apache2/mods-enabled/dir.conf
```
#### Cambiamos el orden de los archivos
```apache
<IfModule mod_dir.c>
    DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
</IfModule>
```
Si queremos que esta configuración sea para un dominio en concreto, modificamos el archivo de configuración del dominio:
#### Abrimos el archivo de configuración de un dominio
```
sudo nano /etc/apache2/sites-available/nombre_dominio.conf
```
#### Cambiamos el orden de los archivos
```apache
DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
```
#### Comprobamos la configuración y reiniciamos apache
```
sudo apache2ctl configtest
```
```
Syntax OK
```
```
sudo systemctl restart apache2
```
### Comprobación de PHP
#### Creamos un archivo php
```
sudo nano /var/www/nombre_dominio/info.php
```
#### Añadimos el siguiente código
```php
<?php
phpinfo();
```
#### Comprobamos que funciona
```
http://nombre_dominio/info.php
```
Y deberá salir una página con información sobre la versión de PHP instalada y su configuración.

***IMPORTANTE*** borrar el archivo info.php una vez comprobado que funciona:
```
sudo rm /var/www/nombre_dominio/info.php
```
Es un archivo que no se debe dejar en el servidor.
## Composer
### Instalación de Composer, prerrequisitos
```
sudo apt install php-cli unzip
```
### Instalación de Composer
```
cd ~
```
```
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
```
### Verificación de la integridad de Composer
```
HASH=$(curl -sS https://composer.github.io/installer.sig)
```
```php
php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') {
    echo 'Installer verified'; 
} else { 
    echo 'Installer corrupt';
    unlink('composer-setup.php'); 
} 
echo PHP_EOL;"
```
```
Installer verified
```
### Lo instalamos de forma global
```
sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
### Comprobamos que funciona
```
composer
```
```
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
Composer version 2.3.5 2022-04-13 16:43:00
```
### Uso de Composer
#### Crear un archivo JSON
```
nano composer.json
```
#### Añadir el siguiente código
```json
{
    "require": {
      "paquete/paquete": "^version.version", 
      "paquete2/paquete2": "^version.version"
    }
}
```
#### Ejecutar el siguiente comando desde la raíz del proyecto donde está el archivo composer.json
```
composer install
```
#### Actualizar paquetes
```
composer update
```
#### Eliminar paquetes
```
composer remove paquete/paquete
```
#### Añadir un paquete
```
composer require nombre/paquete
```

## PHPMailer
### Instalación de PHPMailer
```
composer require phpmailer/phpmailer
```
### Uso de PHPMailer
#### Crear un archivo php
```
nano /var/www/nombre_dominio/enviar_correo.php
```
#### Añadir el siguiente código
```php
<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    //Configuración del servidor
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.ejemplo.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'tu_email@ejemplo.com';                 
    $mail->Password   = 'tu_contraseña';                           
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;                                    

    //Destinatarios
    $mail->setFrom('de@ejemplo.com', 'Mailer');
    $mail->addAddress('a@ejemplo.com', 'Joe User');     

    //Contenido
    $mail->isHTML(true);                                  
    $mail->Subject = 'Asunto del email';
    $mail->Body    = 'Este es el cuerpo del mensaje <b>en HTML!</b>';
    $mail->AltBody = 'Este es el cuerpo del mensaje en texto plano para clientes de correo no HTML';

    $mail->send();
    echo 'Mensaje enviado';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
}
```

## MYSQL
### Conectamos a root
```
sudo mysql
```
### Creamos una BD
```mysql
CREATE DATABASE nombre_bd;
```
### Creamos un usuario
```mysql
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'password';
```
### Le damos permisos
```mysql
GRANT ALL ON nombre_bd.* TO 'usuario'@'localhost';
```
### Salimos de mysql
```
exit
```
### Conectamos a la cuenta del usuario
```
mysql -u usuario -p
```
### Si nos hemos equivocado de contraseña, podemos cambiarla
```mysql
ALTER USER 'usuario'@'localhost' IDENTIFIED BY 'password';
```
### Mostrar las BD:
```mysql
SHOW DATABASES;
```
### Seleccionar la BD que creamos
```mysql
USE nombre_bd;
```
### Mostramos las tablas
```mysql
SHOW TABLES;
```
### Creamos una tabla
```mysql
CREATE TABLE nombre_tabla (
    id INT NOT NULL AUTO_INCREMENT,
    contenido VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);
```
### Insertamos datos en la tabla varias veces con diferentes valores
```mysql
INSERT INTO nombre_tabla (contenido) VALUES ('Loqueunoquiera');
```
### Mostramos los datos de la tabla
```mysql
SELECT * FROM nombre_tabla;
```
### Salimos de mysql
```
exit
```
### Creamos un archivo php
```
sudo nano /var/www/nombre_dominio/todo_list.php
```
### Añadimos el siguiente código php y rellenamos los datos con los de nuestra BD:
```php
<?php
$user = "example_user";
$password = "password";
$database = "nombre_bd";
$table = "nombre_tabla";

try {
  $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
  echo "<h2>TODO</h2><ol>"; 
  foreach($db->query("SELECT contenido FROM $table") as $row) {
    echo "<li>" . $row['contenido'] . "</li>";
  }
  echo "</ol>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
```
### Comprobamos que se conecta a la BD y muestra los datos
```
http://nombre_dominio/todo_list.php
```
## INSTALAR MKDOCS
Direción web: https://www.mkdocs.org/
### Guía de instalación
Comprobamos la versión de python y de pip:
```
python --version
```
```
pip --version
```
Si no están instalados, ejecutamos los siguientes comandos:
```
sudo apt install python3
```
```
sudo apt install python3-pip
```
```
pip install --upgrade pip
```
Para instalar mkdocs, ejecutamos los siguientes comandos:
```
sudo apt install mkdocs
```
Para comprobar que se ha instalado correctamente, ejecutamos los siguientes comandos:
```
mkdocs --version
```
### Guía de uso
Consultar la carpeta mkdocs y el archivo [getting-started.md](mkdocs/getting-started.md)
Ejemplo de virtualhost para mkdocs:
```apache
<VirtualHost *:80>
    ServerName mydocs.com
    DocumentRoot /var/www/my-docs
    <Directory "/var/www/my-docs/site">
        Options -Indexes
        AllowOverride None
        Order allow, deny
        Allow from all
        </Directory>
        
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
## USAR SCP PARA COPIAR ARCHIVOS
```
scp -r /home/usuario/archivo usuario@servidor:/home/usuario/archivo
```
### OPCIONES
#### -r
Copiar directorios y sus contenidos de manera recursiva.
```
scp -r /home/usuario/archivo usuario@servidor:/home/usuario/archivo
```
#### -v
Mostrar el progreso de la copia.
```
scp -v /home/usuario/archivo usuario@servidor:/home/usuario/archivo
```
#### -C
Comprimir los datos durante la copia.
```
scp -C /home/usuario/archivo usuario@servidor:/home/usuario/archivo
```
#### -P
Especificar el puerto si es distinto al 22 habitual.
```
scp -P 2222 /home/usuario/archivo usuario@servidor:/home/usuario/archivo
```
#### -i
Especificar la ruta del archivo de clave privada.
```
scp -i /home/usuario/.ssh/id_rsa /home/usuario/archivo usuario@servidor:/home/usuario/archivo
```

## PHPDocumentor
https://www.phpdoc.org/
### Instalación

```
sudo apt install php-mbstring
```
```
mkdir /home/usuario/phpDocs && cd /home/usuario/phpDocs
```
```
wget https://phpdoc.org/phpDocumentor.phar
```
```
chmod u+x phpDocumentor.phar
```
```
sudo mv phpDocumentor.phar /usr/local/bin/phpdoc
```
```
phpdoc --version
```
### Uso
#### Para directorios
```
phpdoc run -d /home/usuario/donde_están_los_archivos_a_documentar -t /home/usuario/directorio_destino/docs
```
#### Para archivos
```
phpdoc run -f /home/usuario/donde_está_el_archivo_a_documentar.php -t /home/usuario/directorio_destino/docs
```
### Ejemplo
Probar con este archivo;
```php
<?php
    
    namespace src;
    
    use Exception;
    
    /**
     * Clase base para implementar el patrón de diseño Singleton.
     * Impide la creación directa, clonación y deserialización de sus instancias.
     * Utiliza getInstance() para obtener o crear instancias basadas en argumentos.
     *
     * @see     Logger
     * @access  public
     * @package src
     * @author  Daniel Alonso Lázaro <dalonsolaz@gmail.com>
     * @link    https://es.wikipedia.org/wiki/Singleton
     */
    class Singleton
    {
        /**
         * Almacena instancias de la clase o sus subclases.
         *
         * @var array
         */
        private static array $instancias = [];
        
        /**
         * Constructor protegido para prevenir la instanciación directa.
         *
         * @param mixed $args Argumentos para la construcción de la instancia.
         */
        protected function __construct(...$args)
        {
        }
        
        /**
         * Devuelve una instancia de la clase o subclase llamada.
         * Crea la instancia si no existe, o devuelve la existente.
         *
         * @param mixed ...$args Argumentos para la construcción de la instancia.
         *
         * @return static Instancia de la clase llamada.
         */
        public static function getInstance(...$args): Singleton
        {
            $subclase = static::class;
            $key = $subclase . ':' . serialize($args);
            if (!isset(self::$instancias[$key])) {
                self::$instancias[$key] = new static(...$args);
            }
            return self::$instancias[$key];
        }
        
        /**
         * Impide la deserialización de instancias para mantener la unicidad y seguridad.
         * Registra un intento de deserialización como una excepción en el log.
         *
         * @throws Exception Si se intenta deserializar la instancia.
         */
        public function __wakeup()
        {
            Logger::log("No se puede deserializar un objeto singleton.", __FILE__, LogLevels::EXCEPTION);
            throw new Exception("No se puede deserializar un objeto singleton.");
        }
        
        /**
         * Impide la clonación de la instancia para mantener la unicidad.
         */
        protected function __clone(): void
        {
        }
    }
```
Y ya decirle donde tenemos los sources y donde queremos los docs
```
php run -f /ruta/al/archivo/Singleton.php -t /ruta/a/donde/queremos/los/docs
```

## WORDPRESS
### Instalación de Wordpress
#### Descargar Wordpress
```
mkdir /var/www/nombre_dominio
```
```
cd /var/www/nombre_dominio
```
```
wget https://wordpress.org/latest.tar.gz
```
#### Descomprimir Wordpress
```
tar -xzvf latest.tar.gz
```
#### Crear la base de datos
```
sudo mysql -u root -p
```
```mysql
CREATE DATABASE wordpress DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
```
```mysql
CREATE USER 'wordpressuser'@'localhost' IDENTIFIED BY 'password';
```
```mysql
GRANT ALL ON wordpress.* TO 'wordpressuser'@'localhost';
```
```mysql
FLUSH PRIVILEGES;
```
```
exit
```
#### Instalar extensiones de PHP
```
sudo apt install php-curl php-gd php-mbstring php-xml php-xmlrpc php-soap php-intl php-zip
```
#### Reiniciar Apache
```
sudo systemctl restart apache2
```
#### Configurar Apache
```
sudo nano /etc/apache2/sites-available/wordpress.conf
```
#### Añadir el siguiente código
```apache
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    ServerName nombre_dominio
    ServerAlias www.nombre_dominio.com
    DocumentRoot /var/www/nombre_dominio/wordpress

    ErrorLog ${APACHE_LOG_DIR}/nombre_dominio.error.log
    CustomLog ${APACHE_LOG_DIR}/nombre_dominio.access.log combined

    <Directory /var/www/nombre_dominio/wordpress>
        AllowOverride All
    </Directory>
</VirtualHost>
```
#### Activar el modulo rewrite
```
sudo a2enmod rewrite
```
#### Comprobar la configuración y reiniciar apache
```
sudo apache2ctl configtest
Syntax OK
sudo systemctl restart apache2
```
#### Configurar Wordpress
```
sudo chown -R www-data:www-data /var/www/wordpress
```
```
sudo find /var/www/wordpress/ -type d -exec chmod 750 {} \;
```
```
sudo find /var/www/wordpress/ -type f -exec chmod 640 {} \;
```
#### Bajarse las claves de seguridad
```
curl -s https://api.wordpress.org/secret-key/1.1/salt/
```
#### Copiar el contenido de las claves de seguridad
Encontrar la parte donde pone los define de las claves y sustituir por el resultado del curl.
```
sudo nano /var/www/wordpress/wp-config.php
```
#### Configurar el acceso a la BD
```php
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpressuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );


. . .

define('FS_METHOD', 'direct');
```
#### Continuar desde el instalador web
```
https://nombre_dominio
```
## CONFIGURAR FAIL2BAN
### Instalación de fail2ban
```
sudo apt install fail2ban
```
### Configuración de fail2ban
#### Crear una 'cárcel' local
```
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local
```
#### Editar el archivo de configuración
```
sudo nano /etc/fail2ban/jail.local
```
#### Buscar la cabecera `[DEFAULT]` y verificar
```
[DEFAULT]
. . .
bantime = 10m
findtime = 10m
maxretry = 5
destemail = root@localhost
sender = root@<fq-hostname>
mta = sendmail
action = $(action_)s
. . .
```
#### Buscar la cabecera `[sshd]` y verificar
```
[sshd]
. . .
enabled = true
port = ssh
filter = sshd
logpath = /var/log/auth.log
maxretry = 3
. . .
```
#### Cuando se haya comprobado todo, activar y arrancar fail2ban
```
sudo systemctl enable fail2ban
```
```
sudo systemctl start fail2ban
```
#### Comprobar el estado de fail2ban
```
sudo systemctl status fail2ban
```
#### Para ver los baneos
```
sudo iptables -S | grep f2b
```
