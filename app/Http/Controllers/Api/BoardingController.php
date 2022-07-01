<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoardingResource;
use App\Models\Boarding;
use App\Traits\ApiTraits;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class BoardingController extends Controller
{
    use ApiTraits;
    public function index() {
        $boarding = Boarding::all();
        return $this->responseJson(200 , 'On Boarding' , BoardingResource::collection($boarding));
    }

    public function all() {
        $boarding = Boarding::all();
        return view('boarding.index' , ['boards' => $boarding]);
    }

    public function edit($id) {
        $board = Boarding::find($id);
        return view('boarding.edit' , [
            'board' => $board
        ]);
    }

    public function update(Request $request , $id , FlasherInterface $flasher) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $board = Boarding::find($id);
        $board->title = $request->title;
        $board->description = $request->description;
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('/images/boards/'), $new_name);
            $board->image = $new_name;
            $board->save();
        }
        $board->save();
        $flasher->addSuccess('Board Edited');
        return redirect()->back();

    }

    public function destroy($id , FlasherInterface $flasher) {
        Boarding::find($id)->delete();
        $flasher->addDeleted('Board');
        return redirect()->back();
    }

}
