<?php $__env->startSection('title'); ?>Reportes de Traslados <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Reportes de traslados de vigilantes</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Reportes de traslados de vigilantes</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content" id="app-main">

	<!-- Default box -->
	<div class="card">
        <div class="overlay dark" v-if="loading">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
		<div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <h3 class="card-title">Listados de reportes</h3>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-rigth">
                    <button type="submit" class="btn btn-secondary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true || query_s.watchmen == ''" v-on:click="printReport()">
                        <template v-if="!loading">
                            <i class="fa fa-file"></i> Imprimir PDF
                        </template>
                        <template v-if="loading">
                            <i class="fa fa-spinner fa-spin"></i>
                        </template>
                    </button>
                </div>
            </div>
		</div>
		<div class="card-body">
			<div class="row mb-3">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Vigilante *</label>
                                <div class="input-group mb-3">
                                    <select class="form-control" name="watchmen" v-model="query_s.watchmen">
                                        <option value="all">-- TODOS --</option>
                                        <option v-for="w in all_watchmen" :value="w.id" v-if="w.is_delete == 0">{{ w.name }}</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user-secret"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="type" v-model="query_s.type">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        	<div class="form-group">
                                <label>Desde *</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="date_ini" v-model="query_s.date_ini" :disabled="query_s.watchmen == ''">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user-clock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        	<div class="form-group">
                                <label>Hasta *</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="date_end" v-model="query_s.date_end" :disabled="query_s.watchmen == ''">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user-clock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                        	<div class="form-group">
                        		<div class="input-group input-group mt-4 p-1">
                        			<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true || query_s.type == ''" v-on:click="getReport()">
		                                <template v-if="!loading">
		                                    <i class="fa fa-sign-in"></i> Buscar
		                                </template>
		                                <template v-if="loading">
		                                    <i class="fa fa-spinner fa-spin"></i>
		                                </template>
		                            </button>
                        		</div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row table-responsive mt-1" v-if="rows.length">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                	<datatable class="table table-hover table-hover-animation mb-0" :columns="columns" :data="rows" :filter="filter">
	                    <template slot-scope="{ row }">
	                        <tr>
                                <td>{{ row.created_at.split(' ')[0] }}</td>
                                <td>{{ row.watchmen.name }}</td>
                                <td>
                                    {{ row.clients_origin.name }}<br/>
                                    <label>Desde: </label>{{ row.assignment_watchmen_origin.pivot.date_ini }}<br/>
                                    <label>Hasta: </label>{{ row.assignment_watchmen_origin.pivot.date_end }}<br/>
                                </td>
                                <td>{{ row.assignment_watchmen_origin.shift.name }}</td>
                                <td>
                                    {{ row.clients_destiny.name }}
                                    <label>Desde: </label>{{ row.start_date_vigilant }}<br/>
                                </td>
                                <td>{{ row.assignment_watchmen_destiny.shift.name }}</td>
	                        </tr>
	                    </template>
	                </datatable>
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
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<!-- <script type="text/javascript">const TYPE_NEW = "{$type }";</script> -->
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/reports-operations.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/programacionlogr/public_html/AppCore/resources/views/admin/reports-operations.blade.php ENDPATH**/ ?>