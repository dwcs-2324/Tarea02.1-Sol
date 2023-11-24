<?php
function is_limiter_valid(string $limiter): bool
{
    global $errors;

    $is_valid = false;
    if (strlen($limiter) > LIMITER_MAX_COUNT) {
        array_push($errors, MSG_ERROR_LIMITER_COUNT);
    } elseif (is_numeric($limiter)) {
        array_push($errors, MSG_ERROR_LIMITER_INT);
    } elseif ($limiter == "") {
        array_push($errors, MSG_ERROR_LIMITER_NOT_SPACE);
    } elseif (($limiter == "+") || ($limiter == "-")) {
        array_push($errors, MSG_ERROR_LIMITER_NOT_PLUS_NOT_MINUS);
    } else {
        $is_valid = true;
    }
    return $is_valid;
}

// function is_entero(string $value): bool
// {
//     $valid = true;
//     //https://www.php.net/manual/es/function.intval.php
//     // intval devuelve  valor entero de var en caso de éxito, o 0 en caso de error. Arrays vacíos devuelven 0, arrays no vacíos devuelven 1. 
//     $value_int = intval($value);
//     //No será correcto cuando sea un array o cuando haya un error y devuelva 0 y la cadena de entrada, eliminando los espacios, sea diferente de "0"
//     if (is_array($value) || (($value_int == 0) && (trim($value) !== "0"))) {
//         $valid = false;
//     }
//     return $valid;
// }
function is_array_int(array $min_max_array): bool
{
    $resultado = true;
    //Debería ser un array solo con valores enteros
    foreach ($min_max_array as $key => $value) {        
        //https://www.php.net/manual/es/function.filter-var.php
        //Retorna los datos filtrados o false si el filtro falla. 
        if (filter_var($value, FILTER_VALIDATE_INT) === false)
            return false;
    }
    return $resultado;
}


function create_array_min_max(int $a, int $b): array
{

    //Algunos habéis usado la función range https://www.php.net/manual/en/function.range.php
    //que ya hace la cuenta atrás o hacia adelante de forma automática

    return range($a, $b);

    //Otra forma más rudimentaria:
    // $array_rango = [];

    // if ($a <= $b) {

    //     for ($i = $a; $i <= $b; $i++) {
    //         array_push($array_rango, $i);
    //     }
    // } else {
    //     for ($i = $a; $i >= $b; $i--) {
    //         array_push($array_rango, $i);
    //     }
    // }
    
    // return $array_rango;
}

function is_valid_min_max_array(array $min_max_array): bool
{
    global $errors;

    $valid = false;
    //comprueba que sean solo 2 elementos
    if (count($min_max_array) != MIN_MAX_MAX_COUNT) {
        array_push($errors, MSG_ERROR_MIN_MAX_COUNT);
        //comprueba que sea un array de enteros
    } elseif (!is_array_int($min_max_array)) {
        array_push($errors, MSG_ERROR_MIN_MAX_NOT_INT);
    } else {
        $valid = true;
    }
    return $valid;
}
/**
 * 
 */
function mostrar(array $array)
{
    echo "<p>El resultado es:</p>";
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
