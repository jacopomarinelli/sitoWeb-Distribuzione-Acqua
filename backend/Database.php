<?php

class Database {
    private static ?PDO $connection = null;

    public static function getConnection(): PDO {

        if (self::$connection === null) {

            self::$connection = new PDO(
                "mysql:host=localhost;dbname=my_aquabear;charset=utf8",
                "aquabear",
                ""
            );

            self::$connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }

        return self::$connection;
    }
}