<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class AssetController extends Controller
{
    public function serveCss($filename)
    {
        $path = public_path("css/{$filename}");

        Log::info("AssetController: Intentando servir CSS", [
            'filename' => $filename,
            'path' => $path,
            'exists' => file_exists($path)
        ]);

        if (!file_exists($path)) {
            Log::error("AssetController: Archivo CSS no encontrado", ['path' => $path]);
            abort(404, "CSS file not found: {$filename}");
        }

        $content = file_get_contents($path);

        Log::info("AssetController: CSS servido exitosamente", [
            'filename' => $filename,
            'size' => strlen($content)
        ]);

        return Response::make($content, 200, [
            'Content-Type' => 'text/css',
            'Cache-Control' => 'public, max-age=31536000',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    public function serveJs($filename)
    {
        $path = public_path("js/{$filename}");

        Log::info("AssetController: Intentando servir JS", [
            'filename' => $filename,
            'path' => $path,
            'exists' => file_exists($path)
        ]);

        if (!file_exists($path)) {
            Log::error("AssetController: Archivo JS no encontrado", ['path' => $path]);
            abort(404, "JS file not found: {$filename}");
        }

        $content = file_get_contents($path);

        Log::info("AssetController: JS servido exitosamente", [
            'filename' => $filename,
            'size' => strlen($content)
        ]);

        return Response::make($content, 200, [
            'Content-Type' => 'application/javascript',
            'Cache-Control' => 'public, max-age=31536000',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }
}
