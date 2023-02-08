<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function index()
    {
        return view('my-profile.index');
    }
     public function update(Request $request, User $name)
    {
       
        $request->validate(
            [
            'image' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required'],
            'alamat' => ['required', 'string', 'max:255'],
            ]
        );
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('avatars', $filename);
   

        $data = [
            'image' =>  $filename,
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ];

        $users = Auth::user();
       $findUser = User::find($users->id);
       $findUser->update($data);

       return redirect('home')->with('success', 'User updated successfully');
    }
}
