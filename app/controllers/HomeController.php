<?php
class HomeController {
    public function index() {
        session_start();
        if (!isset($_SESSION["usuario"])) {
            header("Location: /Books-MVC/usuario/login");
            exit;
        }

        $nombre = htmlspecialchars($_SESSION["usuario"]["nombre"]);
        require 'app/views/home/index.php';
    }
}
