<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadImage(Request $request){
        $funcNum = $request->input('upload');

        $this->validate($request,[
            'upload' => 'required|image'
        ]);

        $image = $request->file('upload');
        $image->store('public/uploads');
        $url = asset('storage/uploads/'.$image->hashName());

        return $url;
    }
}
