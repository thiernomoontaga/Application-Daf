<?php

namespace App\Core;

use Symfony\Component\Yaml\Yaml;
use ReflectionClass;
use ReflectionParameter;
use Exception;

class App
{
    private static array $instances = [];
    private static array $services = [];
    private static array $interfaces = [];
    private static bool $initialized = false;

    /**
     * Initialise le container avec la configuration YAML
     */
    public static function init(): void
    {
        if (self::$initialized) {
            return;
        }

        $config = Yaml::parseFile(__DIR__ . '/../config/services.yaml');

        if (isset($config['services'])) {
            self::$services = $config['services'];
        }

        if (isset($config['interfaces'])) {
            self::$interfaces = $config['interfaces'];
        }

        self::$initialized = true;
    }

    /**
     * Récupère une instance de service par son nom
     */
    public static function get(string $serviceName): object
    {
        self::init();

        // Si c'est une interface, résoudre vers le service concret
        if (isset(self::$interfaces[$serviceName])) {
            $serviceName = self::$interfaces[$serviceName];
        }

        // Si l'instance existe déjà et que c'est un singleton, la retourner
        if (isset(self::$instances[$serviceName])) {
            return self::$instances[$serviceName];
        }

        // Si le service est configuré, utiliser la configuration
        if (isset(self::$services[$serviceName])) {
            $serviceConfig = self::$services[$serviceName];
            $className = $serviceConfig['class'];

            if (!class_exists($className)) {
                throw new Exception("Class '$className' not found for service '$serviceName'");
            }

            // Créer l'instance avec injection de dépendances
            $instance = self::createInstance($className, $serviceConfig);

            // Si c'est un singleton, stocker l'instance
            if ($serviceConfig['singleton'] ?? false) {
                self::$instances[$serviceName] = $instance;
            }

            return $instance;
        }

        // Si le serviceName est un nom de classe, essayer de l'instancier directement
        if (class_exists($serviceName)) {
            try {
                $instance = self::createInstance($serviceName, []);
                return $instance;
            } catch (Exception $e) {
                throw new Exception("Unable to create instance of '$serviceName': " . $e->getMessage());
            }
        }

        throw new Exception("Service '$serviceName' not found in configuration and class does not exist");
    }

    /**
     * Crée une instance avec injection de dépendances
     */
    private static function createInstance(string $className, array $config): object
    {
        $reflection = new ReflectionClass($className);

        // Vérifier si la classe a une méthode getInstance (pattern Singleton legacy)
        if ($reflection->hasMethod('getInstance')) {
            $getInstanceMethod = $reflection->getMethod('getInstance');
            if ($getInstanceMethod->isStatic() && $getInstanceMethod->isPublic()) {
                return $className::getInstance();
            }
        }

        $constructor = $reflection->getConstructor();

        // Si pas de constructeur, créer une instance simple
        if (!$constructor) {
            return new $className();
        }

        // Si le constructeur n'est pas public, on ne peut pas l'utiliser
        if (!$constructor->isPublic()) {
            throw new Exception("Cannot access non-public constructor of class $className");
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = self::resolveDependency($parameter, $config);
            $dependencies[] = $dependency;
        }

        return $reflection->newInstanceArgs($dependencies);
    }

    /**
     * Résout une dépendance pour un paramètre
     */
    private static function resolveDependency(ReflectionParameter $parameter, array $config): object
    {
        $parameterType = $parameter->getType();
        $parameterName = $parameter->getName();

        if (!$parameterType || $parameterType->isBuiltin()) {
            throw new Exception("Cannot resolve dependency for parameter '{$parameterName}'");
        }

        $typeName = $parameterType->getName();

        // 1. Chercher d'abord par nom de paramètre dans les dépendances configurées
        if (isset($config['dependencies'])) {
            foreach ($config['dependencies'] as $dependencyName) {
                if ($dependencyName === $parameterName) {
                    return self::get($dependencyName);
                }
            }
        }

        // 2. Si c'est une interface, résoudre vers le service concret
        if (isset(self::$interfaces[$typeName])) {
            return self::get($typeName);
        }

        // 3. Chercher dans les dépendances configurées par type de classe
        if (isset($config['dependencies'])) {
            foreach ($config['dependencies'] as $dependencyName) {
                $dependencyConfig = self::$services[$dependencyName] ?? null;
                if ($dependencyConfig && $dependencyConfig['class'] === $typeName) {
                    return self::get($dependencyName);
                }
            }
        }

        // 4. Essayer de résoudre automatiquement par nom de classe
        return self::get($typeName);
    }

    /**
     * Enregistre une instance manuellement
     */
    public static function set(string $serviceName, object $instance): void
    {
        self::$instances[$serviceName] = $instance;
    }

    /**
     * Vérifie si un service existe
     */
    public static function has(string $serviceName): bool
    {
        self::init();
        return isset(self::$services[$serviceName]) || isset(self::$interfaces[$serviceName]);
    }

    /**
     * Méthode legacy pour compatibilité
     */
    public static function getDependency(string $name): ?object
    {
        try {
            return self::get($name);
        } catch (Exception $e) {
            return null;
        }
    }
}
