<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AssetController extends Controller
{
    public function serveCss($filename)
    {
        $path = public_path("css/{$filename}");

        if (!file_exists($path)) {
            abort(404);
        }

        $content = file_get_contents($path);

        return Response::make($content, 200, [
            'Content-Type' => 'text/css',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }

    public function serveJs($filename)
    {
        $path = public_path("js/{$filename}");

        if (!file_exists($path)) {
            abort(404);
        }

        $content = file_get_contents($path);

        return Response::make($content, 200, [
            'Content-Type' => 'application/javascript',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}
