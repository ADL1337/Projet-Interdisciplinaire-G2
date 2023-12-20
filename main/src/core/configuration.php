<?php

class Configuration {
    
    private static array $parameters;
    private static string $configDir = __DIR__ . "/../../res/config/";
    private static string $configName = "config.ini";

    public static function get($key) {
        self::loadParameters(); # For hot loading config settings
        if (isset(self::$parameters[$key])) {
            return self::$parameters[$key];
        }
        return null;
    }

    # Load parameters from the config file
    private static function loadParameters() {
        $config = parse_ini_file(self::getConfigPath());
        self::$parameters = $config;
    }

    # Gets the path to the config file
    private static function getConfigPath() {
        if (file_exists(self::$configDir . self::$configName)) {
            $configName = parse_ini_file(self::$configDir . self::$configName)["configFile"];
            return self::$configDir . $configName;
        }
    }
}

?>