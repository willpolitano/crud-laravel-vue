<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        return Articulo::get();
    }

    public function store(Request $request)
    {
        $articulo = new Articulo;
        $articulo->created($request->all());
    }

    public function show(Articulo $articulo)
    {
        return $articulo;
    }

    public function update(Request $request, Articulo $articulo)
    {
        $articulo->update($request->all());
    }

    public function destroy(Articulo $articulo)
    {
        $articulo->delete();
    }
}
