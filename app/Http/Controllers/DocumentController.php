<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function qrDownload(Document $document)
    {
        // si se hace la búsqueda por uuid y no se encuentra el resulado usar abort(404);
        return Storage::download("documents/{$document->qr_image}");
    }

    public function pdfDownload($uuid)
    {
        $document = Document::where("uuid", $uuid)->where("status", true)->first();
        if ($document && Storage::exists($document->qr_file)) {
            return Storage::response($document->qr_file);
        }
        abort(404);
    }

    public function vpdfDownload($uuid)
    {
        $document = Document::where("uuid", $uuid)->first();
        if ($document && Storage::exists($document->qr_file)) {
            return Storage::response($document->qr_file);
        }
        abort(404);
    }
}
