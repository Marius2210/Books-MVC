<?php
require_once 'app/config/Database.php';
class Libro {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getTodos() {
        $sql = "SELECT * FROM libros";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategorias() {
        $sql = "SELECT titulo, autor, categoria, fecha_compra, imagen FROM libros ORDER BY categoria, titulo";;
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($datos) {
        $stmt = $this->db->prepare("INSERT INTO libros (titulo, autor, categoria, fecha_compra, imagen) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$datos['titulo'], $datos['autor'], $datos['categoria'], $datos['fechaCompra'], $datos['imagen']]);
    }
}
