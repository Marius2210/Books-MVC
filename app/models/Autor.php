<?php
require_once 'app/config/Database.php';
class Autor {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getTodos() {
        $sql = "SELECT * FROM autor";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM autor WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($datos) {
        $stmt = $this->db->prepare("INSERT INTO autor (nombre, nacionalidad, imagen) VALUES (?, ?, ?)");
        return $stmt->execute([$datos['nombre'], $datos['nacionalidad'], $datos['imagen']]);
    }

    public function editar($id, $datos) {
        $stmt = $this->db->prepare("UPDATE autor SET nombre = ?, nacionalidad = ?, imagen = ? WHERE id = ?");
        return $stmt->execute([$datos['nombre'], $datos['nacionalidad'], $datos['imagen'], $id]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM autor WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
