<?php



namespace App\Config;

function dd($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}


function redirect($uri){
    header("location:$uri");
    exit;
}

