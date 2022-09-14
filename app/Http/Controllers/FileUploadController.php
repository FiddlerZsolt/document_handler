<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
     public function index()
    {
        return view('file-upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ], [
            'file.required' => 'Fájl nem található',
            'file.image' => 'Fájl csak kép lehet',
            'file.mimes' => 'Nem megfelelō fájl formátum.'
        ]);

        $name = $request->file('file')->getClientOriginalName();

        $lastVersion = File::orderBy('version', 'DESC')
            ->where('name', $name)
            ->first();

        $version = is_null($lastVersion)
            ? 1
            : ($lastVersion->version + 1);

        dd($version);

        $path = $request->file('file')->storeAs('public/files', $name);

        File::create([
            'name' => $name,
            'path' => $path,
            'version' => 1,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('status', 'File Has been uploaded successfully in laravel');

    }
}
