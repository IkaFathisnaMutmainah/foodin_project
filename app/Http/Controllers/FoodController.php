<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = Food::all();
        return $food;
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
        $user = auth()->user();
        if ($user->role == 0){
            // $request->validate([
            //     "nama_makanan" => $request->nama_makanan,
            //     "harga" => $request->harga,
            //     "stok_makanan" => $request->stok_makanan,
            //     "gambar" => $request->gambar
            // ]);
        
        $food= Food::create([
            "nama_makanan" => $request->nama_makanan,
            "harga" => $request->harga,
            "stok_makanan" => $request->stok_makanan,
            "gambar" => $request->gambar
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Data Makanan Sudah Ditambahkan',
            'data' => $food
        ], 201);

    }else {

        return response()->json([
            'success' => 'gagal',
            'message' => 'anda tidak memiliki akses',
        ], 401);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = food::find($id);
        if ($food) {
            return response()->json([
                'status' => 200,
                'data' => $food
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id atas' . $id . 'tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $food = food::find($id);
        if($food){
            $food->nama_makanan = $request->nama_makanan ? $request->nama_makanan : $food->nama_makanan;
            $food->harga = $request->harga ? $request->harga : $food->harga;
            //$food->stok_makanan = $request->stok_makanan ? $request->stok_makanan : $food->stok_makanan;
            $food->stok_makanan = $request->stok_makanan ? $request->stok_makanan : $food->stok_makanan;
            $food->gambar = $request->gambar ? $request->gambar : $food->gambar;
        $food->save();
        return response()->json([
            'status' => 200,
            'data' => $food
        ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => $id . 'tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = food::where('id', $id)->first();
        if ($food){
            $food->delete();
            return response()->json([
                'status' => 200,
                'data' => $food
            ], 200);
        } else{
            return response()->json([
                'status' => 404, 
                'message' => 'id' . $id .'tidak ditemukan'
            ], 404);
        }
    }
}
