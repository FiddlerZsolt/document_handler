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
        $validated = $request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required',
        ], [
            'file.required' => 'Fájl nem található',
            'file.image' => 'Fájl csak kép lehet',
            'file.mimes' => 'Nem megfelelō fájl formátum.',
            'category_id.required' => 'Kategória azonosító megadása kötelezō',
        ]);

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $extension = $file->extension();

        $lastVersion = File::orderBy('version', 'DESC')
            ->where('name', $name)
            ->where('category_id', $validated['category_id'])
            ->first();

        $version = is_null($lastVersion)
            ? 1
            : ($lastVersion->version + 1);

        $fileName = explode('.', $name);
        $storedName = $fileName[0] . "_v" . $version . "." . $extension;

        // dd([
        //     'storedName' => $storedName,
        //     'name' => $fileName[0],
        //     'extension' => $file->extension(),
        //     'version' => $version,
        //     'lastVersion' => $lastVersion->version,
        // ]);

        $path = $file->storeAs('public/files/' . $validated['category_id'], $storedName);

        File::create([
            'name' => $name,
            'path' => $path,
            'category_id' => $validated['category_id'],
            'version' => $version,
        ]);

        return redirect()->action(
            [CategoryController::class, 'show'], ['category' => $validated['category_id']]
        );
            // ->route('categories.show', ['id' => $validated['category_id']])
            // ->with('status', 'File Has been uploaded successfully in laravel');
    }
}
