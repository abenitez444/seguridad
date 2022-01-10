<div id="component-header-2">
    <!-- Navigation -->
    <nav id="navbar" class="navbar-registro navbar-expand-lg navbar-light fixed-top py-3">
        <div class="container">

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="<?php echo e(url('/')); ?>"><img class="logo" src="<?php echo e(asset('img/logo.png')); ?>" alt="CAPPSERITO"></a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="registro-chef.html#ayuda">AYUDA</a>
                    </li> -->
                    <?php if(Auth::guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#" class="btn boton-enviar" data-toggle="modal" data-target="#modal-login">INICIAR SESIÓN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#" class="btn boton-enviar" data-toggle="modal" data-target="#modal-registrarse">REGISTRARSE</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="javascript:void(0)" class="btn boton-enviar">VER MI CUENTA</a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                        <a class="nav-link js-scroll-trigger" href="#" class="btn boton-enviar" onclick="event.preventDefault();document.getElementById('logout-form').submit();">CERRAR SESIÓN</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal login -->
    <div class="modal modal-registro fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form class="container" id="form-header-login" onsubmit="return false;">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" v-model="user.email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" v-model="user.password">
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-left">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" v-model="user.remember">
                            <label class="custom-control-label" for="customCheck1">Recordarme</label>
                        </div>
                        <div class="col-sm-8 text-right">
                            <a class="text-naranja" href="javascript:void(0)">Olvide mi contraseña</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm text-center">
                            <button type="submit" class="btn boton-enviar btn-lg btn-block font-weight-bol" :disabled="sending">
                                <template v-if="!sending">
                                    Ingresar
                                </template>
                                <template v-else>
                                    <i class="fa fa-spinner fa-spin"></i>
                                </template>
                            </button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="row">
                    <div class="col-sm text-center">
                        ¿Todavía no tienes una cuenta? <a class="text-naranja" href="javascript:void(0)" v-on:click="registerView()">Registrate</a> 
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- Modal Registrarse -->
    <div class="modal modal-registro fade" id="modal-registrarse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <h5 class="modal-title" id="exampleModalLabel">Regístrate</h5>
                        </div>
                    </div>
                </div>
                <form class="container" id="form-header-register" onsubmit="return false;">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nombre" name="name" v-model="userNew.name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Apellido" name="last_name" v-model="userNew.last_name">
                    </div>
                    <div class="form-group">
                        <input type="number" min="999999" minlength="6" class="form-control" placeholder="Documento de identidad" name="dni" v-model="userNew.dni">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" v-model="userNew.email">
                    </div>
                    <div class="form-group">
                        <input type="phone" class="form-control" placeholder="Número de Teléfono" name="phone" v-model="userNew.phone">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Contraseña de acceso" name="password" id="password-register" v-model="userNew.password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirmar la Contraseña" name="password2" v-model="userNew.password2">
                    </div>
                    <div class="row">
                        <div class="col-sm text-left">
                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">Recibir novedades por email</label>
                        </div>
                        <div class="col-sm text-left">
                            Ver <a class="text-naranja" href="javascript:void(0)">Términos y condiciones</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm text-center">
                            <button type="submit" class="btn boton-enviar btn-lg btn-block font-weight-bol" :disabled="sending">
                                <template v-if="!sending">
                                    Ingresar
                                </template>
                                <template v-else>
                                    <i class="fa fa-spinner fa-spin"></i>
                                </template>
                            </button>
                        </div>
                    </div>
                    <br>
                </form>

                <br>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('vuejs'); ?>
<script type="text/javascript">
    <?php if(Auth::guest()): ?>
        const USER_ID_LOGIN = null;
        console.log(USER_ID_LOGIN);
    <?php else: ?>
        const USER_ID_LOGIN = "<?php echo e(Auth::user()->id); ?>";
        console.log(USER_ID_LOGIN);
    <?php endif; ?>
</script>
<script type="text/javascript">
    const componentHeader2 = new Vue({
        el: '#component-header-2',
        data: {
            user: {
                email: '',
                password: '',
                remember: '',
            },
            userNew: {
                name: '',
                dni: '',
                email: '',
                phone: '',
                last_name: '',
                password: '',
                password2: '',
            },
            sending: false,
            errorMessage: '',
        },
        methods: {
            login()
            {
                this.sending = true;
                axios.post('/admin_/login', this.user).then(response => {
                    console.log(response.data);
                    this.sending = false;
                    Swal.fire({
                        title: '¡Acceso completado!',
                        text: "Se ha iniciado sesión con éxito.",
                        icon: 'success',
                    });
                    // swal("Acceso completado!", "Se ha iniciado sesión con éxito.", "success");
                    location.reload();
                }).catch(error => {
                    this.errors = error.response.data;
                    console.log(this.errors);
                    this.sending = false;
                    Swal.fire({
                        title: '¡Error!',
                        text: this.errors.errors,
                        icon: 'error',
                    });
                    // swal("¡Error!", this.errors.errors, "error");
                });
            },
            registerView()
            {
                $("#modal-login").modal('hide');
                setTimeout(function(){
                    $("#modal-registrarse").modal('show');
                }, 500);
            },
            loginView()
            {
                $("#modal-registrarse").modal('hide');
                setTimeout(function(){
                    $("#modal-login").modal('show');
                }, 500);
            },
            register()
            {
                if (this.userNew.password.length < 6 || this.userNew.password.length > 10) {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'La contraseña debe ser completada, debe tener un mínimo de 6 carácteres y un máximo de 10 carácteres',
                        icon: 'error',
                    });
                    return false;
                }

                if (this.userNew.password2 != this.userNew.password) {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'La contraseña debe ser confirmada',
                        icon: 'error',
                    });
                    return false;
                }
                this.sending = true;

                axios.post('api/v1/registro-client', this.userNew).then(response => {
                    // console.log(response.data);
                    Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: 'Se ha guardado con éxito',
                          showConfirmButton: false,
                          timer: 1300
                        });
                    this.sending = false;
                    this.userNew = {
                        name: '',
                        dni: '',
                        email: '',
                        phone: '',
                        last_name: '',
                        password: '',
                        password2: '',
                    }
                    
                    this.loginView();
                }).catch(error => {
                    console.log(error);
                    this.sending = false;
                    if (typeof error.response.data.errors !== 'undefined') {                        
                        this.errors = $.map(error.response.data.errors, function(value, index) {
                            var err = '';
                            $.map(value, function(v, i){
                                err = v;
                            });
                                //this.errors[index].push() = [value];
                                return [err];
                            });
                        this.showErrorMessage(this.errors);
                    } else {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'Se ha producido un error',
                            icon: 'error',
                        });
                    }
                });
                console.log('registrar nuevo');
            },
            showErrorMessage: function(messages = []){
                this.errorMessage = '';
                for (var i = 0; i < messages.length; i++) {
                    this.errorMessage += '<b>' + (i + 1) + '. ' + messages[i] + '</b><br/>';
                }
                Swal.fire({
                    title: '¡Error!',
                    html: this.errorMessage,
                    icon: 'error',
                });
            },
        },
        mounted(){
            /*$('.table-responsive').responsiveTable({
                addDisplayAllBtn: 'btn btn-secondary'
            });*/
            var vm = this;


            jQuery('#form-header-login').validate({
                errorClass: 'help-block',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    jQuery(e).parents('.form-group').append(error);
                },
                highlight: function(e) {
                    jQuery(e).removeClass('is-valid').addClass('is-invalid');
                },
                success: function(e) {
                    var p =  jQuery(e).closest('.form-group')
                    // .children('.input-group')
                    .children('.form-control')
                    .removeClass('is-invalid')
                    .addClass('is-valid');
                    jQuery(e).remove();
                },
                submitHandler: function(form) {
                    // component.login(jQuery("#form").serialize());
                    vm.login();
                },
                rules: {
                    'email': {
                        required: true,
                        email: true,
                    },
                    'password': {
                        required: true,
                        minlength: 6,
                        maxlength: 10
                    },
                },
                messages: {
                    'email': {
                        required: 'Este Campo es obligatorio.',
                        email: true,
                    },
                    'password': {
                        required: 'Este Campo es obligatorio.',
                        minlength: 'La contraseña debe contener entre 6 y 10 carácteres',
                        maxlength: 'La contraseña debe contener entre 6 y 10 carácteres',
                    },
                }
            });

            jQuery('#form-header-register').validate({
                errorClass: 'help-block',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    jQuery(e).parents('.form-group').append(error);
                },
                highlight: function(e) {
                    jQuery(e).removeClass('is-valid').addClass('is-invalid');
                },
                success: function(e) {
                    var p =  jQuery(e).closest('.form-group')
                    // .children('.input-group')
                    .children('.form-control')
                    .removeClass('is-invalid')
                    .addClass('is-valid');
                    jQuery(e).remove();
                },
                submitHandler: function(form) {
                    // component.login(jQuery("#form").serialize());
                    vm.register();
                },
                rules: {
                    'name': {
                        required: true,
                    },
                    'dni': {
                        required: true,
                        minlength: 6,
                    },
                    'email': {
                        required: true,
                        email: true,
                    },
                    'phone': {
                        required: true,
                    },
                    'last_name': {
                        required: true,
                    },
                    'password': {
                        required: true,
                        minlength: 6,
                        maxlength: 10
                    },
                    'password2': {
                        equalTo: '#password-register',
                    },
                },
                messages: {
                    'name': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'dni': {
                        required: 'Este Campo es obligatorio.',
                        minlength: 'Debe tener un mínimo de 6 carácteres',
                    },
                    'email': {
                        required: 'Este Campo es obligatorio.',
                        email: true,
                    },
                    'phone': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'last_name': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'password': {
                        required: 'Este Campo es obligatorio.',
                        minlength: 'Rango mínimo de la contraseña es de 6 carácteres',
                        maxlength: 'Rango máximo de la contraseña es de 10 carácteres',
                    },
                    'password2': {
                        equalTo: 'La contraseña no coinciden',
                    },
                }
            });

            $.validator.methods.email = function( value, element ) {
              return this.optional( element ) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
            }
        }
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/layouts/website/header2.blade.php ENDPATH**/ ?>