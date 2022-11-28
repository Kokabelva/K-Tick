<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index()
    {
        $event = Event::all();

        return response()->json([
            'message' => 'Data berhasil ditampilkan',
            'data' => $event,
        ], 200);
    }


    public function show($id)
    {
        $event = Event::find($id);

        if ($event) {
            return response()->json([
                'message' => 'Data berhasil ditampilkan',
                'data' => $event,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 400);
        }
    }    
}