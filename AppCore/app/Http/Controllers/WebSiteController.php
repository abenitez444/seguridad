<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Cart;
use App\Services;
use App\Sales;
use App\Orders;

class WebSiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['checking', 'saveOrder']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('website.index');
    }

    public function nosotros()
    {
        return view('website.nosotros');
    }

    public function contacto()
    {
        return view('website.contacto');
    }

    public function registroChef()
    {
        return view('website.registroChef');
    }

    public function establecimientos()
    {
        $cooks = User::where('type', '1')->get();
        return view('website.establecimientos', ['cooks' => $cooks]);
    }

    public function cooksProducts(Request $request, $id_cook)
    {
        $user = User::find($id_cook);
        return view('website.cooksProducts', ['cook' => $user]);
    }

    /**************************************************************************************/
    /********** FUNCIONES PARA EL MANEJO DEL CARRITO DE PEDIDOS **************************/

    public function exists_cart()
    {
        if (session('cart_capserito')) {
            return true;
        }
        return false;

    }

    public function make_cart($id_cart)
    {
        
        $cart = new Cart;
        $cart->id = $id_cart;
        $cart->total = 0;
        $cart->subTotal = 0;
        $cart->save();
        // $session_cart = session('cart_capserito', $id_cart);
        return $cart;
    }

    public function getCart(Request $request)
    {
        if ($request->session()->exists('cart_capserito')) {
            $cart = Cart::find(session('cart_capserito'));
            if (is_null($cart)) {
                $request->session()->forget('cart_capserito');
                $id_cart = rand() . rand(0, 999);
                $request->session()->put('cart_capserito', $id_cart);
                $cart = $this->make_cart($id_cart);
            }
        } else {
            $id_cart = rand() . rand(0, 999);
            $request->session()->put('cart_capserito', $id_cart);
            $cart = $this->make_cart($id_cart);
        }
        $cart->services = $cart->services()->get();
        return $cart;
    }

    public function addCart(Request $request)
    {
        if ($request->session()->exists('cart_capserito')) {
            $cart = Cart::find(session('cart_capserito'));
            if (is_null($cart)) {
                $request->session()->forget('cart_capserito');
                $id_cart = rand() . rand(0, 999);
                $request->session()->put('cart_capserito', $id_cart);
                $cart = $this->make_cart($id_cart);
            }
            // return response()->json(['hola' => session('cart_capserito')]);
        } else {
            $id_cart = rand() . rand(0, 999);
            $request->session()->put('cart_capserito', $id_cart);
            $cart = $this->make_cart($id_cart);
        }
        
        $servicie = Services::find($request->service_id);
        $cook = User::find($servicie->users_id);

        $servicie_in_cart = $cart->services()->get();
        // return response()->json(['serv' => $servicie_in_cart]);
        $exists_serv_cart = false;

        foreach ($servicie_in_cart as $serv) {
            if ($serv->id == $servicie->id) {
                $exists_serv_cart = true;
                $servicie_cart_old = $serv;
                break;        
            }
        }

        $order['count'] = 0;
        $order['aclaraciones'] = '';
        $order['total'] = 0;
        // $order['subTotal'] = 0;

        if ($exists_serv_cart) {
            $order['count'] = $servicie_cart_old->pivot->count + $request->count;
            \DB::table('services_has_cart')
            ->where('cart_id', $cart->id)
            ->where('services_id', $servicie->id)
            ->update([
                'count' => $order['count'],
                'aclaraciones' => $request->aclaraciones,
            ]);
            
        } else {
            $order['count'] = $request->count;
            \DB::table('services_has_cart')->insert([
                'cart_id' => $cart->id,
                'services_id' => $servicie->id,
                'count' => $order['count'],
                'aclaraciones' => $request->aclaraciones,
            ]);
        }

        $total = 0;
        $subTotal = 0;

        foreach ($cart->services()->get() as $serv) {
            $subTotal = $subTotal + ($serv->pivot->count * $serv->price_total);
        }

        $cart->subTotal = $subTotal;
        $cart->shippingCost = $cook->ShippingCost()->first()->cost;
        $cart->total = $subTotal + $cart->shippingCost;
        $cart->update();    
        return $cart;
    }

    public function updateCart(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $service = Services::find($request->service_id);

        $cart_old = \DB::table('services_has_cart')
        ->where('cart_id', $cart->id)
        ->where('services_id', $request->service_id)
        ->get();
        // return $cart_old;

        $discount = $cart_old[0]->count * $service->price_total;

        $cart->subTotal = $cart->subTotal - $discount;
        $cart->total = $cart->subTotal + $cart->shippingCost;
        $cart->update();

        \DB::table('services_has_cart')
        ->where('cart_id', $cart->id)
        ->where('services_id', $request->service_id)
        ->update([
            'count' => $request->count,
            'aclaraciones' => $request->aclaraciones,
        ]);
        $cart->subTotal = $cart->subTotal + ($service->price_total * $request->count);
        $cart->total = $cart->subTotal + $cart->shippingCost;
        $cart->update();

        return $cart_old;
    }

    public function checking()
    {
        return view('website.checking');
    }

    public function saveOrder(Request $request)
    {
        try {
            DB::beginTransaction();
            $sale = new Sales;
            $sale->users_id = $request->cart['services'][0]['users_id'];
            $sale->status = 'Pendiente';
            $sale->pay_status = 'Pendiente';
            $sale->save();

            $order = new Orders;
            $order->users_id = auth()->user()->id;
            $order->paymentGateway_id = $request->sale['pay_id'];
            $order->total = $request->cart['total'];
            $order->subTotal = $request->cart['subTotal'];
            $order->shippingCost = $request->cart['shippingCost'];
            $order->status = 'Solicitado';
            $order->differentAddress = (isset($request->sale['differentAddress']) && ($request->sale['differentAddress'] == true || $request->sale['differentAddress'] == 1)) ? 1 : 0;
            $order->shippingAddress = $request->sale['shippingAddress'];
            $order->city = $request->sale['city'];
            $order->neighborhood = $request->sale['neighborhood'];
            $order->carrera = $request->sale['carrera'];
            $order->street = $request->sale['street'];
            $order->notes = $request->sale['notes'];
            $order->sales_id = $sale->id;
            $order->sales_users_id = $sale->users_id;
            $order->save();

            foreach ($request->cart['services'] as $s) {
                DB::table('services_has_orders')->insert(['services_id' => $s['id'], 'orders_id' => $order->id, 'count' => $s['pivot']['count'], 'aclaraciones' => $s['pivot']['aclaraciones'] ] );
            }

            $cart = Cart::find($request->cart['id']);
            DB::table('services_has_cart')->where('cart_id', $cart->id)->delete();
            $cart->delete();

            $user = User::find(auth()->user()->id);
            $user->address = $request->user['address'];
            $user->city = $request->user['city'];
            $user->phone = $request->user['phone'];
            $user->update();
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            return ['error' => $e->getMessage(), 'linea' => $e->getLine()];
        }
    }
}
