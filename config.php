<?php
ini_set('session.cookie_httponly', 0 );
ini_set('session.session.use_only_cookies', 1 );
ini_set('session.cookie_lifetime', 0 );
ini_set('session.cookie_secure', 0 );
ini_set('display_errors',0);
ini_set('display_startup_erros',0);

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
  
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/crud_Joseliano');

define('DB_HOST', "localhost:3306");
define('DB_USER', "root");
define('DB_PASSWORD', "admin");
define('DB_BASE', "teste_crud");
 
 
require DOC_ROOT_PATH. "/class/db_Acao.php";
require DOC_ROOT_PATH. "/class/db_Util.php";

include (DOC_ROOT_PATH. "/class/UF.php");
include (DOC_ROOT_PATH. "/class/Localidade.php");
include (DOC_ROOT_PATH. "/class/Usuario.php");
include (DOC_ROOT_PATH. "/class/Usuario_Telefone.php");

 