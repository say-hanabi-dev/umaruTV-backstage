<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    public function annex(Request $request){
        $path = $request->file('annex')->store('annex/'. date('Y/m'), 'public');
        return [
            'status' => 'success',
            'path' => Storage::url($path)
        ];
    }
}
