<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Validator;
use  Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\Hash;

class ManageUsersController extends Controller
{
  

    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, \App\Models\User $user)
    {
        $user = Auth::user();
        return view('users.edit')->with(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required',
            'new_password' => 'nullable|confirmed',
            'new_password_confirmation' => 'required_with:new_password',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            return view('users.edit')->withErrors($validator)->with(['user' => Auth::user()]);
        }

        $user = $this->userRepository->get($request['id']);
        if(is_null($user))
            return redirect()->route('home');
    

        if(!Hash::check($request['password'], $user->password))
        {
            return view('users.edit')->with(['user' => Auth::user(), 'customErrors' => ['password' => 'Wrong password.']]);
        }

        $data = [
            'name' => $request['name'],
            'email' => $request['email']
        ];

        if(!is_null($request['new_password']))
        {
            $data['password'] = Hash::make($request['new_password']);
        }

        $user = $this->userRepository->edit($request['id'], $data);

        return view('users.edit')->with(['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
