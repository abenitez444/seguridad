<?php $__env->startSection('title'); ?>Tarifas de los Cocineros <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Tarifas Administrativas</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Tarifas Administrativas
                            </li>
                        </ol>
                    </div>
                </div>
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
                                    <h4 class="card-title">Listado de Tarifas</h4>
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
                                            <td class="text-left">
                                                <b>Cédula de Identidad: </b> {{ row.dni }}<br/>
                                                <b>Nombre: </b> {{ row.name }} {{ row.last_name }}<br/>
                                                <b>Correo Electrónico: </b> {{ row.email }}<br/>
                                                <b>Teléfono: </b> {{ row.phone }}<br/>
                                            </td>
                                            <td class="text-center">{{ row.administrative_fee }} %</td>
                                            <td class="text-center">{{ row.updated_at }}</td>
                                            <td class="text-right" style="width: 20%; white-space: nowrap;">
                                                <button type="button" class="btn btn-icon btn-outline-warning mr-1 mb-1 waves-effect waves-light" v-on:click="view(row)" data-toggle="modal" data-target="#modal-form"><i class="fa fa-edit"></i></button>
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
    <div class="modal modal-right fade" id="modal-form" tabindex="-1" >
        <div class="modal-dialog modal-lg">
            <form onsubmit="return false;" id="form_" class="form form-vertical">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar / Editar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <h5>Modificar tarifa del Usuario: </h5>
                                    <p>
                                        <b>Cédula de Identidad: </b> {{ user.dni }}<br/>
                                        <b>Nombre: </b> {{ user.name }} {{ user.last_name }}<br/>
                                        <b>Correo Electrónico: </b> {{ user.email }}<br/>
                                        <b>Teléfono: </b> {{ user.phone }}<br/>
                                    </p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>% Tarifa cobro por servicio *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="number" class="form-control" name="administrative_fee" v-model="user.administrative_fee">
                                            <div class="form-control-position">
                                                <i class="feather icon-percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="alert alert-primary" role="alert">
                                        <h4 class="alert-heading">IMPORTANTE: </h4>
                                        <p class="mb-0">
                                            Todos los campos con (*) deben ser completados
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">         
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true">
                                    <template v-if="!loading">
                                        <i class="fa fa-sign-in"></i> Guardar
                                    </template>
                                    <template v-if="loading">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </template>
                                </button>
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
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/users/administrative_fee.js')); ?>"></script> 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/admin/users/administrative_fee.blade.php ENDPATH**/ ?>