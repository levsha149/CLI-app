<?php
/**
 * This is pretty self-descriptive. Here I suppose that we make conversions for 3 types of CSV cells:
 *
 * 1) numeric value, 2) valid date, 3) any other string.
 *
 * For each of those types we have an array of callable anonymous functions (or just one callable function), that perform needed transitions.
 * In Parser class we apply each of those anonymous functions to the appropriate values of CSV cells.
 *
 * We assume that all logic of cell type evaluation is done in Parser class. Here we only store transitions for different cell data types.
 */

return [
    //snake-case every string
    'string' => function($arg){
        return str_replace(' ', '_', strtolower($arg));
    },

    //make each integer float with 2 characters after comma
    'numeric' => [
        function($arg){
            return floatval($arg);
        },
        function($arg){
            return number_format($arg, 2);
        }
    ],

    //convert any date to Y-m-d H:i:s
    'date' => function($arg){
        return date('Y-m-d H:i:s', $arg);
    }
];