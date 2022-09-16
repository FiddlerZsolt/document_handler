<?php

namespace App\Http\Controllers;

use App\Models\CategoryPermission;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:file-download',
            [
                'only' => ['index']
            ]
        );
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index($id)
    {
        $file = File::find($id);

        if (!CategoryController::hasPermission($file->category_id)->download)
            return redirect()
                ->action([CategoryController::class, 'show'], ['category' => $file->category_id])
                ->withErrors('A fájl letöltése nem megengedett!');

        return Storage::download($file->path);
    }
}
