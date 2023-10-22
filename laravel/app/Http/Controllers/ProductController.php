<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Illuminate\Support\Str;
use DateTime;


class ProductController
{
    public function index()
    {
        return Product::select('id', 'title', 'description','created_at')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Product::create(request()->all());
        return response()->json(['message' => 'Prodotto creato']);


    }

    /**
     * Mostra a schermo un prodotto specifico
     */
    public function show(Product $product)
    {
        return response()->json(['product' => $product]);
    }

    /**
     * Aggiorna uno specifico prodotto
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable'
        ]);


        $product->fill($request->post())->update();

        $product->save();

        return response()->json(['message' => 'Prodotto aggiornato con successo']);


    }

    public function destroy(Product $product)
    {

        $product->delete();
        return response()->json([
            'message' => 'Prodotto eliminato con successo'
        ]);


    }
}
