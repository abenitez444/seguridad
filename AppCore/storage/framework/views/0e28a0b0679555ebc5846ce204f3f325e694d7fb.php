<?php $__env->startSection('content'); ?>

<div id="app-main">
    <!-- Masthead -->
    <header class="masthead-finalizar-pedido">
        <br><br>
        <div class="container productor-empresa text-white">
            <div class="row">
                <div class="col-12">
                    <a href="<?php echo e(route('website.index')); ?>"><img style="width:80%;max-width: 300px;" src="img/logo.png" alt="CAPPSERITO"></a>
                    <br><br>
                    <h2 class="text-white">¡Finaliza tu Pedido!</h2>
                </div>
            </div>
        </div>
        <br><br>
    </header>

    <br><br><br>

    <section class="establecimientos">
        <div class="container">
            <form id="form-checking" onsubmit="return false;">
                <div class="row">
                    <div class="col-lg-6">
                        <div style="max-width: 480px;">
                            <h5 class="text-naranja">Información del usuario</h5>
                            <div class="form-group">
                                <label for="name">Nombre *</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="name" v-model="user.name" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Apellido *</label>
                                <input type="text" class="form-control" placeholder="Apellido" name="last_name" v-model="user.last_name" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label for="dni">Documento de identidad *</label>
                                <input type="text" class="form-control" placeholder="Documento de identidad" name="dni" v-model="user.dni" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" placeholder="Nombre" name="email" v-model="user.email" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección *</label>
                                <textarea class="form-control" placeholder="Dirección" name="address" v-model="user.address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="city">Ciudad / Departamento *</label>
                                <input type="text" class="form-control" placeholder="Ciudad" name="city" v-model="user.city">
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono *</label>
                                <input type="text" min="0" maxlength="11" class="form-control" placeholder="Telefono" name="phone" v-model="user.phone">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="differentAddress" v-model="sale.differentAddress"> Eviar a una dirección diferente
                            </div>
                            
                            <br/>
                            <div v-if="sale.differentAddress">
                                <h5 class="text-naranja">Información para el envió</h5>
                                <div class="form-group">
                                    <label for="address">Dirección de envió *</label>
                                    <textarea class="form-control" placeholder="Dirección de envió" name="shippingAddress" v-model="sale.shippingAddress"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="city">Ciudad / Departamento *</label>
                                    <input type="text" class="form-control" placeholder="Ciudad" name="salecity" v-model="sale.city">
                                </div>  
                                <div class="form-group">
                                    <label for="city">Carrera *</label>
                                    <input type="text" class="form-control" placeholder="Carrera" name="carrera" v-model="sale.carrera">
                                </div>  
                                <div class="form-group">
                                    <label for="city">Calle *</label>
                                    <input type="text" class="form-control" placeholder="Calle" name="street" v-model="sale.street">
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-naranja">Seleccione el medio de pago</h5>
                                    <button type="button" class="btn boton-enviar mb-3 mr-3" v-for="pay in methodsPay" v-on:click="selectedPay(pay)">{{ pay.name }}</button>
                                </div>
                                <div class="col-12" v-if="sale.pay_id == null">
                                    <p>No ha seleccionado un método de pago disponible por el establecimiento</p>
                                </div>
                                <div class="col-12" v-if="sale.pay_id == 1">
                                    <p>Usted ha seleccionado como forma de pago el servicio: <b>{{ pay.name }}</b></p>
                                    <img v-if="pay.pivot.image != null" :src="'<?php echo e(asset('/storage')); ?>/'+pay.pivot.image" style="max-width: 100%;">
                                </div>
                            </div>


                            <br>

                            <h5 class="text-naranja">Notas adicionales</h5>
                            <div class="form-group">
                                <textarea class="form-control" name="notes" v-model="sale.notes" placeholder="Notas adicionales en el pedido"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="terminos-condiciones"> He leído y estoy de acuerdo con los Términos y Condiciones y con las Políticas y tratamiento de datos personales
                                <!-- <input type="checkbox" class="custom-control-input" id="terminos-condiciones" required="required">
                                <label class="custom-control-label" for="terminos-condiciones">He leído y estoy de acuerdo con los Términos y Condiciones y con las Políticas y tratamiento de datos personales</label> -->
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn boton-enviar">
                                    <template v-if="!sending">
                                        Finalizar pedido
                                    </template>
                                    <template v-else>
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </template>
                                </button>
                            </div>

                            <br><br>
                        </div>
                    </div>


                    <div class="col-lg-2">

                    </div>



                    <div class="col-lg-4 text-gray text-center">

                        <div class="productos-testimonios">
                            <div class="card card-pedidos" v-if="cart.services.length > 0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-10 text-left">
                                            Mi pedido
                                        </div>
                                        <div class="col-2 text-right">
                                            <button class="btn boton-eliminar" v-on:click="deleteCart()"><img width="25px" src="<?php echo e(asset('img/delete.svg')); ?>" alt="Eliminar"></button>
                                        </div>
                                        <br>
                                        <div class="col-sm-12 text-center">
                                            <p>
                                                Envío para la calle 15 # 125 - 63
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row" v-for="serv in cart.services">
                                        <div class="col-sm-4">
                                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:55px;" v-model="serv.pivot.count" v-on:change="updatedCart(serv)">
                                                <?php
                                                    for ($i=0; $i < 101; $i++) { 
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-8">
                                            <h5 class="text-naranja">{{ serv.name }}</h5>
                                            <h6>$ {{ serv.price_total }}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 text-left">
                                            <h6>Envío</h6>
                                        </div>
                                        <div class="col-sm-8 ">
                                            <h6>$ {{ cart.shippingCost }}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 text-left">
                                            <h6>Subtotal</h6>
                                        </div>
                                        <div class="col-sm-8 ">
                                            <h6>$ {{ cart.subTotal }}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4 text-left">
                                            <h5>Total</h5>
                                        </div>
                                        <div class="col-sm-8">
                                            <h5>$ {{ cart.total }}</h5>
                                        </div>
                                    </div>
                                    <br>
                                    <a href="javascript:void(0)"><button type="submit" class="btn boton-enviar" :disabled="sending">FINALIZAR PEDIDO</button></a>
                                </div>
                            </div>

                            <br><br>

                        </div>

                    </div>


                </div>
            </form>
        </div>
    </section>

</div>  

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
    new Vue({
        el: '#app-main',
        data: {
            cart: {
                id: '',
                total: '',
                subTotal: '',
                services: [],
            },
            user: {
                image: null,
                name: '<?php echo e(Auth::user()->name); ?>',
                last_name: '<?php echo e(Auth::user()->last_name); ?>',
                dni: '<?php echo e(Auth::user()->dni); ?>',
                email: '<?php echo e(Auth::user()->email); ?>',
                phone: '<?php echo e(Auth::user()->phone); ?>',
                address: '<?php echo e(Auth::user()->address); ?>',
                password: '<?php echo e(Auth::user()->password); ?>',
                password2: '',
                cellular: '<?php echo e(Auth::user()->cellular); ?>', 
                neighborhood: '<?php echo e(Auth::user()->neighborhood); ?>',
                city: '<?php echo e(Auth::user()->city); ?>',
                postal_code: '<?php echo e(Auth::user()->postal_code); ?>',
            }, 
            sale: {
                shippingAddress: '',
                city: '',
                neighborhood: '',
                carrera: '',
                street: '',
                notes: '',
                pay_id: null,
                differentAddress: false,
            },
            methodsPay: [],
            pay: {name: '', pivot: {image: null}},
            count: 1,
            aclaraciones: '',
            sending: false,
        },
        methods: {
            getMethodsPayCook()
            {
                axios.get('/api/v1/get-methods-pay/' + this.cart.id + '/').then(response => {
                    console.log(response.data);
                    this.methodsPay = response.data;
                });
            },
            getCart()
            {
                axios.get('/get-cart').then(response => {
                    console.log(response.data);
                    this.cart = response.data;
                    this.getMethodsPayCook();
                });
            },
            deleteCart() {
                axios.post('/api/v1/delete-cart', {id: this.cart.id}).then(response => {
                    console.log(response.data);
                    this.getCart();
                });
            },
            updatedCart(serv)
            {
                this.sending = true;
                var vm = this;
                var new_order = {
                    cart_id: this.cart.id,
                    service_id: serv.id,
                    count: serv.pivot.count,
                    aclaraciones: serv.pivot.aclaraciones,
                };
                axios.post('/update-cart', new_order).then(response => {
                    console.log(response.data);
                    this.getCart();
                    this.sending = false;
                    $("#modal-producto").modal('hide');
                }).catch(error => {
                    this.sending = false;
                    console.log(error);
                });
            },
            selectedPay(pay)
            {
                if (pay.id != 1) {
                    this.sale.pay_id = null;
                    return false;
                }
                this.pay = pay;
                this.sale.pay_id = pay.id
            },
            saveForm()
            {
                if (this.sale.pay_id == null) {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Debe seleccionar la forma de pago para completar la operación',
                        icon: 'error',
                    });
                    return false;
                }
                var order = {
                    user: this.user,
                    sale: this.sale,
                    cart: this.cart,
                }
                this.sending = true;
                var pay_id = this.sale.pay_id;
                axios.post('/save-order', order).then(response => {
                    console.log(response.data);
                    this.sending = true;
                    if (pay_id == 1) {
                        Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: 'Se ha enviado con exitó, será atentido en la breveda posible para información de su pedido, muchas gracias por su compra.',
                          showConfirmButton: true,
                          timer: 5000
                        }).then((result) => {
                            if(result.value)
                            {
                                location.href = APP_URL;
                            }
                        });

                        setTimeout(function(){
                            location.href = APP_URL;
                        }, 5000);
                        
                    }
                }).catch(error => {
                    this.sending = false;
                    console.log(error);
                });
                console.log('Enviar pedido');
            },
        },
        mounted()
        {
            var vm = this;
            jQuery('#form-checking').validate({
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
                    vm.saveForm();
                },
                rules: {
                    'name': {
                        required: true,
                    },
                    'email': {
                        required: true,
                        email: true,
                    },
                    'phone': {
                        required: true,
                    },
                    'city': {
                        required: true,
                    },
                    'address': {
                        required:  true,
                    },
                    'last_name': {
                        required: true,
                    },
                    'dni': {
                        required: true,
                    },
                    'phone': {
                        required: true,
                    },
                    'shippingAddress': {
                        required: true,
                    },
                    'salecity': {
                        required: true,
                    },
                    'carrera': {
                        required: true,
                    },
                    'street': {
                        required: true,
                    },
                    'terminos-condiciones': {
                        required: true,
                    }
                },
                messages: {
                    'name': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'email': {
                        required: 'Este Campo es obligatorio.',
                        email: 'Debe ingresar un email válido',
                    },
                    'phone': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'city': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'address': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'last_name': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'dni': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'phone': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'shippingAddress': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'salecity': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'carrera': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'street': {
                        required: 'Este Campo es obligatorio.'
                    },
                    'terminos-condiciones': {
                        required: 'Debe aceptar los términos y condiciones'
                    }
                }
            });

            $.validator.methods.email = function( value, element ) {
              return this.optional( element ) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
            }
        },
        created(){
            this.getCart();
        }
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/website/checking.blade.php ENDPATH**/ ?>