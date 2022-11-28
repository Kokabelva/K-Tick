<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Transaksi;

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $order = Transaksi ::find($request->transaksis_id);

        if ($user->role == 'user') {
          
            $pembayaran = Pembayaran::create([
                'transaksis_id' => $request->transaksis_id,
                'users_id' => $user->id,
                'nama' => $request->nama,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'bukti_pembayaran' => $request->bukti_pembayaran,
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil melakukan pembayaran',
                'data' => $pembayaran
            ], 200);
        } else  {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda bukan user',
            ], 401);
            
        }
    } 

    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'admin'){
            $pembayaran = Pembayaran::all();
            return $pembayaran;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda perlu akses untuk melihat data',
            ], 401);
        }
    }

    public function show($id)
    {
        $user = auth()->user();

        if ($user->role == 'user'){
            $pembayaran = Pembayaran::find($id);

            return response()->json([
                'message' => 'Data berhasil ditampilkan',
                'data' => $pembayaran,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 400);
        }
    }  
}
