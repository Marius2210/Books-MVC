<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Books-MVC/public/css/libros.css">
    <link rel="stylesheet" href="/Books-MVC/public/css/deseos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="/Books-MVC/public/img/book.png">
    <title>Luz de Letras | Mis Libros</title>
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
        <h2>Mis Autores</h2>
        <a href="/Books-MVC/home/index">Volver a inicio</a>
        <div class="books">
            <?php foreach ($autores as $autor): ?>
            <div class="book">
                <img src="/Books-MVC/<?= $autor["imagen"] ?>">
                <div class="book__info">
                    <h3><?= htmlspecialchars($autor["nombre"]) ?></h3>
                    <p><?= htmlspecialchars($autor["nacionalidad"]) ?></p>
                    <a href="/Books-MVC/autor/editar?id=<?= $autor['id'] ?>">Editar autor</a>
                    <a href="/Books-MVC/autor/eliminar?id=<?= $autor['id'] ?>" onclick="return confirm('¿Estás seguro que deseas eliminar este autor?');">Eliminar autor</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>