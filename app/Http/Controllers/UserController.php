<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Retorna la lista de usuarios registrados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

  
    /**
     * Guarda el usuario con sus datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    /**
     * Muestra la información del usuario si existe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Actualiza el usuario especificado si existe en la 
     * base de datos.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //Se actualiza el usuario
        $user->update($request->all());

        return response()->json($user, 200);
    }

    /**
     * Elimina el usuario indicado si existe en la base 
     * de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}

