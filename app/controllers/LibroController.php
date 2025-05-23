<?php
require_once 'app/models/Libro.php';

class LibroController
{
    public function index()
    {
        $libro = new Libro();
        $libros = $libro->getTodos();
        require_once 'app/views/libro/libros.php';
    }

    public function categorias()
    {
        $libro = new Libro();
        $libros = $libro->getCategorias();

        // Agrupar por categoría
        $categorias = [];
        foreach ($libros as $libro) {
            $categorias[$libro['categoria']][] = $libro;
        }
        require_once 'app/views/libro/categorias.php';
    }

    public function nuevo()
    {
        require_once 'app/views/libro/nuevoLibro.html';
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
        $libro = new Libro();
        $libro->guardar([
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'],
            'categoria' => $_POST['categoria'],
            'fechaCompra' => $_POST['fechaCompra'],
            'imagen' => $archivoRuta
        ]);
        header("Location: /Books-MVC/libro/index");
    }

    public function editar()
    {
        if (!isset($_GET['id'])) {
            echo "ID no especificado.";
            return;
        }

        $id = $_GET['id'];
        $libro = new Libro();
        $libroActual = $libro->getPorId($id);

        if (!$libroActual) {
            echo "Libro no encontrado.";
            return;
        }

        require_once 'app/views/libro/editarLibro.php';
    }

    public function actualizar()
    {
        if (!isset($_POST['id'])) {
            echo "ID no proporcionado.";
            return;
        }

        $id = $_POST['id'];

        // Reutilizamos lógica de validación de imagen
        $archivoRuta = $_POST['imagenActual'];
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

        $libro = new Libro();
        $libro->editar($id, [
            'titulo' => $_POST['titulo'],
            'autor' => $_POST['autor'],
            'categoria' => $_POST['categoria'],
            'fechaCompra' => $_POST['fechaCompra'],
            'imagen' => $archivoRuta
        ]);

        header("Location: /Books-MVC/libro/index");
    }

    public function eliminar()
    {
        if (!isset($_GET['id'])) {
            echo "ID no especificado.";
            return;
        }

        $id = $_GET['id'];
        $libro = new Libro();
        $libroActual = $libro->getPorId($id);

        if (!$libroActual) {
            echo "Libro no encontrado.";
            return;
        }

        if (!empty($libroActual['imagen']) && file_exists($libroActual['imagen'])) {
            unlink($libroActual['imagen']);
        }

        $libro->eliminar($id);

        header("Location: /Books-MVC/libro/index");
    }
}
