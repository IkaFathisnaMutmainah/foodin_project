<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beli;
use App\Models\Food;

class BeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beli = Beli::all();
        return $beli;
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
        $daftar = Food::find($request->id_makanan);
        if ($daftar){
            if($daftar->stok_makanan == 0){
                return response()->json([
                    'status' => 200,
                    'message' => 'Makanan sudah habis'
                ], 200);
            }
            else if($daftar->stok_makanan < $request->jumlah_pembelian){
                return response()->json([
                    'status' => 200,
                    'message' => 'Pembelian melebihi jumlah stok'
                ], 200);

            }
            else {
                $daftar->stok_makanan -= $request->jumlah_pembelian;
                $daftar -> save();
            }
        }
        $table = Beli::create([
            "nama" => $request->nama,
            "id_makanan" => $request->id_makanan,
            "tanggal_pembelian" => $request->tanggal_pembelian,
            "jumlah_pembelian" => $request->jumlah_pembelian,
            "jenis_pembayaran" => $request->jenis_pembayaran,
            "jml_pembayaran" => $request->jml_pembayaran,
            "alamat" => $request->alamat
            
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'pembelian sedang di proses',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beli = beli::find($id);
        if ($beli) {
            return response()->json([
                'status' => 200,
                'data' => $beli
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
        $beli = beli::find($id);
        if($beli){
            $beli->nama = $request->nama ? $request->nama : $beli->nama;
            $beli->tanggal_pembelian = $request->tanggal_pembelian ? $request->tanggal_pembelian : $beli->tanggal_pembelian;
            $beli->jumlah_pembelian = $request->jumlah_pembelian ? $request->jumlah_pembelian : $beli->jumlah_pembelian;
            $beli->jenis_pembayaran = $request->jenis_pembayaran ? $request->jenis_pembayaran : $beli->jenis_pembayaran;
            $beli->jml_pembayaran = $request->jml_pembayaran ? $request->jml_pembayaran : $beli->jml_pembayaran;
            $beli->alamat = $request->alamat ? $request->alamat : $beli->alamat;
           
        $beli->save();
        return response()->json([
            'status' => 200,
            'data' => $beli
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
        $beli = beli::find($id);
        if ($beli){
            $beli->delete();
            return response()->json([
                'status' => 200,
                'data' => $beli
            ], 200);
        } else{
            return response()->json([
                'status' => 404, 
                'message' => 'id' . $id .'tidak ditemukan'
            ], 404);
        }
    }
}
