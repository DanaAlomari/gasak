<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartSale;
use Illuminate\Routing\Route;

class OrderController extends Controller
{


    function index(Route $route){

            $orders = new CartSale();
            $orders = $orders->select('*');


            $orders = $orders->orderBy('created_at','desc')->paginate(100);

            return view('admin.orders.index',compact('orders'));


    }


    function show(Route $route,$id){

            $cartSale = CartSale::find($id);
            if($cartSale){
                return view('admin.orders.show',compact('cartSale'));
            }
            else{
                return redirect()->back()->with('danger','Order Not Found In Records !!!!!');
            }

    }




}







// public function getStatusAttribute($value)
// {
//     if ($value == 1) {
//         return 'Pending Washer';
//     }
//     if ($value == 2) {
//         return 'Pending Picker Accept';
//     }
//      elseif ($value == 3) {
//         return 'Pending Picker Collect';
//     }
//      elseif ($value == 4) {
//         return 'Picker Collected';
//     }
//      elseif ($value == 5) {
//         return 'Picker Complete';
//     }
//      elseif ($value == 6) {
//         return 'Pending Droper Accept';
//     }
//      elseif ($value == 7) {
//         return 'Pending Droper Collect';
//     }
//      elseif ($value == 8) {
//         return 'Droper Collected';
//     }
//      elseif ($value == 9) {
//         return 'Droper Complete';
//     }
// }
