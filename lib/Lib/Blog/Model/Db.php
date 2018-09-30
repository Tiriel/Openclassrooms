<?php

namespace API\Lib\Blog\Model;

use API\Lib\Blog\Config\Configuration;

/**
 * All services relative to the database
 * Using PDO API
 */

 abstract class Db {

    private static $db;

    protected function executeRequest($sql, $params = null) {
        if ($params == null) {
            $result = self::getDb()->query($sql); // direct request
        }
        else {
            $result = self::getDb()->prepare($sql); // prepared request
            $result->execute($params);
        }
        return $result;
    }

    private static function getDb() {
        if (self::$db === null) {
            // Getting credentials for database connexion
            $dsn = Configuration::get("dsn");
            $login = Configuration::get('login');
            $pswd = Configuration::get('pswd');
            // Starting connexion
            self::$db = new PDO ($dsn, $login, $pswd, 
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return self::db;
    }
 }