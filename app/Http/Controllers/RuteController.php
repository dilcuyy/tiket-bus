<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rute;

class RuteController extends Controller
{
    public function index()
    {
        $rute = Rute::all();

        return view('rute.index', compact('rute'));
    }
}
