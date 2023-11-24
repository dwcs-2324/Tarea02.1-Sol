<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tarea02.1 Apartado 2</title>
</head>
<body>
<h1>Tarea02.1 Apartado 2</h1>

<?php

const DESTINATION_FOLDER = "uploaded";



/*
  Si se incluyen <input type="file"> hay que añadir el atributo    enctype="multipart/form-data" a form.
  El fichero/los ficheros se recibirán en el lado servidor en la variable global $_FILES
 */
foreach ($_FILES as $input => $infoArr) { //$input será el valor de name en el marcado HTML (sin corchetes)
	if (is_array($infoArr["name"])) { //Si se envía un array de ficheros con el valor de name  en <input type="file"> terminado en []
		//Se recibe un array asociativo con claves "name", "type", "tmp_name", "error" y "size" y por cada clave, un array de índices numéricos con los valores de cada fichero por cada clave
		
		mostrar_ol_fichero($infoArr);
		
		foreach ($infoArr["error"] as $i => $error) {

			if ($error == UPLOAD_ERR_OK) {
				//En realidad la función move_uploaded_file ya hace la comprobación de is_uploaded_file, así que esta comprobación podría obviarse
				//Como se pedía en el enunciado, la he añadido en la propuesta de solución.
				if(is_uploaded_file($infoArr["tmp_name"][$i])){
					$destination_name = DESTINATION_FOLDER.DIRECTORY_SEPARATOR.$infoArr["name"][$i];
					if(move_uploaded_file($infoArr["tmp_name"][$i], $destination_name)===false){
						echo "<p> Ha habido un problema y el fichero ". $infoArr["name"][$i] ." no ha podido guardarse en el servidor</p>";
					}
					else{
						echo "<p> Se ha guardado con éxito el fichero". $infoArr["name"][$i] ." </p>";
					}

				}
				else{
					echo "<p> Ha habido un problema y el fichero". $infoArr["name"][$i] ." no ha sido enviado por el método HTTP POST</p>";
			
				}
			}
			else{
				echo "<p> Ha habido un problema y el fichero". $infoArr["name"][$i] ." no ha podido enviarse correctamente. El código de error es:". $infoArr['error'][$i] ."</p>";
			}
		}
	} else { //Si se envía un único fichero (El valor del atributo name en <input type="file"> no termina con [])
		echo "<strong>File name</strong>: ";

		echo $infoArr["name"] . "<br>";
	}
}


/**
 * mostrar_ol_ficheros
 * Crea marcado HTML para generar una lista ordenada con todos los datos que provee PHP en $_FILES para cada fichero enviado al servidor
 * @param  mixed $infoArr Array asociativo con las claves "name", "type", "tmp_name", "error", "full_path" y "size. 
 * @return void
 */
function mostrar_ol_fichero(array $infoArr): void
{

	//array_key_first($infoArr) => "name"
	//$infoArr[array_key_first($infoArr)] => $infoArr["name"]
	//count($infoArr[array_key_first($infoArr)]) => total de archivos enviados
	$total_archivos = count($infoArr[array_key_first($infoArr)]);
	
	$i = 0;
	do {
		printf("<p> Fichero %d</p><ol> ", $i + 1);
		foreach ($infoArr as $key => $value) {
			echo "<li> $key: $value[$i] </li>";
		}
		echo "</ol>";
		$i++;
	} while ($i < $total_archivos);
}


/*
Estructura del array recibido en el servidor, en caso de múltiples ficheros:

Array(["nombre_input"] =>   Array (
							["name"] => Array(
											[0] => nombre_fichero_0.ext
											[1] => nombre_fichero_1.ext	
											...
											),
							["type"] => Array(
											[0] => tipo_fichero_0
											[1] => tipo_fichero_1
											....
											),
							["tmp_name"] => Array(
											[0] => C:\xampp\tmp\algo_0.tmp
											[1] => C:\xampp\tmp\algo_1.tmp
											....
											), 
							["error"] => Array(
											[0] =>Código de error fichero_0 https://www.php.net/manual/en/features.file-upload.errors.php
											[1] =>Código de error fichero_1
											....
											), 
							["size"] => Array(
											[0] => tamaño en bytes
											[1] => tamaño en bytes
											....
                                            ),
                                            // a partir de PHP 8.1.0
                            ["full_path"] => Array(
											[0] => ruta enviada por el navegador del fichero 0
											[1] => ruta enviada por el navegador del fichero 1
											....
											)                

							)
	)

*/?>
</body>
</html>
