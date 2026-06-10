<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrixAttachmentController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'attachment' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,gif,pdf,doc,docx,xls,xlsx,ppt,pptx,zip',
                'max:10240',
            ],
        ]);

        $path = $request->file('attachment')->store('trix-attachments', 'public');

        return response()->json([
            'url' => Storage::url($path),
        ]);
    }
}
