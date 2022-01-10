<!-- Start Header Style -->
<header id="header" class="htc-header header--3 bg__white">
    <!-- Start Mainmenu Area -->
    <!-- Start Mainmenu Area -->
    

    <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                    <div class="logo">
                        <a href="<?php echo e(route('website.index')); ?>">
                            <img src="<?php echo e(asset('images/logo/logo.png')); ?>" alt="logo">
                        </a>
                    </div>
                </div>
                <!-- Start MAinmenu Ares -->
                <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                    <nav class="mainmenu__nav hidden-xs hidden-sm">
                        <ul class="main__menu">
                            <!-- <li><a href="index.html">Maquillaje</a></li>
                            <li><a href="index.html">Rostro</a></li>
                            <li><a href="index.html">Cuidado corporal</a></li> -->
                            <li><a href="<?php echo e(route('shopList')); ?>">Tienda</a></li>
                            <li><a href="javascript:void(0)">Tendencias</a></li>
                            <li><a href="javascript:void(0)">Ofertas</a></li>
                            <li><a href="<?php echo e(route('website.contact')); ?>">Contacto</a></li>
                            <?php if(auth()->guard()->check()): ?>
                                <li><a href="javascript:void(0)" v-on:click="logout()">Cerrar sesión</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <div class="mobile-menu clearfix visible-xs visible-sm">
                        <nav id="mobile_dropdown">
                            <ul>
                                <!-- <li><a href="index.html">Maquillaje</a></li>
                                <li><a href="index.html">Rostro</a></li>
                                <li><a href="index.html">Cuidado corporal</a></li> -->
                                <li><a href="<?php echo e(route('shopList')); ?>">Tienda</a></li>
                                <li><a href="javascript:void(0)">Tendencias</a></li>
                                <li><a href="javascript:void(0)">Ofertas</a></li>
                                <li><a href="<?php echo e(route('website.contact')); ?>">Contacto</a></li>
                                <?php if(auth()->guard()->check()): ?>
                                    <li><a href="javascript:void(0)" v-on:click="logout()">Cerrar sesión</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>                         
                </div>
                <!-- End MAinmenu Ares -->
                <div class="col-md-2 col-sm-4 col-xs-3">  
                    <ul class="menu-extra">
                        <li class="search search__open hidden-xs"><span class="ti-search"></span></li>
                        <li><a <?php if(auth()->guard()->check()): ?> href="<?php echo e(route('auth.showProfile')); ?>" <?php else: ?> href="<?php echo e(route('auth.showFormAuth')); ?>" <?php endif; ?>><span class="ti-user"></span></a></li>
                        <li class="cart__menu"><span class="ti-shopping-cart"></span></li>
                        <!-- <li class="toggle__menu hidden-xs hidden-sm"><span class="ti-menu"></span></li> -->
                    </ul>
                </div>
            </div>
            <div class="mobile-menu-area"></div>
        </div>
    </div>
    <!-- End Mainmenu Area -->
</header>
<!-- End Header Style -->
<div class="body__overlay"></div>
<!-- Start Offset Wrapper -->
<div class="offset__wrapper">
    <!-- Start Search Popap -->
    <div class="search__area">
        <div class="container" >
            <div class="row" >
                <div class="col-md-12" >
                    <div class="search__inner">
                        <form action="#" method="get">
                            <input placeholder="Buscar... " type="text">
                            <button type="submit"></button>
                        </form>
                        <div class="search__close__btn">
                            <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Popap -->
    <!-- Start Offset MEnu -->
    <!-- Start Cart Panel -->
    <div class="shopping__cart" style="border-radius: 20px 0 0 20px;">
        <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
                <a href="#"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="shp__cart__wrap">
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="#">
                            <img src="<?php echo e(asset('images/product/sm-img/1.jpg')); ?>" alt="product images">
                        </a>
                    </div>
                    <div class="shp__pro__details">
                        <h2><a href="product-details.html">Pinturas</a></h2>
                        <span class="quantity">QTY: 1</span>
                        <span class="shp__price">$105.00</span>
                    </div>
                    <div class="remove__btn">
                        <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="#">
                            <img src="<?php echo e(asset('images/product/sm-img/2.jpg')); ?>" alt="product images">
                        </a>
                    </div>
                    <div class="shp__pro__details">
                        <h2><a href="product-details.html">Maquillaje</a></h2>
                        <span class="quantity">QTY: 1</span>
                        <span class="shp__price">$25.00</span>
                    </div>
                    <div class="remove__btn">
                        <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
            </div>
            <ul class="shoping__total">
                <li class="subtotal">Subtotal:</li>
                <li class="total__price">$130.00</li>
            </ul>
            <ul class="shopping__btn">
                <li><a href="cart.html" style="border-radius: 10px; border:2px solid #e04456; color:#e04456; " >Ver Carrito</a></li>
                <li class="shp__checkout"><a href="checkout.html" style="background: #e04456; border:0; color:white; border-radius: 10px;">Pago</a></li>
            </ul>
        </div>
    </div>
    <!-- End Cart Panel -->
</div>
<?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/layouts/website/header.blade.php ENDPATH**/ ?>