<?php

namespace App\Http\Controllers;
use App\Http\Requests\AppUserRequest;
use Illuminate\Http\Request;
use App\AppUser;
use Illuminate\Database\QueryException;

class AppUserController extends Controller
{

    protected $users;
    public function __construct(AppUser $user){
       $this->users = $user;
    }
     /**
     * Display a listing of the resource.
     *
     * @return json
     */
    public function index()
    {
        $users = $this->users->all();
        return response()->json($users,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Http\Requests\AppUsrRequest  $request
     * @return json
     */
    public function store(AppUserRequest $request)
    {
        $user = $this->users->create($request->all());
        return response()->json($user,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return json
     */
    public function show($id)
    {
        $user = $this->users->findOrFail($id);
        return response()->json($user,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Http\Requests\AppUsrRequest  $request
     * @param  int  $id
     * @return json
     */
    public function update(AppUserRequest $request, $id)
    {
        $user =$this->users->findOrFail($id);
        $user->update($request->all());
        return response()->json($user,200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return json
     */
    public function destroy($id)
    {
        $user = $this->users->findOrFail($id)->delete();
        return response()->json(null,204);  
    }
}
