<?php
class Libro {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getTodos() {
        $sql = "SELECT * FROM libros";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($datos) {
        $stmt = $this->db->prepare("INSERT INTO libros (titulo, autor, anio_publicacion, categoria) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$datos['titulo'], $datos['autor'], $datos['anio'], $datos['categoria']]);
    }
}
