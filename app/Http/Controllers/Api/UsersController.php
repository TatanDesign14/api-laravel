<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ],403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            return response()->json($user, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ],400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::find($id);
            return response()->json($user, 200);
        } catch (\Throwable $th) {
            return responde()->json([
                'errors' => $th
            ],400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::find($id)->update($request->all());
            return response()->json($user,200);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id)->delete();
            return response()->json([
                'message' => 'El usuario ha sido eliminado con exito'
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ],400);
        }
    }
}
