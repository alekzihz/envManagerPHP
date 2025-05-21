<?php
$envFile = __DIR__ . "/.env";


// Carga y define las constantes de configuración si aún no están definidas
if (!defined('DB_USER')) {
    try {

        //lee y verifica el archivo .env
        $config = loadConfig($envFile);

        //setea las variables de la aplicación
        defineConstants($config);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}


function loadConfig($file)
{
    if (!file_exists($file)):
        throw new Exception("No se ha encontrado el archivo .env");
    endif;
    $data = parse_ini_file($file);
    if ($data === false):
        throw new Exception("Error al leer el archivo .env");
    endif;
    return $data;
}

// Define constantes globales basadas en el entorno
function defineConstants($config)
{
    // Dominios de producción y desarrollo
    $dominiosProduccion = [
        "midominio.com" => true,
    ];

    $dominiosDesarrollo = [
        "localhost" => true,
    ];



    define("DOMINIOS_PRODUCCION", $dominiosProduccion);
    define("DOMINIOS_DESARROLLO", $dominiosDesarrollo);
    define('DB_NAME', $config['DB_NAME']);


    $url = $_SERVER["SERVER_NAME"];
    $dominioActual = $url;
    $dominioParsed = parsingUrl($url); // Extrae el dominio de la URL

    // Modo online o desarrollo
    define('ONLINE', isset($config['ONLINE']) ? $config['ONLINE'] : false);
    define("DOMINIO_PARSED", $dominioActual);

    if (!isset(DOMINIOS_DESARROLLO[$dominioParsed])):
        define('DB_USER', $config['DB_USER_PRO']);
        define('DB_PASS', $config['DB_PASS_PRO']);
        define('FOLDER_NAME', $config['FOLDER_NAME_PRO']);

    else:
        define('DB_USER', $config['DB_USER']);
        define('DB_PASS', $config['DB_PASS']);
        define('FOLDER_NAME', $config['FOLDER_NAME']);
    endif;

    // Captchas según entorno
    if (!ONLINE) {
        define('SECRET', $config['CAPTCHA_SECRET']);
        define('SITEKEY', $config['CAPTCHA_SITEKEY']);
    } else {
        define('SECRET', $config['CAPTCHA_SECRET_PRO']);
        define('SITEKEY', $config['CAPTCHA_SITEKEY_PRO']);
    }
    // Dominio explícito o el actual
    define('DOMINIO', (!isset($config['DOMINIO']) || $config['DOMINIO'] == "")
        ? $dominioActual
        : $config['DOMINIO']);

    // Idiomas
    define('IDIOMES_WEB', $config['IDIOMES_WEB']);
    define('IDIOMES_WEB_ADMIN', $config['IDIOMES_WEB_ADMIN']);

    // API externa y correo
    define("API_EXT_OPENAI", $config['KEY_OPENAI']);
    define('FROM_MAIL', $config['FROM_MAIL']);
}


/*
     * función que devuelve el dominio de la url actual
     * @parameter $url
     * retorna de alias.dominio.com  a dominio.com
     * */
function parsingUrl($url)
{
    $url = explode(".", $url);
    /**
     * @parameter $url
     * @parameter $url[0] = alias
     * @parameter $url[1] = dominio
     * @parameter $url[2] = com
     *
     *
     * seleccionamos los 2 ultimos elementos del array anunzia.com por ejemplo
     */
    return implode(".", array_slice($url, -2, 2)); // Extrae el dominio de la URL

}
