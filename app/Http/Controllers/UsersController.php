<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        //return User::all()->select('id','name','lastname','email');
        return response()->json([
            'message' => 'Lista utenti recuperata con successo.',
            'data'    => UserResource::collection(User::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): JsonResponse
    {
        //
        //$data = $request->only(['name', 'lastname', 'email']);
        $data = $request->safe()->only(['name', 'lastname', 'email']);
        //Siccome in questo test non viene usata, la popolo io con un valore fittizio, visto che non può essere null
        $data['password'] = 'test';
        $user = User::create($data);
        return response()->json([
            'message' => 'Utente creato con successo.',
            'data'    => new UserResource($user),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        //
        return response()->json([
            'message' => 'Utente recuperato con successo',
            'data'    => new UserResource($user),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        //
        //$user->update($request->only(['name', 'lastname', 'email']));
        $user->update($request->safe()->only(['name', 'lastname', 'email']));
        return response()->json([
            'message' => 'Utente aggiornato con successo',
            'data'    => new UserResource($user),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        //
        $deletedUser = new UserResource($user); //mando in risposta l'utente che è stato appena cancellato
        $user->delete();

        return response()->json([
            'message' => 'Utente eliminato con successo',
            'data'    => $deletedUser,
        ]);
    }
}
