<?php

namespace App\Http\Controllers;

use App\Models\Notice;

use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function show($id)
    {
        $notice = Notice::find($id);

        if (!$notice) {
            return response()->json(['error' => 'Notice not found'], 404);
        }

        return response()->json($notice);
    }
}
