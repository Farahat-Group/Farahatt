<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('orders.index' , [
            'orders' => $orders
        ]);
    }

    public function show($id) {
        return view('orders.show' , ['order' => Order::find($id)]);
    }

    public function active($id , FlasherInterface $flasher){
        Order::find($id)->update([
            'status' => '1'
        ]);

        $flasher->addSuccess('Order Accepted');
        return redirect()->back();
    }

    public function destroy($id , FlasherInterface $flasher) {
        Order::find($id)->delete();
        $flasher->addDeleted('Order');
        return redirect()->route('orders.index');

    }
}
