<?php

namespace Modules\Test\App\Http\Controllers;

use Illuminate\Routing\Controller;

class TestController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Test Module is working successfully!']);
    }
}
