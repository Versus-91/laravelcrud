<?php

namespace App\Http\Controllers;
use App\Http\Requests\AppUserRequest;
use Illuminate\Http\Request;
use App\AppUser;
use Illuminate\Database\QueryException;

class AppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $users;
    public function __construct(AppUser $user){
       $this->users = $user;
    }
    public function index()
    {
        //
        $users = $this->users->all();
        if($users->isEmpty()){
            return response()->json(['message'=>'nothing to show '],404);
        }
        return response()->json($users);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppUserRequest $request)
    {
        try {
            $user = $this->users->create($request->only('firstname','lastname','email'));
            return response()->json($user);
        } catch (QueryException $e) {
            return response()->json('request failed.',500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->users->find($id);
        if(!$user){
            return response()->json(['message'=>'record not found.'],404);
        }
        return response()->json($user,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppUserRequest $request, $id)
    {
        $user =$this->users->find($id);
        if($user){
            $user->update($request->only('firstname','lastname','email'));
            return response()->json(['message' => 'user successfully updated.','data'=>$user],200);  
        }else {
            # code...
            return response()->json(['message' => 'user not found'],404);  
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->users->find($id);
        if($user){
            $user->destroy();
            return response()->json($user,200);  
        }else {
            return response()->json(['message'=>'user not found.'],400);  
        }
    }
}
