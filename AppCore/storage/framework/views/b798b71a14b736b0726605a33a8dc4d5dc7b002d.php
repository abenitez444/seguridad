<div class="container-fluid ocultar-mobile">
    <div class="row">
        <div class="col-md-4 mt-1 mb-1">
            <div class="row">
                <div class="col-md-4 ">
                    <p class="mt-2 d-inline size-9"><span class="bg-rosado">Punto de venta</span></p>
                    <hr class="text-left linea d-inline">
                </div>
                <div class="col-md-4 ">
                    <p class="mt-2 d-inline size-9"><span class="bg-rosado">Quiénes somos</span></p>
                    <hr class="text-left linea d-inline">
                </div>
                <div class="col-md-4">
                    <p class="mt-2 d-inline size-9"><span class="bg-rosado">Certificaciones</span></p>
                </div>
            </div>  
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    
                </div>
                <div class="col-md-6">
                    <p class="size-9 mt-1 mb-0"><b>Siguenos</b>
                    <img src="<?php echo e(asset('img/facebook.png')); ?>" alt=""> 
                    <img src="<?php echo e(asset('img/instagram.png')); ?>" alt="">
                    <img src="<?php echo e(asset('img/twitter.png')); ?>" alt="">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
 

<nav class="navbar navbar-expand-lg navbar-light bg-index">
  <a class="navbar-brand ml-5" href="<?php echo e(route('website.index')); ?>"><img src="<?php echo e(asset('img/logo.png')); ?>" alt=""></a>
  <button class="navbar-toggler bg-griss2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-12">
            <ul class="navbar-nav mr-auto">
                <div class="col-md-1"></div>
                
                    <li class="nav-item active mr-2">
                        <a class="nav-link size-8 tc-blanco" href="<?php echo e(route('website.index')); ?>"><span class="bg-rosado">INICIO</span>
                        <hr class="linea3 w-100 mw-25">
                        </a>

                    </li>   
                    
                    <!--
                      <li class="nav-item dropdown mr-2">
                          <a href="javascript:void(0)" class="dropdown-toggle nav-link size-8">SALAS</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div>
                        </li>     
                  
                      <li class="nav-item dropdown mr-2">
                          <a class="nav-link size-8 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            DORMITORIO
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div>
                      </li>       
                  
                      <li class="nav-item dropdown mr-2">
                          <a href="javascript:void(0)" class="dropdown-toggle nav-link size-8">COMEDOR</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div>
                      </li> 
                    -->      

                    <li class="nav-item mr-2">
                        <a class="nav-link size-8" href="<?php echo e(route('shopList')); ?>">TIENDA</a>
                    </li>  
                
                    <li class="nav-item mr-2">
                        <a class="nav-link size-8" href="<?php echo e(route('website.about')); ?>">QUIENES SOMOS</a>
                    </li>       
                
                    <li class="nav-item mr-2">
                        <a class="nav-link size-8" href="#">BLOG</a>
                    </li>       
                
                    <li class="nav-item mr-5 mmb-5">
                        <a class="nav-link size-8" href="<?php echo e(route('website.contact')); ?>">CONTÁCTANOS</a>
                    </li>   
                
                <div class="col-md-3 mpl-0 centrar-mobile">
                    <li class="nav-item">
                        <a class="nav-link size-8 b-precio w-75 mw-100 text-center" href="#"><img src="<?php echo e(asset('img/etiqueta.png')); ?>" alt="" class="">PRECIOS ESPECIALES</a>
                    </li>
                </div>
            </ul>
        </div>
        </div>
        </div>
    </div>
    
  </div>
</nav><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/layouts/website/nav.blade.php ENDPATH**/ ?>