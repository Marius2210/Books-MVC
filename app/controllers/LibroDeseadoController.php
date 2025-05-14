<?php
require_once 'app/models/LibroDeseado.php';

class LibroDeseadoController
{
    public function index()
    {
        $librodeseado= new LibroDeseado();
        $librosdeseados = $librodeseado->getTodos();
        require_once 'app/views/libro/librosDeseados.php';
    }

    public function nuevo()
    {
        require_once 'app/views/libro/nuevoLibroDeseado.html';
    }

    public function guardar()
    {
        // Validación básica de imagen
        $directorio = 'public/imagenesLibros/';
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
        $librodeseadodeseado = new LibroDeseado();
        $librodeseadodeseado->guardar([
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'],
            'categoria' => $_POST['categoria'],
            'fechaCompra' => $_POST['fechaCompra'],
            'imagen' => $archivoRuta
        ]);
        header("Location: /Books-MVC/librodeseado/index");
    }

    public function editar()
    {
        if (!isset($_GET['id'])) {
            echo "ID no especificado.";
            return;
        }

        $id = $_GET['id'];
        $librodeseado = new LibroDeseado();
        $librodeseadoActual = $librodeseado->getPorId($id);

        if (!$librodeseadoActual) {
            echo "Libro no encontrado.";
            return;
        }

        require_once 'app/views/libro/editarLibroDeseado.php';
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
            $directorio = 'public/imagenesLibros/';
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

        $librodeseado = new LibroDeseado();
        $librodeseado->editar($id, [
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'],
            'categoria' => $_POST['categoria'],
            'fechaCompra' => $_POST['fechaCompra'],
            'imagen' => $archivoRuta
        ]);

        header("Location: /Books-MVC/librodeseado/index");
    }

    public function eliminar()
    {
        if (!isset($_GET['id'])) {
            echo "ID no especificado.";
            return;
        }

        $id = $_GET['id'];
        $librodeseado = new LibroDeseado();
        $librodeseadoActual = $librodeseado->getPorId($id);

        if (!$librodeseadoActual) {
            echo "Libro no encontrado.";
            return;
        }

        if (!empty($librodeseadoActual['imagen']) && file_exists($librodeseadoActual['imagen'])) {
            unlink($librodeseadoActual['imagen']);
        }

        $librodeseado->eliminar($id);

        header("Location: /Books-MVC/librodeseado/index");
    }
}
