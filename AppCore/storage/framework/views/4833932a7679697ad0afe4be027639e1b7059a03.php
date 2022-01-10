<?php $__env->startSection('content'); ?>

<div class="container" id="content">
	
	<img src="<?php echo e(asset('img/flecha.png')); ?>" alt="" class="position-absolute flecha mpr">
	<!--<div class="row mt-5">
		<div class="col-md-12 d-flex justify-content-center">
			<ul class="nav">
			  <li class="nav-item mw-100 ">
			    <a class="nav-link active tc-black" href="#">SUBCATEGORIA <span class="fas fa-angle-down ml-2"></span></a>
			  </li>
			  <li class="nav-item mw-100 ">
			    <a class="nav-link tc-black" href="#">MESAS <span class="fas fa-angle-down ml-2"></span></a>
			  </li>
			  <li class="nav-item mw-100 ">
			    <a class="nav-link tc-black" href="#">PUESTOS <span class="fas fa-angle-down ml-2"></span></a>
			  </li>
			  <li class="nav-item mw-100">
			    <a class="nav-link tc-black" href="#">BIBLIOTECAS / CENTROS DE ENTRETENIMIENTOS <span class="fas fa-angle-down ml-2"></span></a>
			  </li>
			  <li class="nav-item mw-100 ">
			    <a class="nav-link tc-black" href="#">COLOR <span class="fas fa-angle-down ml-2"></span></a>
			  </li>
			  <li class="nav-item mw-100 ">
			    <a class="nav-link tc-black" href="#">ACABADO <span class="fas fa-angle-down ml-2"></span></a>
			  </li>
			</ul>
		</div>
	</div>-->

	<div class="row">
		<div class="col-md-12 text-center mt-3">
			<h2 class="tc-verde mb-0"><span class="bg-rosado">TODOS LOS</span></h2>
			<h2 class="tc-verde"><span class="bg-rosado">PRODUCTOS</span></h2>
			<img src="<?php echo e(asset('img/cuadro.png')); ?>" alt="" class="position-absolute cuadro-salas">
		</div>
	</div>

	<div class="row mb-5">
		<div class="col-md-4" v-for="article in articles">
			<div class="card mt-3 l-10" style="width: 80%;">
			  <img class="card-img-top" :src="'<?php echo e(asset('storage/')); ?>/' + article.main_image" alt="article.name">
			  <div class="position-absolute bg-verde circulo text-center">
			  	<h6 class="tc-blanco size-8 vmt-30"><span class="bg-rosado">ENTREGA EN</span></h6>
			  	<h4 class="tc-blanco size-1"><span class="bg-rosado">8 DÍAS</span></h4>
			  </div>
			  <div class="card-body pr-1 pl-1 pb-1">
			  	<div class="bg-griss2 pt-1 pb-1">
			    <a :href="'<?php echo e(asset('shop/product')); ?>/' + article.slug"><h6 class="card-title text-center mt-2"><span class="bg-rosado">VISTA RÁPIDA</span></h6></a>
			    </div>
				<h6 class="size-8 mt-1 mb-1 centrar-mobile"><span class="bg-rosado">{{ article.name }}</span></h6>	
				<div class="col-md-12">
			    <div class="row">
			    	<div class="col-md-4 mt-1 centrar-mobile">
			    		<!-- <h6 class="size-8"><span class="bg-rosado">$ 960.990,00</span></h6> -->
			    	</div>
			    	<div class="col-md-4 pr-0 pl-0 mt-1 centrar-mobile">
			    		<h2 class="size-1">
			    			<span class="bg-rosado">
			    				{{ currency.symbol }} <money type="hidden" v-model="article.price"  v-bind="money">{{ article.price }}</money>
			    				<span v-money="money" v-bind="money"> {{article.price}}</span>
			    			</span>
			    		</h2>
			    	</div>
			    	<div class="col-md-4 mt-1 centrar-mobile">
			    		<h6 class="size-8"><span class="bg-rosado">incl. IVA</span></h6>
			    	</div>
			    </div>
			    </div>
				
				<button class="btn btn-default w-100" v-on:click="addCart(article)">AGREGAR</button>

			  </div>

			</div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-12 text-center d-flex justify-content-center">
			<nav aria-label="Page navigation example" v-if="articles.length > 0">
			  <ul class="pagination">
			    <li class="page-item"><a class="page-link tc-verde" href="javascript:void(0)" v-on:click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page < 1" v-if="pagination.current_page > 1">Prev.</a></li>
			    <li class="page-item" v-for="page in pagesNumber" >
			    	<a class="page-link tc-verde" href="javascript:void(0)" v-bind:class="[ page == isActived ? 'active' : '' ]" v-on:click="changePage(page)" :disabled="pagination.current_page == page">{{ page }}</a>
			    </li>
			    <li class="page-item"><a class="page-link tc-verde" href="javascript:void(0)" v-on:click="changePage(pagination.current_page + 1)" v-if="pagination.current_page < pagination.last_page">Next</a></li>
			  </ul>
			</nav>
		</div>
	</div>
	

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/shopList.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/website/shop/shopList.blade.php ENDPATH**/ ?>