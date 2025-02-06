<?php

class Database {
    private static $host = '161.132.50.160';
    private static $dbName = 'bdmijostore';
    private static $username = 'raymond';
    private static $password = 'Upt2024';
    private static $port = '3306';

    public static function conexion() {
        try {
            // Usamos PDO para la conexión
            $dsn = "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbName . ";charset=utf8";
            $pdo = new PDO($dsn, self::$username, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}

?>
