## Json Web tokens

Proyecto de pruebas de concepto sobre el uso de Json Web Tokens

El proyecto es creado con el framework Laravel de PHP

### Instalación

Para la instalación se necesita:
* Una base de datos MySQL o MariaDB
* Un servidor web Nginx o Apache
* Lenguaje de programación PHP ^7.3|^8.0
* Gestor de paquetes Composer

Se debe colocarl el document root del servidor web en la carpeta public del proyecto, se ejectua en la raíz del proyecto
el comando '''composer install''', se debe copiar el archivo ".env.example" a ".env" y colocar las respestivas credenciales
de acceso de base de datos.

### Configuración JWT

En el archivo .env se debe ajustar la siguiente información:

* JWT_ALG=RS256 -> algoritmo que se utilizará para el firmado o cifrado del token
* JWT_SECRET=secret -> clave secreta para algoritmos cifrados
* JWT_PUBLIC_KEY=keys/public -> clave pública para algoritmos encriptados
* JWT_PRIVATE_KEY=keys/private -> clave privada para algoritmos encriptados

En el caso de que el algoritmo sea HS256 o similares la aplicación usará el valor JWT_SECRET.
En el casi de que el algoritmo sea RS256 o similares la aplicación usará los valores JWT_PUBLIC_KEY, JWT_PRIVATE_KEY
que contienen la dirección de los archivos de claves, se recomienda el uso del directorio keys en la raíz del proyecto
y el mismo no debe ser versionado.
