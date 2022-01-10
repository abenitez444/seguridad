<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item" v-bind:class="slide.first == true ? 'active' : ''" v-for="slide in sliders">
            <img class="d-block w-100 alto-50-mobile" :src="'<?php echo e(asset('storage')); ?>/' + slide.image" alt="slide.title">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="circulo">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only ">Previous</span>
        </span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only ">Next</span>
    </a>
</div>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/header.js')); ?>"></script>
<?php $__env->stopPush(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/layouts/website/header.blade.php ENDPATH**/ ?>