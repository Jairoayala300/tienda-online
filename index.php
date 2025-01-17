<?php require_once "config/conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TIENDA DE ROPA</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> -->
     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-hB4gLhM8gF01GQOjqqLqJEa7FsjHC+jj06pPDh38LZIVlsVa+cKjtDw/sgquz8A0" crossorigin="anonymous">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilos.css" rel="stylesheet" />
    <style>
        /* Estilos CSS para la animación del banner publicitario */
        #adBanner {
            position: fixed;
            bottom: 20px; /* Puedes ajustar la posición vertical */
            left: -200px; /* Inicialmente fuera del área visible */
            transition: left 5s linear; /* Configura la duración y el tipo de transición */
        }

        /* Aplicar la animación al anuncio */
        #adBanner.move {
            left: calc(100% - 200px); /* Moverá el anuncio horizontalmente hacia el final de la página */
        }
    </style>
</head>

<body>
    <a href="#" class="btn-flotante" id="btnCarrito">Carrito <span class="badge bg-success" id="carrito">0</span></a>
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <a href="#" class="nav-link text-info" category="all">Todo</a>
                        <?php
                        $query = mysqli_query($conexion, "SELECT * FROM categorias");
                        while ($data = mysqli_fetch_assoc($query)) { ?>
                            <a href="#" class="nav-link" category="<?php echo $data['categoria']; ?>"><?php echo $data['categoria']; ?></a>
                        <?php } ?>

                    </ul>
                            <!-- Barra de búsqueda en la parte superior -->
                            <form class="d-flex mx-auto mt-3">
    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
</form>
                </div>
            </div>
        </nav>
    </div>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <img src="assets/img/logo.png" alt="Logo de la empresa">
                 <!-- Banner desplegable -->
                 <div class="collapse mt-3" id="bannerCollapse">
                    <div class="card card-body bg-light" id="adBanner">
                        <!-- Contenido del anuncio -->
                        <h4>Anuncio Importante</h4>
                        <p>¡Aprovecha nuestras ofertas especiales esta temporada! Descuentos del 20% en productos seleccionados.</p>
                        <!-- Imagen del anuncio -->
                        <img src="ruta_de_la_imagen_del_anuncio.jpg" alt="Anuncio" class="img-fluid d-block d-md-none">
            
                <h1 class="display-4 fw-bolder"></h1>
                <p class="lead fw-normal text-white-50 mb-0"></p>
               
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <div class="col mb-5 productos" category="<?php echo $data['categoria']; ?>">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo ($data['precio_normal'] > $data['precio_rebajado']) ? 'Oferta' : ''; ?></div>
                                <!-- Product image-->
                                <img class="card-img-top" src="assets/img/<?php echo $data['imagen']; ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $data['nombre'] ?></h5>
                                        <p><?php echo $data['descripcion']; ?></p>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                        </div>
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through"><?php echo $data['precio_normal'] ?></span>
                                        <?php echo $data['precio_rebajado'] ?>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto agregar" data-id="<?php echo $data['id']; ?>" href="#">Agregar</a></div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">TIENDA DE ROPA &copy; THE LION KINGDON 2023</p>
    <!-- Enlaces de Facebook y WhatsApp -->
    <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-auto">
            <a href="https://www.facebook.com/profile.php?id=61553018573225&locale=es_LA" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/e/ee/Logo_de_Facebook.png" alt="Facebook" width="50" height="50">
            </a>
        </div>
        <div class="col-auto">
            <a href="https://wa.me/1234567890" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="WhatsApp" width="50" height="50">
            </a>
        </div>
    </div>
</div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        // Aplicar animación una vez que la página se ha cargado completamente
        document.addEventListener("DOMContentLoaded", function () {
            const adBanner = document.getElementById('adBanner');
            adBanner.classList.add('move'); // Agrega la clase para activar la animación
        });
    </script>
</body>
