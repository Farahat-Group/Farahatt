<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceImages;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServicesController extends Controller
{
    public function index(){
        return view('services.index' , [
            'services' => Service::get()
        ]);

    }
    public function create(){
        return view('services.create' , [
            'categories' => Category::all()
        ]);
    }
    public function store(Request $request , FlasherInterface $flasher){



        $request->validate([
            'title' => 'required',
            'description' => 'required' ,
            'price' => 'required',
            'service_code' => ['required' , Rule::unique('services' , 'service_code')] ,
            'category_id' => ['required' , Rule::exists('categories' , 'id')],
        ]);



        $service = Service::create($request->except(['image' , 'extras']));
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('/images/services/'), $new_name);
            $service->images = $new_name;
            $service->save();
        }

        if($files=$request->file('extras')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move(public_path('/images/services/'), $name);
                ServiceImages::create([
                    'image' => $name ,
                    'service_id' => $service->id
                ]);
            }
        }


        $flasher->addSuccess('Service Created');
        return redirect()->back();








    }

    public function edit($id) {
        $service = Service::find($id);
        return view('services.edit' , ['
        $service' => $service
        ]);
    }


    public function update(Request $request , $id){
        $service = Service::find($id);

    }

    public function destroy($id , FlasherInterface $flasher){
        Service::find($id)->delete();
        $flasher->addDeleted('Service');
        return redirect()->back();
    }
}
