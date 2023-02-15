<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $extension = '.'.$request->file->getClientOriginalExtension();
        
        $file = $request->file . $extension;

        $path = $request->file->storeAs('imports', $file);
        
        dd($path);

        return Inertia::render('ImportFile');
    }
}
