# MODS ELGG PARA KPAX

Estos módulos son necesario para el correcto funcionamiento de kpax en la plataforma elgg

# Requisitos

Para un correcto funcionamiento se necesita:

mysql 5

php5

Y tener instalado la plataforma elgg (http://elgg.org/download.php)

# Instalación

Nos descargamos los módulos:

    git checkout o nos lo descargamos 
    
Como podeis ver tiene la estructura de ficheros /elgg/etc... eso quiere decir que lo tenéis que copiar en la carpeta mod de la plataforma elgg

    copiar todo el contenido a la carpeta mod de elgg

# CONFIGURACION

Una vez tenéis puesto el contenido a la carpeta mod,s los tenéis que activar. Para activar tenéis que ir a administración de la plataforma elgg y activar los diferentes plugins.

Cuando los tengáis instalados tenéis que generar las key,s para poder interactuar entre los servicios y los plugins.

os dirigís:

    api administration

Aquí os pedirá poner un nombre, ponéis kpax, os dará dos valores public key y private key. La que usareis es la public key, la private la utiliza el propio elgg.

Ahora tenéis que ir al archivo: 

    /www/elgg/mods/kpax/lib/kpaxSrv.php y modificar la linea donde aparece $apikey = ... y modificar por el valor que has obtenido.
    
Lo mismo en la parte de servicios:

    /src/main/java/uoc/edu/svrKpax/util/ConstantsKPAX.java y modificar la linea donde aparece public final static String ELGG_API_KEY =".... y modificas por el valor obtenido.

Una vez tenéis esto configurado ya podéis utilizar los plugins elgg utilizando vuestro servicio kpax


# INCIDENCIAS

Si tenéis alguna incidencia no dudéis enviar un correo a vuestro responsable

# LICENSE

Universitat Oberta de catalunya