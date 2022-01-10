<!-- Footer -->
<footer id="f-end" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="registrar-n">
                    <h2>REGISTRATE A NUESTRO NEWSLETTER</h2>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Escribe tu correo electrónico" aria-label="Escribe tu correo electrónico" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">Suscribirse</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer_column">
                            <div class="footer_title">Lácteos y huevos</div>
                            <ul class="footer_list">
                                <li><a href="#">Huevos</a></li>
                                <li><a href="#">Leche</a></li>
                                <li><a href="#">Bebidas Lácteas</a></li>
                                <li><a href="#">Quesos</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="footer_column">
                            <div class="footer_title">Despensa</div>
                            <ul class="footer_list">
                                <li><a href="#">Arroz, Granos y sal</a></li>
                                <li><a href="#">Aceites</a></li>
                                <li><a href="#">Pastas</a></li>
                                <li><a href="#">Hardware</a></li>
                                <li><a href="#">Az´car y Endulzantes</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="footer_column">
                            <div class="footer_title">Pan. arepas y tortillas</div>
                            <ul class="footer_list">
                                <li><a href="#">Panes</a></li>
                                <li><a href="#">Toritilas</a></li>
                                <li><a href="#">Arepas</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <h2>DESCARGA LA APP</h2>
                <img src="<?php echo e(asset('images/mac-badge.png')); ?>">    
                <img src="<?php echo e(asset('images/google-play-badge.png')); ?>">    
                <img src="<?php echo e(asset('images/windows-badge.png')); ?>">
                <h2 class="top-h2" >SIGUENOS EN</h2>
                <div class="footer_social">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>
                <hr>
                <ul class="footer_list">
                    <li><a href="#">Preguntas Frecuentes</a></li>
                    <li><a href="#">Términos y Condiciones</a></li>
                    <li><a href="#">Políticas de Privacidad</a></li>
                </ul>   
            </div>


            <div class="col-md-3">
                <h2>FORMAS DE PAGO</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <img class="visa" src="<?php echo e(asset('images/mastercard.png')); ?>">
                    </div>
                    <div class="col-lg-6">
                        <img class="visa" src="<?php echo e(asset('images/visa.png')); ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <img class="visa" src="<?php echo e(asset('images/sodexo.png')); ?>">
                    </div>
                    <div class="col-lg-6">
                        <img class="visa" src="<?php echo e(asset('images/americanexpress.png')); ?>">
                    </div>
                </div>

                <h2 class="top-h2" >CONTÁCTANOS</h2>
                <ul class="contact-footer">
                    <li>
                        <div class="centerico">
                            <i class="fab fa-2x fa-whatsapp"></i>
                            <p>(57) 316 4950396</p>
                        </div>
                    </li>
                    <li>
                        <div class="centerico">
                            <i class="fa fa-2x fa-mobile"></i>
                            <p>Cel:(57) 317 521 3793</p>
                        </div>
                    </li>

                    <li>
                        <div class="centerico">
                            <i class="fa fa-2x fa-phone"></i>
                            <p>Tel: (571) 455 1783</p>
                        </div>
                    </li>

                    <li>
                        <div class="centerico">
                            <i class="fa fa-2x fa-envelope"></i>
                            <p>soluciones@2web.us</p>
                        </div> 
                    </li>
                </ul>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="copyright ">
                    <p>Soporte, Términos y Condiciones, Copyright © 2019 | <a href="">2Web</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modal dirección -->
<div class="modal fade" id="direc"  role="dialog" aria-labelledby="direcLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" align="center">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="direcLabel"><i class="fas fa-map-marker-alt"></i> Tu Dirección</h2>
                <p>Digita la dirección para validar cobertura</p>
                <hr style="background-color:#8CC53F; border:0; width: 20%; height: 3px; " align="center">
                <form>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <select  class="form-control">
                                <option selected>Bogotá</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select  class="form-control">
                                <option selected>Calle</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Numero">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Número">
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Número">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #8CC63F; border:none;">Validar</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal nosotros -->
<div class="modal fade" id="nos"  role="dialog" aria-labelledby="direcLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" align="center">
            <div class="modal-body" style="padding: 30px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" style="font-size: 30px; text-align: center;">¿Quienes somos?</h2>
                <hr style="background-color:#8CC53F; border:0; width: 20%; height: 3px; " align="center">
                <p style=" background-color: #FFFF00; padding: 2px; border-radius: 15px; color: black;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <img src="<?php echo e(asset('images/logo.png')); ?>">
            </div>
        </div>
    </div>
</div>

<!-- Modal contacto -->
<div class="modal fade" id="cont"  role="dialog" aria-labelledby="direcLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" align="center">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button><br><br>
                <h2 class="modal-title" id="direcLabel" style="font-size: 30px; text-align: center;">¡Dejanos cualquier duda o comentario!</h2><br>
                <hr style="background-color:#8CC53F; border:0; width: 20%; height: 3px; " align="center">
                <form style="background-color: #FFFF00; padding: 20px; border-radius: 10px; margin-bottom: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Nombre">
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Apellido">
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Asunto">
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Correo">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="textarea" name="corre" class="form-control" height="100px" placeholder="Mensaje">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #8CC63F; border-color: #8CC63F; ">Enviar</button>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- Modal registrar -->
<div class="modal fade" id="regist" tabindex="-1" role="dialog" aria-labelledby="direcLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="direcLabel"><i class="fas fa-user"></i> Ingresa o Regístrate</h2>

                <form class="well form-horizontal" method="post" id="form_login_modal" v-on:submit.prevent="login('form_login_modal')">
                    <fieldset id="fieldform">
                        <p>Ingresa con tu cuenta de EZmarket</p>
                        <div class="form-group">
                            <div class="col-md-12 inputGroupContainer">
                                <div class="input-group">
                                    <input  name="email" placeholder="Correo electrónico" class="form-control"  type="email"  required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check col-md-12">
                                <input class="form-check-input" type="checkbox" id="gridCheck" name="remember">
                                <label class="form-check-label" for="gridCheck">
                                    Quiero que el sistema recuerde mis datos
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 a-r inputGroupContainer">
                                <div class="input-group">
                                    <input  name="password" placeholder="Contraseña" class="form-control"  type="password" required>
                                </div>
                                <a href="">¿Olvido su contraseña?</a>
                            </div>
                        </div>
                        <div class="row" v-if="errorMessage  != ''">
                            <div class="col-12 col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    {{ errorMessage }} 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </fieldset>

                    <div class="col-md-12 btn-redes">
                        <p><a href="<?php echo e(route('auth.showProfile')); ?>">¿No tienes una Cuenta?</a></p>
                        <div class="fb-login-button" data-width="" data-size="large" data-button-type="login_with" data-auto-logout-link="false" data-use-continue-as="false"></div>
                        <!-- <a href="<?php echo e(asset('auth.showProfile')); ?>" class="btn-movil"><i class="fa fa-2x fa-mobile"></i> Regístrate con tu número telefónico</a>-->
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div id="fb-root"></div><?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/layouts/website/footer.blade.php ENDPATH**/ ?>