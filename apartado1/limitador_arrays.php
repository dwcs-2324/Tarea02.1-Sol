<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <h1>Tarea02.1 (Apartado 1)</h1>
    <h2>Creación de array mediante rangos de enteros con limitador</h2>
    <form method="post">

        <p><label for="limiter-id">Introduzca el delimitador: </label><input type="text" name="limitador" id="limiter-id"></p>
        <p><label for="minmax-id">Introduzca los valores enteros separados por un símbolo, por ejemplo. -5,4 :</label><input type="text" name="minmax" id="minmax-id"></p>

        <button type="submit">Enviar</button>
    </form>
</body>
<?php


const MSG_ERROR_LIMITER_INT = "El limitador no puede ser un entero";
const MSG_ERROR_LIMITER_NOT_PLUS_NOT_MINUS = "El limitador no puede ser un un símbolo + ni un símbolo -";
const MSG_ERROR_LIMITER_COUNT = "El limitador no puede tener más de un carácter";
const MSG_ERROR_LIMITER_NOT_SPACE = "El limitador no puede tener espacios ni estar vacío";

const MSG_ERROR_LIMITER_NOT_PRESENT = "El limitador no está presente en la cadena min max";
const MSG_ERROR_MIN_MAX_COUNT = "Solo puede haber 2 elementos separados por el limitador";
const MSG_ERROR_MIN_MAX_NOT_INT = "Solo puede haber 2 números enteros separados por el limitador";

const LIMITER_MAX_COUNT = 1;
const MIN_MAX_MAX_COUNT = 2;

$errors = [];

require_once 'util.php';

if (isset($_POST["minmax"]) && isset($_POST["limitador"])) {


    $min_max_string = trim($_POST["minmax"]);
    $limiter = trim($_POST["limitador"]);

    if (is_limiter_valid($limiter)) {
        if (!str_contains($min_max_string, $limiter)) {
            array_push($errors, MSG_ERROR_LIMITER_NOT_PRESENT);
        } else {
            $min_max_array = explode($limiter, $min_max_string);
            if (is_valid_min_max_array($min_max_array)) {
                $array = create_array_min_max($min_max_array[0], $min_max_array[1]);
                mostrar($array);
            }
        }
    }

    foreach ($errors as $key => $value) {
        printf("<p class='error'>%s</p>", $value);
    }
}




?>

</html>