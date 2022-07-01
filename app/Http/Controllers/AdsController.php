<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index() {
        $ads = Ads::all();
        return view('ads.index' ,
            [
                'ads' => $ads
            ]);
    }

    public function create() {
        return view('ads.create');
    }

    public function store(Request $request , FlasherInterface $flasher){
        $request->validate([
            'text' => 'required',
            'image' => 'required'
        ]);
        $ads = new Ads;
        $ads->text = $request->text;
        $image = $request->file('image');
        $new_name = time() . $image->getClientOriginalName();
        $image->move(public_path('/images/ads'), $new_name);
        $ads->image = $new_name;
        $ads->save();
        $flasher->addSuccess('Ads Created');
        return redirect()->route('ads.index');

    }

    public function destroy($id , FlasherInterface $flasher) {
        Ads::find($id)->delete();
        $flasher->addDeleted('Ads');
        return redirect()->route('ads.index');

    }

    public function edit($id) {
        $ad = Ads::find($id);
        return view('ads.edit' ,[
            'ad' => $ad
        ]);
    }

    public function update($id , Request $request , FlasherInterface $flasher){
        $request->validate([
            'text' => 'required',
        ]);
        $ads = Ads::find($id);
        $ads->text = $request->text;
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('/images/categories/profile'), $new_name);
            $ads->image = $new_name;
        }
        $ads->save();
        $flasher->addSuccess('Ads Updated');
        return redirect()->route('ads.index');
    }
}
