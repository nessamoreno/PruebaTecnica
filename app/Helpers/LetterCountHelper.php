<?php

namespace App\Helpers;

class LetterCountHelper
{
    /**
     * Función recursiva para contar las letras en un string.
     *
     * @param string $input
     * @param array $result
     * @return array
     */
    public static function countLetters($input, $result = [])
    {
        // Convertir el texto a mayúsculas para hacerlo insensible a mayúsculas/minúsculas
        $input = strtoupper($input);
        
        // Si no hay más letras, devolver el resultado
        if (empty($input)) {
            return $result;
        }

        // Tomar el primer carácter
        $letter = $input[0];

        // Verificar si el carácter es una letra
        if (ctype_alpha($letter)) {
            // Si la letra ya está en el resultado, aumentar su conteo
            if (isset($result[$letter])) {
                $result[$letter]++;
            } else {
                $result[$letter] = 1;
            }
        }

        // Llamar a la función recursivamente para el resto del string
        return self::countLetters(substr($input, 1), $result);
    }
}
