<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index($id)
    {
        $file = File::find($id);

        $mimeTypes = [
            'pdf' => 'application/pdf',
            'txt' => 'text/plain',
            'html' => 'text/html',
            'exe' => 'application/octet-stream',
            'zip' => 'application/zip',
            'doc' => 'application/msword',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'gif' => 'image/gif',
            'png' => 'image/png',
            'jpeg' => 'image/jpg',
            'jpg' => 'image/jpg',
            'php' => 'text/plain'
        ];

        $fileName = $file->name;
        $extension = explode(".", $file->path)[1];
        $filePath = public_path($file->path);
        $headers = ["Content-Type: {$mimeTypes[$extension]}"];

        return Storage::download($file->path);
    }
}
