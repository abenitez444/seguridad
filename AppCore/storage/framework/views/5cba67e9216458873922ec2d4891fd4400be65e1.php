<?php $__env->startSection('title'); ?>Políticas <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="page-title-box">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h4 class="page-title">
					Políticas
				</h4>

			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>/">Estadísticas</a></li>
					<li class="breadcrumb-item active">Políticas</li>
				</ol>
			</div>
		</div> <!-- end row -->
	</div>
	<!-- end page-title -->

	<div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                	<iframe id="descFrame" embedded="true" scrolling="auto" name="descFrame" src="<?php echo e(asset('/storage/docs/politica/')); ?>/<?php echo e($pdf); ?>" width="100%" height="600" frameborder="0"></iframe> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/chart.js/dist/Chart.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/showPolitics.blade.php ENDPATH**/ ?>