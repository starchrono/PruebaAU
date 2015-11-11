<?php

  //Generar un string JSON de respuesta desde mySQL y PHP

    //hacer una conexion a la base de datos

    $host = "localhost";
    $usuario = "root";
    $pass = "b166er";
    $bd = "musica";

    //Línea que conecta a la base de datos
    $servidor = mysql_connect ($host, $usuario, $pass);

    //formato de datos para la conexion
    //para aceptar símbolos y acentos
    mysql_set_charset("utf8", $servidor);
    // Entiéndase como "hacer conexion a la base de datos con los datos
    // dados en la parte de servidor"
    $conexion = mysql_select_db($bd, $servidor);

    //Se prepara peticion
    $consulta = "SELECT * FROM lista";
    $sql = mysql_query($consulta);

    if (!$sql){
      echo "Conexión Abortada // No SQL".mysql_error();
      die;
    }

    //3_Se declara un arreglo
    $datos= array();

          //SE genera el archivo JSON
    while ($obj = mysql_fetch_object($sql)) {
      $datos[] = array('ID' => $obj->ID,
               'Banda' => utf8_encode($obj->Banda),
               'Cancion' => $obj->Cancion,
        );
    }

    echo '' . json_encode($datos) . '';

    mysql_close($servidor);//Se cierra la conexion

    //Se declara que esta es una aplicacion que genera un JSON
    header('Content-type: application/json');
    //Se abre el acceso a las conexiones que requieran de esta aplicacion
    header("Access-Control-Allow-Origin: *");

?>
