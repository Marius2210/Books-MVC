<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Luz de Letras | Mis Libros</title>
    <link rel="stylesheet" href="/Books-MVC/public/css/libros.css">
    <link rel="stylesheet" href="/Books-MVC/public/css/deseos.css">
    <link rel="icon" type="image/x-icon" href="/Books-MVC/public/img/book.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="/Books-MVC/public/img/book.png" alt="Libro">
        <div class="header__title" onclick="window.location='/Books-MVC/home/index'">
            <h1>Luz De Letras</h1>
            <p>Organiza, descubre y disfruta</p>
        </div>
    </header>
    <div class="books__container">
        <div class="books__header">
            <h2>Mis Libros</h2>
            <a href="/Books-MVC/home/index">Volver a inicio</a>
        </div>
        <div class="books">
            <?php foreach ($libros as $libro): ?>
            <div class="book">
                <img src="/Books-MVC/<?= htmlspecialchars($libro["imagen"]) ?>" alt="Portada del libro">
                <div class="book__info">
                    <h3><?= htmlspecialchars($libro["titulo"]) ?></h3>
                    <p><?= htmlspecialchars($libro["autor"]) ?></p>
                    <p><?= htmlspecialchars($libro["categoria"]) ?></p>
                    <p><?= htmlspecialchars($libro["fecha_compra"]) ?></p>
                    <a href="/Books-MVC/libro/editar?id=<?= $libro['id'] ?>">Editar libro</a>
                    <a href="/Books-MVC/libro/eliminar?id=<?= $libro['id'] ?>" onclick="return confirm('¿Estás seguro que deseas eliminar este libro?');">Eliminar libro</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
