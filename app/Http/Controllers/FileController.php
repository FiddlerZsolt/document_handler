<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:file-list|file-create|file-delete',
            [
                'only' => ['index', 'store']
            ]
        );
        $this->middleware(
            'permission:file-create',
            [
                'only' => ['store']
            ]
        );
        $this->middleware(
            'permission:file-delete',
            [
                'only' => ['destroy']
            ]
        );
    }

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

        if (!CategoryController::hasPermission($validated['category_id'])->upload)
            return redirect()
                ->action([CategoryController::class, 'show'], ['category' => $validated['category_id']])
                ->withErrors('Fájl feltöltés nem megengedett!');

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

        $path = $file->storeAs('public/files/' . $validated['category_id'], $storedName);

        File::create([
            'name' => $name,
            'path' => $path,
            'version' => $version,
            'category_id' => $validated['category_id'],
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->action(
            [CategoryController::class, 'show'], ['category' => $validated['category_id']]
        );
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroy(File $file)
    {
        $category = $file->category_id;
        Storage::delete($file->path);
        $file->delete();

        return redirect()
            ->action([CategoryController::class, 'show'], ['category' => $category])
            ->with('success', 'File deleted successfully');
    }
}
