<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Traits\ApiTraits;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use ApiTraits;
    public function index() {
        $contact = ContactUs::get(['id' , 'link' , 'icon']);
        return $this->responseJson(200 , 'contact us' , $contact);
    }


    public function all() {
        return view('contactus.index' , [
            'contacts' => ContactUs::all()
        ]);
    }

    public function edit($id) {
        return view('contactus.edit' , [
            'contact' => ContactUs::find($id)
        ]);
    }

    public function update(Request $request , $id , FlasherInterface $flasher){
        $request->validate([
            'link' => 'required'
        ]);
        $contact = ContactUs::find($id);
        $contact->link = $request->link;
        $contact->save();

        $flasher->addSuccess('Contact Edited');
        return redirect()->back();

    }

    public function destroy($id , FlasherInterface $flasher) {
        ContactUs::find($id)->delete();
        $flasher->addDeleted('Contact');
        return redirect()->back();

    }
}
