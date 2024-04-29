<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the benefits.
     */
    public function benefits($user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'data' => [],
            ], 404);
        }

        $data = $user->benefits()->withPivot('created_at', 'amount')->get()->map(function ($benefit) {
            return [
                'id' => $benefit->id,
                'monto' => $benefit->pivot->amount,
                'fecha_recepcion' => $benefit->pivot->created_at->format('d/m/Y'),
                'fecha' => $benefit->pivot->created_at->format('Y-m-d'),
            ];
        });

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $data,
        ]);
    }
}
