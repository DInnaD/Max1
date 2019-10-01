<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Organization;
use App\Vacancy;
use App\Filters\UserFilters;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Validation\Rule;

class UserController extends Controller
{   
    public function index(Request $request)
    {
        //$this->authorize(User::class);
        return new UserCollection(User::getSearchList($request));
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function indexStats(Request $request)
    {
       $this->authorize(User::class);
       $user = User::getRoleList($request);
       
       return response()->json(['success' => true, 'data' => $user], 200);   
    }

    public function show(User $user, Vacancy $vacancy)
    {
       //$this->authorize('show', $user);
        
       return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        //$this->authorize('update', $user);
        //$user->update($request->all());
        $this->validate($request, [
            'password'  =>  'required',
            'email' =>  [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
        ]);

        $user = Auth::user();
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));
        
        return new UserResource($user);

    }

    public function destroy(User $user)
    {
        //$this->authorize('delete', $user);
        $user->delete();

        return response()->json(['success' => true], 200);
    }
}
