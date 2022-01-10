<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="container site-section" id="invoice">
    <form id="formpayu" method="post" action="<?php echo e($payu->urlAction); ?>">
        <input name="merchantId"    type="hidden"  value="<?php echo e($payu->merchantId); ?>"   >
        <input name="accountId"     type="hidden"  value="<?php echo e($payu->accountId); ?>" >
        <input name="description"   type="hidden"  value="Compra desde la tienda"  >
        <input name="referenceCode" type="hidden"  value="<?php echo e(str_replace('-', '', $invoice->code)); ?>" >
        <input name="amount"        type="hidden"  value="<?php echo e(number_format($invoice->total, 2, '.', '')); ?>"   >
        <input name="tax"           type="hidden"  value="<?php echo e(number_format($invoice->tax, 2, '.', '')); ?>"  >
        <input name="taxReturnBase" type="hidden"  value="<?php echo e(number_format($invoice->total - $invoice->tax, 2, '.', '')); ?>" >
        <input name="currency"      type="hidden"  value="<?php echo e($currency->abbreviation); ?>" >
        <input name="signature"     type="hidden"  value="<?php echo e(md5($payu->apiKey.'~'.$payu->merchantId.'~'.str_replace('-', '', $invoice->code).'~'.number_format($invoice->total, 2, '.', '').'~'.$currency->abbreviation)); ?>"  >
        <input name="buyerFullName" type="hidden"  value="<?php echo e($invoice->user->name); ?>" >
        <input name="buyerEmail"    type="hidden"  value="<?php echo e($invoice->user->email); ?>" >
        <input name="telephone"     type="hidden"  value="<?php echo e($invoice->user->phone); ?>">
    </form> 
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
   $("#formpayu").submit();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/website/shop/pay/payu.blade.php ENDPATH**/ ?>