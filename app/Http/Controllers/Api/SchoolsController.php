<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use DB;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $schools = School::all();
            return response()->json($schools, 200);
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
            $school = School::create($request->all());
            return response()->json($school, 201);
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
            $school = School::find($id);
            return response()->json($school, 200);
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
            $school = School::find($id)->update($request->all());
            return response()->json($school,200);
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
            $school = School::find($id)->delete();
            return response()->json([
                'message' => 'El pais ha sido eliminado con exito'
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ],400);
        }
    }


    // Escuelas que pertenecen a un país ejercicio 3

    public function solution3($country_id)

    {

        try {
            $schools = School::select('name')->where('country_id', $country_id)->get();
            return response()->json([
                $schools
            ],200);{}
        } catch (\Throwable $th) {
            return response()->json([
                'errors'=>$th
            ],400);
        }
    }

      // Listado de escuelas con la cantidad de usuarios que tiene como estudiantes ejercicio 8

      public function solution8()

      {

          $schools = DB::table('schools')
          ->join('users', 'schools.id', '=', 'users.school_id')
          ->select('schools.name', DB::raw('count(users.id) as userAmount'))
          ->groupBy('schools.name')
          ->get();

          return response()->json($schools);
      }


}
