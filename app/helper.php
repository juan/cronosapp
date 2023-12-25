<?php

//return function name
use Illuminate\Support\Arr;

function get_function_name(string $functionname)
{
    $fullname = preg_split('/(?=[A-Z])/', $functionname);

    return str()->lower($fullname[1]);
}

//remove item from array
function remove_array_item(array $namearray, int $posicion)
{

    unset($namearray[$posicion]);

    return $namearray;
}

//see if and array is the same of other array

function check_arrays(array $arrayTemp, $arrayItems, array $arraysK)
{
    $isIn = '';
    $notIn = '';
    if (! is_null($arrayItems) and count($arrayItems) > 0) {

        for ($i = 0; $i < count($arrayItems); $i++) {
            $fullarray = Arr::only($arrayItems[$i], $arraysK);
            $slicearray = Arr::only($arrayTemp, $arraysK);

            if ($fullarray === $slicearray) {
                $isIn = 1;
            } else {
                $notIn = 0;
            }
        }

        return empty($isIn) ? $notIn : $isIn;

    } else {

        return 0;
    }
}

//prepare data for create or update
function prepareData($arrayTemp, $arrayOriginal): array
{
    return Arr::only($arrayTemp, $arrayOriginal);
}

//remove items for unique values in array

function cleanArray(array $arrayitems)
{
    return array_unique($arrayitems);
}

//check if array contain a particular value
function removeValueArray(array $arrayofvalues, $value)
{
    $isvaluepresent = array_search($value, $arrayofvalues, true);

    if ($isvaluepresent) {
        $arrayofvalues = remove_array_item($arrayofvalues, $isvaluepresent);
    }

    return $arrayofvalues;
}
