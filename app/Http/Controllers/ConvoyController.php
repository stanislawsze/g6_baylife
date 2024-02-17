<?php

namespace App\Http\Controllers;

use App\Models\Convoy;
use Illuminate\Http\Request;

class ConvoyController extends Controller
{
    public function index()
    {
        return view('convoy.index');
    }

    public function show(Convoy $convoy)
    {
        return view('convoy.show', ['convoy' => $convoy]);
    }

    public function edit(Convoy $convoy)
    {
        return view('convoy.edit', ['convoy' => $convoy]);
    }
}
