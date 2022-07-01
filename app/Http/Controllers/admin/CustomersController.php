<?php

namespace App\Http\Controllers\admin;

use App\Models\Manager;
use App\Models\Customer;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{

    public function index()
    {
        $customers =  Customer::all();
        return view('customers.index', ['customers' => $customers]);
    }


    public function delete($id,  FlasherInterface $flasher)
    {
        Customer::find($id)->delete();
        $flasher->addDeleted('Customer');
        return redirect()->back();
    }
}
