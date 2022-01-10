<?php $__env->startSection('title'); ?>Ordenes / Solicitudes <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Ordenes / Solicitudes</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Ordenes / Solicitudes
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <!-- <button class="btn btn-dark mr-1 mb-1 waves-effect waves-light" @click="addNew()" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus-square"></i> Agregar</button> -->
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Simple Validation start -->
        <section class="simple-validation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        	<div class="row"  style="width: 90%">
                        		<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        			<h4 class="card-title">Listado de pedidos</h4>
                        		</div>
                        		<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        			<div class="row">
                            			<div class="col-12 col-md-9">
                            				<div class="row">
                            					<div class="col-12 col-sm-12 col-md-12">
                            						Filtrar: 
                            					</div>
                            				</div>
                            				<input type="text" name="filter" v-model="filter" class="form-control" placeholder="Escriba para filtrar los resultados">
                            			</div>
                            			<div class="col-12 col-md-3">
                            				<div class="row">
                            					<div class="col-12 col-sm-12 col-md-12">
                            						Mostrar: 
                            					</div>
                            				</div>
                            				<select class="form-control" v-model="pagination.per_page" v-on:change="getAllWithPagination()">
                                        		<option value="10">10</option>
                                        		<option value="15">15</option>
                                        		<option value="20">20</option>
                                        		<option value="50">50</option>
                                        		<option value="75">75</option>
                                        		<option value="100">100</option>
                                        		<option value="150">150</option>
                                        		<option value="300">300</option>
                                        		<option value="500">500</option>
                                                <option value="1000">1000</option>
                                                <option value="1500">1500</option>
                                                <option value="2000">2000</option>
                                        		<option value="5000">5000</option>
                                        		<option :value="pagination.total+1">Todo</option>
                                        	</select>
                            			</div>
                            		</div>
                            	</div>
                        	</div>
                    		<div class="heading-elements">
                                <ul class="list-inline mb-0">
                                	<li>
                                		
                                	</li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    <li><a v-on:click="getAllWithPagination()"><i class="feather icon-rotate-cw"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body table-responsive">
                            	<datatable class="table table-hover table-hover-animation mb-0" :columns="columns" :data="rows" :filter="filter">
                            		<template slot-scope="{ row }">
                            			<tr>
                            				<td class="text-center">{{ row.id }}</td>
                            				<td class="text-center">
                                                {{ row.client.name }}
                                                {{ row.client.email }}
                                                {{ row.client.phone }}
                                            </td>
                                            <td class="text-center">{{ row.created_at }}</td>
                                            <td class="text-center">{{ row.total }}</td>
                            				<td class="text-center">
                                                <span v-if="row.status == 'Solicitado'"  class="badge badge-info badge-pill">SOLICITADO</span>
                                                <span v-if="row.status == 'Cancelado'"  class="badge badge-danger badge-pill">CANCELADO</span>
                                            </td>
                            				<!-- <td class="text-center">
                            					<is-active :is_active="row.is_active"></is-active>
                            				</td> -->
                            				<td class="text-right" style="width: 20%; white-space: nowrap;">
												<button type="button" class="btn btn-icon btn-outline-info mr-1 mb-1 waves-effect waves-light" v-on:click="view(row)" data-toggle="modal" data-target="#modal-detail-order"><i class="fa fa-eye"></i> Ver Detalles</button>
												<!-- <button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeItem(row)"><i class="fa fa-trash"></i></button> -->
											</td>
                            			</tr>
                            		</template>
                            	</datatable>
                            	<nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center mt-2">
                                        <li class="page-item prev-item" v-if="pagination.current_page > 1" v-on:click="changePage(pagination.current_page - 1)">
                                        	<a class="page-link" href="javascript:void(0)">
                                                <i class="feather icon-chevron-left"></i>
                                            </a>
                                        </li>

                                        <li class="page-item" v-for="page in pagesNumber" :class="page == isActived ? 'active' : '' " aria-current="page"><a class="page-link" href="javascript:void(0)" v-on:click="changePage(page)">{{ page }}</a></li>
                                        
                                        <li class="page-item next-item">
                                        	<a class="page-link" href="javascript:void(0)" v-if="pagination.current_page < pagination.last_page" v-on:click="changePage(pagination.current_page + 1)">
                                            	<i class="feather icon-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
	<div class="modal modal-right fade" id="modal-detail-order" tabindex="-1" >
		<div class="modal-dialog modal-lg">
			<form onsubmit="return false;" id="form_" class="form form-vertical">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Detalle de orden o pedido</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-body">
                            <section class="card invoice-page">
                                <div id="invoice-template" class="card-body">
                                    <!-- Invoice Company Details -->
                                    <div id="invoice-company-details" class="row">
                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                            <div class="invoice-details mt-2">
                                                <h6>PEDIDO NO.</h6>
                                                <p>{{ order.id }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                            <h6 class="mt-2">FECHA DE SOLUCITUD</h6>
                                            <p>{{ order.created_at }}</p>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-right">
                                            <h6 class="mt-2">STATUS DE SOLUCITUD</h6>
                                            <p>
                                                <span v-if="order.status == 'Solicitado'"  class="badge badge-info badge-pill">SOLICITADO</span>
                                                <span v-if="order.status == 'Cancelado'"  class="badge badge-danger badge-pill">CANCELADO</span>
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <!--/ Invoice Company Details -->

                                    <!-- Invoice Recipient Details -->
                                    <div id="invoice-customer-details" class="row pt-2">
                                        <div class="col-md-6 col-sm-12 text-left">
                                            <h5>CLIENTE</h5>
                                            <div class="recipient-info my-2">
                                                <p>{{ order.client.dni }}</p>
                                                <p>{{ order.client.name }} {{ order.client.last_name }}</p>
                                                <p><i class="feather icon-mail"></i> {{ order.client.email }}</p>
                                                <p><i class="feather icon-phone"></i> {{ order.client.phone }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 text-right">
                                            <div class="recipient-contact pb-2" v-if="!order.differentAddress">
                                                <h5>DIRECCIÓN PARA EL ENVIÓ: </h5>
                                                <p>
                                                    <strong>Ciudad:</strong> {{ order.client.city }}
                                                </p>
                                                <p>
                                                    <strong>Barrio:</strong> {{ order.client.neighborhood }}
                                                </p>
                                                <p>
                                                    <strong>Dirección detallada:</strong> {{ order.client.address }}
                                                </p>
                                            </div>
                                            <div class="recipient-contact pb-2" v-if="order.differentAddress">
                                                <h5>DIRECCIÓN PARA EL ENVIÓ: </h5>
                                                <p>
                                                    <strong>Ciudad:</strong> {{ order.city }}
                                                </p>
                                                <p>
                                                    <strong>Barrio:</strong> {{ order.neighborhood }}
                                                </p>
                                                <p>
                                                    <strong>Calle:</strong> {{ order.street }},
                                                    <strong>Carrera: </strong> {{ order.carrera }}
                                                </p>
                                                <p>
                                                    <strong>Dirección detallada:</strong> {{ order.shippingAddress }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-12">
                                            <h5>DETALLE DE PAGO:</h5>
                                            <p>
                                                Método de pago seleccionado por el cliente: <b>{{ order.paymentGateway.name }}</b>
                                            </p>
                                        </div>
                                        <div class="col-md-6 col-sm-12 text-right" v-if="order.status == 'enviado'">
                                            <h5>DETALLE DEL ENVIO</h5>
                                        </div>
                                    </div>
                                    <!--/ Invoice Recipient Details -->

                                    <!-- Invoice Items Details -->
                                    <div id="invoice-items-details" class="pt-1 invoice-items-table">
                                        <div class="row">
                                            <div class="table-responsive col-sm-12">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th>SERVICIO</th>
                                                            <th>PRECIO UNITARIO</th>
                                                            <th>CANTIDAD</th>
                                                            <th>ACLARACIONES</th>
                                                            <th>TOTAL</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="service in order.services">
                                                            <td>{{ service.name }}</td>
                                                            <td>{{ service.pivot.price_total }}</td>
                                                            <td>{{ service.pivot.count }}</td>
                                                            <td>{{ service.pivot.aclaraciones }}</td>
                                                            <td>$ {{ service.pivot.count * service.pivot.price_total  }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="invoice-total-details" class="invoice-total-table">
                                        <div class="row">
                                            <div class="col-7 offset-5">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <th>SUBTOTAL</th>
                                                                <td>$ {{ order.subTotal }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>ENVIÓ </th>
                                                                <td>$ {{ order.shippingCost }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>TOTAL</th>
                                                                <td>$ {{ order.total }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-left recipient-contact pt-3">
                                        <h5>NOTAS DEL CLIENTES:</h5>
                                        <p>{{ order.notes }}</p>
                                    </div>

                                    <!-- Invoice Footer -->
                                    <div id="invoice-footer" class="text-left pt-3" v-if="order.status == 'Solicitado'">
                                        <p>El pedido seleccionado esta en proceso, acá puede realizar las siguinetes operaciones que desee.</p>
                                            <p class="bank-details mb-0">
                                                <button class="btn btn-outline-danger mr-3 mb-3" v-on:click="cancelOrder()">Cancelar pedido</button>
                                                <button class="btn btn-outline-info mr-3 mb-3">Aceptar pedido</button>
                                                <button class="btn btn-outline-primary mr-3 mb-3">Pedido listo, enviar al cliente</button>
                                            </p>
                                    </div>
                                    <!--/ Invoice Footer -->

                                </div>
                            </section>
                        </div>
					</div>
					<div class="modal-footer modal-footer-uniform">			
						<div class="row">
							<div class="col-12 col-md-12">
								<button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>
								<!-- <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true">
                                    <template v-if="!loading">
                                        <i class="fa fa-sign-in"></i> Guardar
                                    </template>
                                    <template v-if="loading">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </template>
                                </button> -->
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- /.modal -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/cooks/orders.js')); ?>"></script> 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/cooks/orders.blade.php ENDPATH**/ ?>