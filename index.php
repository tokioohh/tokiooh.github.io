
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Teeth</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <img src="img/happy_teeth_transparent.png" alt="logotipo" width="120" height="120">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://g.co/kgs/TnHuV9C">Ubicación</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#Nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MiCuenta.php">Mi Cuenta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<body>

    <div class="log"></div>

    <div class="overlay">
        <img src="img/img_interna_dentista.png" alt>
    </div>

    <div class="bg-text">
        <h1>BIENVENIDOS!</h1>
    </div>

    <div>
        <a href="MiCuenta.php"><button class="cuadro">Haz tu Cita aqui!</button></a>

    </div>
    <div class="containerIndex">
        <h1> </h1>
        <div class="card">
            <h2>¡Tu sonrisa es nuestra prioridad!</h2>
            <p>Nos apasiona cuidar de tu salud bucal 
                con un enfoque integral y humano. Contamos con un equipo de especialistas altamente capacitados en un ambiente cómodo y seguro.</p>
            <div class="icon">
                <img src="img/2317929.png" alt="Dentista Icono">
            </div>
        </div>
        <div id="Nosotros" class="card">
            <h2>Servicios</h2>
            <p> Desde limpiezas dentales hasta procedimientos avanzados como ortodoncia, endodoncia y cirugía maxilofacial, 
                tenemos todo lo que necesitas para lograr una sonrisa saludable y radiante. 
                Además, nos enfocamos en pacientes de todas las edades, y con nuestro servicio de odontologia garantizamos 
                que las visitas al dentista sean alegres y sin estrés.</p>
            <div class="icon">
                <img src="img/1964692.png" alt="Diente Icono">
            </div>
        </div>
        <div class="card">
            <h2>¡Tu Sonrisa, Nuestra Pasión!</h2>
            <p>¡Tu sonrisa habla de ti! Déjanos ser parte de su cuidado. Visítanos y vive la experiencia de un servicio personalizado, diseñado para que siempre salgas sonriendo. 😁
            </p>
            <div class="icon">
                <img src="img/993249.png" alt="Diagnóstico Icono">
            </div>
        </div>
    </div>


    <div class="main-content container">
    <div class="row">
        <!-- Left Section for Especialidades -->
        <div class="left-section col-md-6">
            <div class="cuadro1">
                <h4>Especialidades🦷</h4>
                <div class="especialidades">
                    <div class="especialidad">
                        <h5>💠Odontología General</h5>
                        <p class="detalle">
                            Nuestros odontólogos realizan limpiezas, empastes y chequeos para mantener tu salud bucal en óptimas condiciones.</p>
                    </div>
                    <div class="especialidad">
                        <h5>💠Ortodoncia</h5>
                        <p class="detalle">
                            Corrige la posición de tus dientes con la ayuda de nuestros expertos en brackets y alineadores invisibles.
                        </p>
                    </div>
                    <div class="especialidad">
                        <h5>💠Periodoncia</h5>
                        <p class="detalle">
                            Cuidamos tus encías con tratamientos avanzados para prevenir y tratar enfermedades periodontales.
                        </p>
                    </div>
                    <div class="especialidad">
                        <h5>💠Endodoncia</h5>
                        <p class="detalle">
                            Si tienes dolor o una infección dental, nuestro especialista en tratamientos de conductos salvará tu diente.
                        </p>
                    </div>
                    <div class="especialidad">
                        <h5>💠Cirugía Maxilofacial</h5>
                        <p class="detalle">
                            Resolvemos casos complejos como extracciones de muelas del juicio o reconstrucciones dentales.
                        </p>
                    </div>
                    <div class="especialidad">
                        <h5>💠Odontopediatría</h5>
                        <p class="detalle">
                            Los más pequeños están en las mejores manos; hacemos que cada visita al dentista sea una experiencia positiva.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section for Image Carousel -->
        <div class="right-section col-md-6">
    <div class="carousel-container">
        <div id="carouselAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500" data-bs-pause="hover">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/dentio_odontologia-integral_nuestro-equipo_header.png" class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="img/Diseno-sin-titulo-1.png" class="d-block w-100" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="img/Renta-de-Consultorios-Dentales.webp" class="d-block w-100" alt="Imagen 3">
                </div>
                <div class="carousel-item">
                    <img src="img/img_interna_dentista.png" class="d-block w-100" alt="Imagen 4">
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>

</body>
<footer>
        <img class="pie" src="img\horizontal HT blanco.png" alt="">

        <h1></h1>
    <p>
      <br>
      Nos comprometemos a proteger la privacidad y los datos personales de nuestros usuarios. <br>Toda la información proporcionada será tratada de manera confidencial y conforme a las leyes aplicables de protección de datos.  
     
    </p>
    
    <div class="icon1">
    <a href=""><img src="ico/facebook.png" alt=""></a>
    </div>
    <div class="icon1">
    <a href=""><img src="ico/instagram.png" alt=""></a>
    </div>
    <div class="icon1">
    <a href=""><img src="ico/whatsapp.png" alt=""></a>
    </div>
    </div>
    
    <div class="footer-container">
  <p class="privacy-notice">
      <strong>© 2024 Happy Teeth. Todos los derechos reservados.</strong>
</p>
</div>
  </footer>
</html>