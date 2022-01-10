<?php $__env->startSection('title'); ?>Programaciones <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<!-- fullCalendar -->
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fullcalendar/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fullcalendar-daygrid/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fullcalendar-timegrid/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fullcalendar-bootstrap/main.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Listados de Programación</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Programación</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content" id="app-main">

	<!-- Default box -->
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Listados de programación</h3>

			<div class="card-tools">
				<a href="<?php echo e(route('admin.assignment.create')); ?>"><button class="btn btn-primary mr-1 mb-1"><i class="fa fa-plus-square"></i> Agregar / Editar</button></a>
			</div>
		</div>
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6"></div>
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
            <div class="row table-responsive mt-1">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                	<datatable class="table table-hover table-hover-animation mb-0" :columns="columns" :data="rows" :filter="filter">
	                    <template slot-scope="{ row }">
	                        <tr>
	                            <td class="text-center">{{ row.id }}</td>
	                            <td class="text-center">{{ row.client.name }}</td>
	                            <td class="text-center">{{ row.client.num_services }}</td>
	                            <td class="text-center">{{ row.client.shift.name }}</td>
	                            <td class="text-center">{{ row.date_ini }}</td>
	                            <td class="text-right" style="width: 20%; white-space: nowrap;">
	                                <button type="button" class="btn btn-icon btn-outline-info mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-target="#modal-calendar" v-on:click="viewCalendar(row)"><i class="fa fa-calendar"></i> Ver calendario</button>
	                                <button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeItem(row)"><i class="fa fa-trash"></i></button>
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
		<!-- /.card-body -->
		<!-- <div class="card-footer">
			Footer
		</div>-->
		<!-- /.card-footer-->
	</div>
	<!-- /.card -->
	<!-- Modal -->
	<div class="modal modal-right fade" id="modal-calendar" tabindex="-1" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Agregar / Editar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="card card-primary">
		              	<div class="card-body p-0">
		               		<!-- THE CALENDAR -->
		                	<div id="calendar"></div>
		              	</div>
		              	<!-- /.card-body -->
		            </div>
				</div>
				<div class="modal-footer modal-footer-uniform">			
					<div class="row">
						<div class="col-12 col-md-12">
							<button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal -->
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar-daygrid/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar-timegrid/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar-interaction/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar-bootstrap/main.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/assignment-list.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/SeguridadLogro/AppCore/resources/views/admin/assignment.blade.php ENDPATH**/ ?>