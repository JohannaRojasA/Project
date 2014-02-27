<?php 

 /*
  LEE LOS DATOS DEL ARCHIVO .csv Y ME LOS INSERTA EN LA BASE DE DATOS MYSQL
 */

function Conectarse() //Función para conectarse a la BD
{
       if (!($link=mysql_connect("localhost","root","")))  { 
           echo "Error conectando a la base de datos.";
           exit();
       }
        if (!mysql_select_db("proyecto1",$link)) {
            echo "Error seleccionando la base de datos.";
           exit();
       }
       return $link;
}

$row = 1;
date_default_timezone_set("America/Costa_Rica");
$file=date("dmY");//para obtener la fecha del servidor
$handle = fopen($file.'.csv', "r"); //Coloca el nombre de tu archivo .csv que contiene los datos
while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { //Lee toda una linea completa, e ingresa los datos en el array 'data'
    $num = count($data); //Cuenta cuantos campos contiene la linea (el array 'data')
    $row++;
    $cadena = "insert into estudiante(nombre,apellido,correo,telefono,cedula) values("; 
    //$data[$c]=str_replace('\'',' ',$data[$c]);
    for ($c=0; $c < $num; $c++) { 
        if ($c==($num-1))
              $cadena = $cadena."'".$data[$c] . "'";
        else
              $cadena = $cadena."'".$data[$c] . "',";
    }

    $cadena = $cadena.");"; //Termina de armar la cadena para poder ser ejecutada
    echo $cadena."\n";  //Muestra la cadena para ejecutarse
     $enlace=Conectarse();
     $result=mysql_query($cadena, $enlace); //se ejecuta con MySQL la cadena del insert formada
     echo "Datos ingresados a la base de datos.";
     mysql_close($enlace);
}

fclose($handle);

#para llamar el script .JSON, envío de correos
/*$str_datos = file_get_contents("parametros.json");
$datos = json_decode($str_datos,true);


$fh = fopen("datos_out.json", 'w')
      or die("Error al abrir fichero de salida");
fwrite($fh, json_encode($datos,JSON_UNESCAPED_UNICODE));
fclose($fh);*/
 ?>