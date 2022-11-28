<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Event;


class OrderTiket extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $event = Event::find($request->events_id);

        if ($user->role == 'user') {
          
            $order = Transaksi::create([
                'event_id' => $request->events_id,
                'user_id' => $user->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'jumlah_tiket' => $request->jumlah_tiket,
                'total_harga' => $request->jumlah_tiket * $event->harga,
                'status' => 'pending',
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Order berhasil ditambahkan',
                'data' => $order
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
            $order = Transaksi::all();

            return $order;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda perlu akses untuk melihat data',
            ], 401);
        }
    }


    public function show($id)
    {

        $order = Transaksi::find($id);

        if ($order) {

            return response()->json([
                'message' => 'Data berhasil ditampilkan',
                'data' => $order,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 400);
        }
    }  
     
}