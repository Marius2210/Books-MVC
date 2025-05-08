<?php
require_once 'app/models/Usuario.php';

class UsuarioController {
    public function login() {
        require 'app/views/usuarios/login.html';
    }

    public function validarLogin() {
        $usuario = new Usuario();
        $result = $usuario->login($_POST['email'], $_POST['password']);

        if ($result) {
            session_start();
            $_SESSION['usuario'] = $result;
            header("Location: /Books-MVC/home/index");


        } else {
            echo "Credenciales incorrectas";
        }
    }

    public function registro() {
        require 'app/views/usuarios/login.html';
    }

    public function guardarRegistro() {
        $usuario = new Usuario();
        $registrado = $usuario->registrar($_POST['nombre'], $_POST['email'], $_POST['password']);

        if ($registrado) {
            header("Location: /Books-MVC/usuario/login");
        } else {
            echo "Error al registrar usuario.";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /Books-MVC/usuario/login");
    }
}
