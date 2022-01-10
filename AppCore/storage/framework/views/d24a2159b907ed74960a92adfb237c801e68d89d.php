<?php $__env->startSection('content'); ?>

<!--Nosotros -->
<section id="nosotros" class="nosotros bg-light text-white container">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm">
				<h2 class="text-center">Nosotros</h2>
				<h5>
					Sabemos que amas la comida tanto commo nosotros, por eso queremos llevártela a tu mesa,directo desde la cocina de los mejores restaurantes de Colombia.
					<br><br>
					Ingresa tu dirección, elige el restaurante, selecciona tu comida favorita !y ya¡ Pedir a domicilio tu comida nunca habia sido tan fácil. ¡Con Domicilios.com lo único dificil será decidir qué comer!  
				</h5>
			</div>
		</div>
	</div>
	<br><br>
</section>

<br><br>

<!--Promociones -->
<section id="promociones" class="promociones bg-light text-center">
	<div class="container">
		<h2 class="text-left">Promociones</h2>
		<div class="row">
			<div class="col-sm">
				<img src="<?php echo e(asset('img/pizza.png')); ?>" alt="Pizza">
			</div>
			<div class="col-sm">
				<img src="<?php echo e(asset('img/bebida.png')); ?>" alt="Bebidas">
			</div>
			<div class="col-sm">
				<img src="<?php echo e(asset('img/dulce.png')); ?>" alt="Dulces">
			</div>
		</div>
	</div>
</section>

<br><br>

<!--Testimonios -->
<section class="testimonios bg-light text-center text-white">
	<div class="container">
		<h2 class="text-left">Que dicen nuestros cliente</h2>
		<br><br><br>
		<div class="row">
			<div class="col-sm">
				<div class="card">
					<img class="people" src="<?php echo e(asset('img/robert-smith.png')); ?>" alt="Robert Smith">
					<img class="division" src="<?php echo e(asset('img/division.png')); ?>" alt="División">
					<div class="card-body">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
						<br>
						<p class="card-text">"Fue amigable y todo lo que probaos fue delicioso, especualmente el sous vide bistek y los huevos con arroz de coliflor al ajo."</p>
					</div>
				</div>
			</div>
			<div class="col-sm">
				<div class="card">
					<img class="people" src="<?php echo e(asset('img/regina-ontario.png')); ?>" alt="Regina Ontario">
					<img class="division" src="img/division.png" alt="División">
					<div class="card-body">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
						<br>
						<p class="card-text">"Excelente comida, gran servicio comida auténtica. Definitivamente son confiables"</p>
					</div>
				</div>
			</div>
			<div class="col-sm">
				<div class="card">
					<img class="people" src="<?php echo e(asset('img/jerry-tucson.png')); ?>" alt="Jerry Tucson">
					<img class="division" src="<?php echo e(asset('img/division.png')); ?>" alt="División">
					<div class="card-body">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
						<img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
						<br>
						<p class="card-text">"Los platos son reamente buenos, A veces los nombres no son siempre obvios, así que es bueno buscar cosas de antemano."</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<br><br><br><br><br><br>

<!--APP -->
<section class="app container text-center">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<img class="phone" src="<?php echo e(asset('img/phone.png')); ?>" alt="Movil app">
			</div>
			<div class="col-sm-8">
				<h3>
					Descarga CAPPSERITO en tu celular
					<br>
					+11 millones de usuarios ya piden comida online
				</h3>
				<img class="store" src="<?php echo e(asset('img/app-store.png')); ?>" alt="App Store">
				<img class="store" src="<?php echo e(asset('img/google-play.png')); ?>" alt="Google Play">
			</div>
		</div>
	</div>
</section>



<!-- chef -->
<section class="chefarea text-center">
	<div class="container">
		<div class="row">
			<div class="col-6">
				<img class="chef" src="<?php echo e(asset('img/chef.png')); ?>" alt="Chef">
			</div>
			<div class="col-6">
				<h2 class="mb-4">
					¿Quieres ofrecer<br>
					tu servicio de cocina<br>
					con CAPPSeritoChef?
					<br><br>
					<a href="registro-chef.html"><button class="btn naranja text-white">¡REGISTRATE AQUÍ!</button></a>
				</h2>

			</div>
		</div>
	</div>
</section>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/SeguridadLogro/AppCore/resources/views/website/index.blade.php ENDPATH**/ ?>