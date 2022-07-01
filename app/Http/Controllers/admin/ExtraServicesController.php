<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ExtraService;
use App\Models\Service;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class ExtraServicesController extends Controller
{
    public function index() {
        $extras =  ExtraService::all();
        return view('extraServices.index' , ['extras' => $extras]);
    }

    public function create(){
        return view('extraServices.create' ,
        [
            'services' => Service::all()
        ]);
    }

    public function store(Request $request , FlasherInterface $flasher) {
        $request->validate([
            'title' => 'required' ,
            'price' => 'required',
            'service_id' => 'required',
        ]);

        ExtraService::create($request->only(['title' , 'price' , 'service_id']));
        $flasher->addSuccess('Added');
        return redirect()->back();
    }

    public function edit($id){
        return view('extraServices.edit' ,
            [
                'service' => ExtraService::find($id),
                'services' => Service::all()
            ]);
    }

    public function update(Request $request , FlasherInterface $flasher , $id) {
        $request->validate([
            'title' => 'required' ,
            'price' => 'required',
            'service_id' => 'required',
        ]);

        ExtraService::find($id)->update($request->only(['title' , 'price' , 'service_id']));
        $flasher->addSuccess('Updated');
        return redirect()->back();
    }

    public function destroy($id , FlasherInterface $flasher) {
        ExtraService::find($id)->delete();
        $flasher->addDeleted('Extra Service');
        return redirect()->back();
    }
}
