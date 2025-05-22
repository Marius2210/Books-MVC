<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Books-MVC/public/css/nuevoLibro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="/Books-MVC/public/img/book.png">
    <title>Luz de Letras | Editar Libro</title>
</head>
<body>
    <header>
        <img src="/Books-MVC/public/img/book.png" alt="Libro">
        <div class="header__title" onclick="window.location='/Books-MVC/home/index'">
            <h1>Luz De Letras</h1>
            <p>Organiza, descubre y disfruta</p>
        </div>
    </header>
    <div class="newBook__container">
        <h2>Editar Libro Deseado</h2>
        <a href="/Books-MVC/home/index">Volver a inicio</a>
        <form action="/Books-MVC/librodeseado/actualizar" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $librodeseadoActual['id'] ?>">
            <input type="hidden" name="imagenActual" value="<?= $librodeseadoActual['imagen'] ?>">

            <div class="form__option__container">
                <div class="form__option">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($librodeseadoActual['titulo']) ?>" required>
                </div>
                <div class="form__option">
                    <label for="autor">Autor</label>
                    <input type="text" name="autor" id="autor" value="<?= htmlspecialchars($librodeseadoActual['autor']) ?>" required>
                </div>
            </div>

            <div class="form__option__container">
                <div class="form__option form__option__category">
                    <label for="categoria">Categoría</label>
                    <select name="categoria" id="categoria" required>
                        <?php
                            $categorias = ['Terror', 'Ciencia Ficción', 'Romance', 'Poesía'];
                            foreach ($categorias as $cat) {
                                $selected = ($librodeseadoActual['categoria'] === $cat) ? 'selected' : '';
                                echo "<option value=\"$cat\" $selected>$cat</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form__option__container">
                <div class="form__option">
                    <label for="fechaCompra">Fecha de Compra Futura</label>
                    <input type="date" name="fechaCompra" id="fechaCompra" min="<?= date('Y-m-d'); ?>" value="<?= $librodeseadoActual['fecha_compra'] ?>" required>
                </div>
                <div class="form__option">
                    <label for="portada">Imagen de Portada</label>
                    <input type="file" name="portada" id="portada">
                    <p style="font-size: 0.9em; color: #666;">Deja este campo vacío si no deseas cambiar la imagen.</p>
                </div>
            </div>

            <div class="form__button">
                <input type="submit" value="ACTUALIZAR">
            </div>
        </form>
    </div>
</body>
</html>
