<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Manager;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class CustomersController extends Controller
{

    use ApiTraits;

    public function index() {
        $customers =  Customer::all();
            return view('customers.index' , ['customers' => $customers]);
    }
}
