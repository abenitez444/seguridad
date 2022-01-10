<header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="">
        <div class="row">
            <div class="col-12">
                <img class="logo" src="<?php echo e(asset('img/logo.png')); ?>" alt="CAPPSERITO">
                <!-- Navigation -->
                <nav id="navbar" class="navbar navbar-expand-lg navbar-light text-white">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('website.index')); ?>">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('website.nosotros')); ?>">NOSOTROS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('website.establecimientos')); ?>">ESTABLECIMIENTOS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" class="btn boton-enviar" data-toggle="modal" data-target="#exampleModal">INICIAR SESIÓN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('website.registroChef')); ?>">REGISTRARSE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('website.contacto')); ?>">CONTACTO</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <br><br><br>
            </div>

            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <div class="row text-left">
                    <div class="col-sm">
                        <a href="#" class="text-white" data-toggle="modal" data-target="#modal-mi-ubicacion">
                            <hr/>
                            <img class="icon-ubication" src="<?php echo e(asset('img/icon-ubication.png')); ?>" alt="Mi Ubicación">
                            Usar mi Ubicación actual
                            <hr/>
                        </a>
                    </div>
                    <div class="col-pequenia">

                    </div>
                    <div class="col-sm">
                        <a href="#" class="text-white" data-toggle="modal" data-target="#modal-otra-ubicacion">
                            <hr/>
                            <img class="icon-ubication" src="<?php echo e(asset('img/icon-ubication.png')); ?>" alt="Otra dirección">
                            Elegir otra dirección
                            <hr/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal login -->
<div class="modal modal-registro fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm text-center">
                        <h5 class="modal-title" id="exampleModalLabel">Ingresar en mi cuenta</h5>
                    </div>
                </div>
            </div>
            <form class="container">
                <div class="form-group">
                    <input type="email" class="form-control" id="login-email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="login-contrania" placeholder="Contraseña">
                </div>
                <div class="row">
                    <div class="col-sm-4 text-left">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Recordarme</label>
                    </div>
                    <div class="col-sm-8 text-right">
                        <a class="text-naranja" href="">Olvide mi contraseña</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm text-center">
                        <button type="submit" class="btn boton-enviar btn-lg btn-block font-weight-bol">Ingresar</button>
                    </div>
                </div>
            </form>
            <br>
            <div class="row">
                <div class="col-sm text-center">
                    ¿Todavía no tienes una cuenta? <a class="text-naranja" href="registro-chef.html">Registrate</a> 
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

<!-- Modal Otra ubicación -->
<div class="modal modal-otra-ubicacion fade" id="modal-otra-ubicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ingresa tu dirección completa
                        </h5>
                        <p>
                            Encuentra los restaurantes que entregan en tu ubicación
                        </p>
                    </div>
                </div>
            </div>
            <form class="container">
                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected>Ciudad</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected>Calle</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <input type="text" class="form-control" id="calle2">
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <input type="text" class="form-control" id="direcion1">
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <input type="text" class="form-control" id="direcion2">
                        </div>
                    </div>
                    <div class="col-lg">
                        <a href="establecimientos.html"><button type="button" class="btn boton-enviar">Buscar</button></a>
                    </div>
                </div>

            </form>

            <br>
        </div>
    </div>
</div>

<br><br><?php /**PATH /opt/lampp/htdocs/SeguridadLogro/AppCore/resources/views/layouts/website/header.blade.php ENDPATH**/ ?>