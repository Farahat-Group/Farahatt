<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Notification;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index() {
        $notifications = Notification::all();
        return view('notifications.index' , [
            'notifications' => $notifications
        ]);
    }

    public function create() {
        return view('notifications.create' ,
        [
            'customers' => Customer::all()
        ]);
    }

    public function store(FlasherInterface $flasher , Request $request){
        $request->validate([
            'customer_id' => 'required',
            'message' => 'required',
            'title' => 'required'
        ]);

        Notification::create([
            'customer_id' => $request->customer_id,
            'message' => $request->message,
            'price' => $request->price ?? 0,
            'title' => $request->title
        ]);

        $flasher->addSuccess('Notification Sent');
        return redirect()->back();
    }


    public function destroy($id , FlasherInterface $flasher) {
        Notification::find($id)->delete();
        $flasher->addDeleted('Notification');
        return redirect()->back();

    }
}
