<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        return response()->json([
            'message' => 'API is working',
            'data' => $request->all()
        ]);
    }
}