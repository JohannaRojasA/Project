<?php
 /*
  SE OBTIENEN LOS DATOS QUE SON INGRESADOS A TRAVÉS DEL FORMULARIO, CREA EL ARCHIVO .csv Y ESCRIBE LOS DATOS INGRESADOS
 */
	$name = $_POST["name"];
	$lastname = $_POST["lastname"];
	$email=$_POST["email"];
	$telephone=$_POST["telephone"];
	$idcardnumber=$_POST["idcardnumber"];
	date_default_timezone_set("America/Costa_Rica");
	$file=date("dmY");//para obtener la fecha del servidor

	$miarchivo=fopen($file.'.csv','a');//se crea el archivo con la fecha del servidor
	$separador = ";";//separador para dar formato de .csv
	$linea = $name.$separador.$lastname.$separador.$email.$separador.$telephone.$separador.$idcardnumber."\n"; //aplico el formato .csv insertando en las lineas
	fwrite($miarchivo, $linea);//se escriben los datos ingresados en el archivo
	echo "Los datos ingresados han sido guardados en el archivo: \"$file.csv\"";
	fclose($miarchivo); //cerrar archivo


?>  