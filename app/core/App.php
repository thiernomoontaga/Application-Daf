<?php

namespace App\Core;

use Symfony\Component\Yaml\Yaml;

// $deps : $dependencies
//$group : ex:core,service
//$name : ex:Database,session
//$className : ex:Database::class

class App{
    private static array $instancies = [];
    private static array $dependencies = [];

    public static function getDependency(string $name){

        // Charger le YAML une seule fois
        if(empty(self::$dependencies)) {
            self::$dependencies = Yaml::parseFile(__DIR__.'/../config/Service.yml');
        }

        if(array_key_exists($name,self::$instancies)){
            return self::$instancies[$name];
        }
        
        foreach(self::$dependencies as $group){
            if(isset($group[$name])){
                $className = $group[$name];
                if(class_exists($group[$name])){
                    $instance = $className::getInstance();
                    if($instance){
                        self::$instancies[$name] = $instance;
                        return $instance;
                    }
                }
            }
        }
        return null;
    }

}