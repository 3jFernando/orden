<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Exception;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('admin.shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {

        $data = $request->validate([
            'name' => 'string|required|min:3',
            'bio' => 'string|required|min:20|max:255',
        ]);

        try {

            $shop->name = $data['name'];
            $shop->bio = $data['bio'];

            // verificar la imagen          
            $file = $request->file('image');  
            if($file) {
                $nameFile = $file->store('shops', 'public');
                $shop->image = $nameFile;
            }
            
            $shop->save();

            return back()->with('success', 'Los datos de tu Tienda ' . $shop->name . ' se guardaron con exito.');

        } catch(Exception $e) {
            return redirect()->route('shops.edit', ['shop' => $shop->id])->with('success', 'Los datos de tu Tienda ' . $shop->name . ' se guardaron con exito.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
