<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function users()
    {
        $users = User::with(['client'])->get();
        return view('users', ['users' => $users]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("nutzer.index", ["users" => User::orderBy("id", "DESC")->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("nutzer.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->email2 = "";
        if ($request->email2!==null) {
            $user->email2 = $request->email2;
        }
        $user->type = $request->type;
        // user is supposed to fire a password recovery anyway
        $randomPwd = bcrypt(json_encode($request->all())) . time() . md5(time());
        $user->password = $randomPwd;
        $user->client_id = 1;
        wp_create_user( $request->name, $randomPwd, $request->email );
        if ($user->save()) {
            return redirect()->route("nutzer.index", $user->id)->with("success", "User successfully Created!");
        } else {
            return redirect()->route("nutzer.index", $user->id)->withInput()->withErrors(['updateUser' => "Something went wrong Please try again after sometime."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::findOrFail($id);
        // dd($user->name);
        return view("nutzer.nutzer", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // dd($user->name);
        return view("nutzer.edit", ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request,  $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->email2 = $request->email2;
        $user->type = $request->type;


        if ($user->save()) {
            return redirect()->route("nutzer.index", $user->id)->with("success", __("User successfully updated!"));
        } else {
            return redirect()->route("nutzer.index", $user->id)->withInput()->withErrors(['updateUser' => "Something went wrong Please try again after sometime."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);

        if ($user->delete()) {
            return redirect()->route("nutzer.index", $user->id)->with("success", __("User successfully deleted!"));
        } else {
            return redirect()->back()->withInput()->withErrors(['updateUser' => "Something went wrong Please try again after sometime."]);
        }
    }
}
