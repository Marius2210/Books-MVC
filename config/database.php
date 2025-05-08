<?php
class Database {
    public static function connect() {
        $host = 'localhost';
        $dbname = 'gestion_libros';
        $username = 'root';
        $password = '';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
