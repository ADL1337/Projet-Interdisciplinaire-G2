<?php
require_once __DIR__ . "/configuration.php";

abstract class Model {

    private static $db;

    protected static function executeRequest(string $sql, array $params=null) {
        # Lazy loading to delay database connection until time of request (we don't want to connect if we don't make a request)
        self::setDatabase();
        if ($params === null) {
            # if the request has no parameters, we do it with the query method.
            $res = self::getDatabase()->query($sql);
        }
        else {
            # But, if the request has parameters, we would do a prepared request to avoid SQL injection.
            $res = self::getDatabase()->prepare($sql);
            $res->execute($params);
        }
        return $res;
    }
    
    private static function setDatabase() {
        if (self::$db === null) {
            # If db is not set, initialize it
            $dbType = Configuration::get("dbType");
            $dbHost = Configuration::get("dbHost");
            $dbName = Configuration::get("dbName");
            $dbUser = Configuration::get("dbUser");
            $dbPassword = Configuration::get("dbPassword");
            $dsn = "$dbType:host=$dbHost;dbname=$dbName";
            self::$db = new PDO($dsn, $dbUser, $dbPassword);
        }
    }

    private static function getDatabase() {
        return self::$db;
    }
}

?>