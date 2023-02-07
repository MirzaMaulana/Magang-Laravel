<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function edit(Request $request)
    {
        $users = Auth::user();
        return view('update.edit');
    }

    public function update(Request $request, User $name)
    {
        $request->validate(
            [
            'name' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required'],
            'alamat' => ['required', 'string', 'max:255'],
            ]
        );
      
        $request->file('image')->storeAs('image', $request->image);  
   

        $data = [
            'image' =>  $request->image,
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ];

        dd($data);
        $users = Auth::user();
       $findUser = User::find($users->id);
       $findUser->update($data);

       return redirect('home')->with('success', 'User updated successfully');
    }
}
