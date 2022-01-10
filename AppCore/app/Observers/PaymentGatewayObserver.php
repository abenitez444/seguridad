<?php 
namespace App\Observers;

class PaymentGatewayObserver {
    /**
     * This observer only gets triggered by Nova
     *
     * @param \App\Pivots\PlayerRole $playerRole
     */
    public function saved(UsersHasPaymentGateway $user_payment)
    {
        $user = App\User::find($user_payment->users_id);
        $payment = App\PaymentGateway::find($user_payment->paymentGateway_id);
    
        // do your magic here when the pivot gets created by Nova
    }

    /**
     * This observer only gets triggered by Nova
     *
     * @param \App\Pivots\PlayerRole $playerRole
     */
    public function deleting(UsersHasPaymentGateway $user_payment)
    {
        $user = App\User::find($user_payment->users_id);
        $payment = App\PaymentGateway::find($user_payment->paymentGateway_id);

        // do your magic here when the pivot gets deleted by Nova
    }
}

?>