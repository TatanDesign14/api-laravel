<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Carbon\Carbon;

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

    //Listado de usuarios que pertenecen a una escuela Ejercicio 4

    public function solution4($school_id)

    {
        $users = DB::table('users')
        ->join('schools', 'users.school_id', '=', 'schools.id')
        ->select( 'schools.name as school_name','users.name as user_name', 'users.last_name')
        ->where('schools.id', '=', $school_id)
        ->get();

        return response()->json(['users' => $users]);

    }

    // Listado de usuarios que pertenecen a determinado país ejercicio 5

    public function solution5($country_id)

    {

        $users = DB::table('users')
        ->join('countries', 'users.country_id', '=', 'countries.id')
        ->select( 'countries.name as country_name','users.name as user_name', 'users.last_name')
        ->where('countries.id', '=', $country_id)
        ->get();

        return response()->json(['users' => $users]);
    }

    // Listado de usuarios que tienen correo @gmail.com ejercicio 6

    public function solution6()

    {

        $users = DB::table('users')
                ->select('users.name', 'users.last_name', 'users.email')
                ->where('users.email', 'LIKE', '%@gmail.com')
                ->get();

        return response()->json(['users' => $users]);
    }

    // Listado de usuarios con los días faltantes para cumplir años ejercicio 7

    public function solution7()

    {
        $users = DB::table('users')->select('*')->get();

        foreach ($users as $user) {
        $birthday = Carbon::parse($user->date_birth);
        $birthday->year(Carbon::now()->year);
        $today = Carbon::now();
        $missing = $today->diffInDays($birthday, false);

        if ($missing < 0) {
            $today->year(Carbon::now()->year + 1);
            $missing = $today->diffInDays($birthday, false);
        }

        $user->days_missing = $missing;
    }

        return response()->json($users);
    }
}
