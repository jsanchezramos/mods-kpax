# MODS ELGG PARA KPAX

Estos módulos son necesarios para el funcionamiento de kpax en la plataforma elgg:
- loginrequired, oculta todas las páginas de Elgg, excepto las de inicio, registro y olvido del password, al usuario no autenticado.
- kpax, contiene los webservices necesarios para interactuar desde fuera con el servidor elgg interno
- apiadmin, genera y gestiona los certificados para la autenticación
- likeKpax, gestiona las anotaciones 'me gusta' en los objetos kPax

# Requisitos
Para un correcto funcionamiento se necesita:
mysql 5
php5

Y tener instalada la plataforma elgg (http://elgg.org/download.php)

# Instalación
Es preciso descargar los módulos:

    git checkout o se descargan por otras vias. 
    
Tienen la estructura de ficheros /elgg/etc... es decir que deben ser copiados en la carpeta mod de la plataforma elgg, 
copiar todo el contenido a la carpeta mod de elgg

# CONFIGURACION

Una vez puesto el contenido en la carpeta mod, se deben activar. Para ello hay que acceder a la administración de la plataforma elgg y activar los diferentes plugins.

Una vez activados se deben generar las keys para poder interactuar entre los servicios y los plugins.

Acceder a:

    api administration

El sistema pide un nombre, se debe entrar kpax, proporcionará dos valores: public key y private key. La que hay que usar es la public key, la private la utiliza el propio elgg.
A continuación hay que editar el archivo: 

    /www/elgg/mods/kpax/lib/kpaxSrv.php y modificar la linea donde aparece $apikey = ... cambiar por el valor obtenido de public key.
    
Lo mismo en la parte de servicios:

    /src/main/java/uoc/edu/svrKpax/util/ConstantsKPAX.java y modificar la linea donde aparece public final static String ELGG_API_KEY =".... cambiar también por el valor obtenido.

Una vez esto configurado ya se pueden utilizar los plugins elgg en el servicio kpax


# INCIDENCIAS

Si tenéis alguna incidencia no dudéis enviar un correo a vuestro responsable

# LICENSE

Universitat Oberta de catalunya