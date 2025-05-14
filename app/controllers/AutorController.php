<?php
require_once 'app/models/Autor.php';

class AutorController
{
    public function index()
    {
        $autor = new Autor();
        $autores = $autor->getTodos();
        require_once 'app/views/autor/autores.php';
    }

    public function nuevo()
    {
        require_once 'app/views/autor/nuevoAutor.html';
    }

    public function guardar()
    {
        // Validación básica de imagen
        $directorio = 'public/imagenesAutores/';
        $archivoNombre = basename($_FILES['portada']['name']);
        $archivoRuta = $directorio . $archivoNombre;
        $tipoArchivo = strtolower(pathinfo($archivoRuta, PATHINFO_EXTENSION));

        // Validar tipo
        $formatosPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($tipoArchivo, $formatosPermitidos)) {
            echo "Error: Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            return;
        }

        // Subir imagen
        if (!move_uploaded_file($_FILES['portada']['tmp_name'], $archivoRuta)) {
            echo "Error al subir la imagen.";
            return;
        }
        $autor = new Autor();
        $autor->guardar([
            'nombre' => $_POST['nombre'],
            'nacionalidad' => $_POST['nacionalidad'],
            'imagen' => $archivoRuta
        ]);
        header("Location: /Books-MVC/autor/index");
    }

    public function editar()
    {
        if (!isset($_GET['id'])) {
            echo "ID no especificado.";
            return;
        }

        $id = $_GET['id'];
        $autor = new Autor();
        $autorActual = $autor->getPorId($id);

        if (!$autorActual) {
            echo "Autor no encontrado.";
            return;
        }

        require_once 'app/views/autor/editarAutor.php';
    }

    public function actualizar()
    {
        if (!isset($_POST['id'])) {
            echo "ID no proporcionado.";
            return;
        }

        $id = $_POST['id'];

        // Reutilizamos lógica de validación de imagen
        $archivoRuta = $_POST['imagenActual']; // valor por defecto (en caso no se actualice la imagen)
        if (!empty($_FILES['portada']['name'])) {
            $directorio = 'public/imagenesAutore s/';
            $archivoNombre = basename($_FILES['portada']['name']);
            $archivoRuta = $directorio . $archivoNombre;
            $tipoArchivo = strtolower(pathinfo($archivoRuta, PATHINFO_EXTENSION));
            $formatosPermitidos = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($tipoArchivo, $formatosPermitidos)) {
                echo "Error: Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                return;
            }

            if (!move_uploaded_file($_FILES['portada']['tmp_name'], $archivoRuta)) {
                echo "Error al subir la nueva imagen.";
                return;
            }
        }

        $autor = new Autor();
        $autor->editar($id, [
            'nombre' => $_POST['nombre'],
            'nacionalidad' => $_POST['nacionalidad'],
            'imagen' => $archivoRuta
        ]);

        header("Location: /Books-MVC/autor/index");
    }

    public function eliminar()
    {
        if (!isset($_GET['id'])) {
            echo "ID no especificado.";
            return;
        }

        $id = $_GET['id'];
        $autor = new Autor();
        $autorActual = $autor->getPorId($id);

        if (!$autorActual) {
            echo "Autor no encontrado.";
            return;
        }

        if (!empty($autorActual['imagen']) && file_exists($autorActual['imagen'])) {
            unlink($autorActual['imagen']);
        }

        $autor->eliminar($id);

        header("Location: /Books-MVC/autor/index");
    }
}
