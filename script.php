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
#para buscar el nombre del archivo con la fecha actual
date_default_timezone_set("America/Costa_Rica");
$file=date("dmY");//para obtener la fecha del servidor
$info = fopen($file.'.csv', "r"); //se abre el csv
while (($data = fgetcsv($info, 1000, ";")) !== FALSE) { //Lee toda una linea completa, e ingresa los datos en el array 'data'
    $num = count($data); //cuenta cuantos campos contiene la linea (el array 'data')
    $row++;
    $cadena = "insert into estudiante(nombre,apellido,correo,telefono,cedula) values("; 

    for ($c=0; $c < $num; $c++) { //Aquí va colocando los campos en la cadena, si aun no es el último campo, le agrega la coma (,) para separar los datos
        if ($c==($num-1))
              $cadena = $cadena."'".$data[$c] . "'";
        else
              $cadena = $cadena."'".$data[$c] . "',";
    }

    $cadena = $cadena.");"; //Termina de armar la cadena para poder ser ejecutada
    echo $cadena."\n";  //Muestra la cadena a ejecutarse en la consola 
     $enlace=Conectarse(); //llamo la función para conectar a la BD
     $result=mysql_query($cadena, $enlace); //se ejecuta con MySQL la cadena del insert formada
     echo "\n";
     mysql_close($enlace);
}

fclose($info);
echo "Datos ingresados a la base de datos";

#para llamar el script .JSON, envío de correos
/*$str_datos = file_get_contents("parametros.json");
$datos = json_decode($str_datos,true);

echo "DB" . $datos["data_base"]["mail"];
*/
 ?>