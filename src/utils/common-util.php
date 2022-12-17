<?php
function input()
{
    parse_str($_SERVER['QUERY_STRING'], $queryArr);
    return $queryArr;
}

function pe()
{
    $numargs = func_num_args();

    $arg_list = func_get_args();
    for ($i = 0; $i < $numargs; $i++) {
        echo ' errr: <pre>';
        echo 'iii: ';
        echo $i;
        echo 'valll: ';
        var_dump($arg_list[$i]);
        echo '</pre>';
    }
}

function ped()
{
    $numargs = func_num_args();

    $arg_list = func_get_args();
    for ($i = 0; $i < $numargs; $i++) {
        echo ' errr: <pre>';
        echo 'iii: ';
        echo $i;
        echo 'valll: ';
        var_dump($arg_list[$i]);
        echo '</pre>';
    }
    die();
}
