<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticicationController extends Controller
{
    use ApiTraits;
    public function index()
    {
        $notifications = Notification::where('customer_id', Auth::user()->id)->get();
        return $this->responseJson(200, 'Notifications Returned', $notifications);
    }
}
