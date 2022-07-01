<?php

namespace App\Http\Controllers;

use App\Models\UsePolicies;
use App\Traits\ApiTraits;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class PoliciesController extends Controller
{
    use ApiTraits;

    public function index() {
        $policies = UsePolicies::first(['id' , 'content']);
        return $this->responseJson(200 , 'policies' , $policies);
    }

    public function show() {
        $policy = UsePolicies::first();
        return view('Policy.index' , [
            'policy' => $policy
        ]);
    }

    public function edit($id){
        $policy = UsePolicies::find($id);
        return view('Policy.edit' , [
            'policy' => $policy
        ]);
    }

    public function update(Request $request , FlasherInterface $flasher) {
        $request->validate([
            'content' => 'required'
        ]);
        $policy = UsePolicies::first();
        $policy->content = $request['content'];
        $policy->save();
        $flasher->addSuccess('Policy Updated');
        return redirect()->back();
    }
}
