<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Luz de Letras | Mis Libros</title>
    <link rel="stylesheet" href="/Books-MVC/public/css/categorias.css">
    <link rel="stylesheet" href="/Books-MVC/public/css/libros.css">
    <link rel="icon" type="image/x-icon" href="/Books-MVC/public/img/book.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="/Books-MVC/public/img/book.png" alt="Libro">
        <div class="header__title">
            <h1>Luz De Letras</h1>
            <p>Organiza, descubre y disfruta</p>
        </div>
    </header>

    <div class="books__container">
        <h2>Mis Libros</h2>
        <a href="/Books-MVC/home/index">Volver a inicio</a>
        <div class="books">
        <?php foreach ($categorias as $categoria => $librosCategoria): ?>
        <h3>Categoría:<?= htmlspecialchars($categoria); ?></h3>
        <div class="categories__items">
        <?php foreach ($librosCategoria as $libro): ?>
            <div class="category">
                <div class="category__info">
                    <h3><?= htmlspecialchars($libro['titulo']); ?></h3>
                    <p><?= htmlspecialchars($libro['autor']); ?></p>
                    <p><?= htmlspecialchars($libro["fecha_compra"]) ?></p>
                </div>
                <div class="category__books">
                    <img src="/Books-MVC/<?= $libro["imagen"] ?>" alt="">
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
