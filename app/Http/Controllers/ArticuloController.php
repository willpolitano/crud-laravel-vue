<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Articulo $articulo)
    {
        return $articulo;
    }

    public function update(Request $request, Articulo $articulo)
    {
        //
    }

    public function destroy(Articulo $articulo)
    {
        //
    }
}
