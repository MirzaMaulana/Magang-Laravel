<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MyProfileController extends Controller
{
    public function index()
    {
        return view('my-profile.index');
    }
    public function update(Request $request, User $name)
    {

        // input data
        $data = [
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ];
        //Mengecek apakah user upload image
        if ($request->hasFile('image')) {
            // Menginput image user
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('avatars', $filename);
            $data = ['image' => $filename];
        }
        //Menyimpan data update user
        $users = Auth::user();
        $findUser = User::find($users->id);
        $findUser->update($data);
        //mengembalikan ke halaman ketika user berhasil update
        return redirect('home')->with('success', 'User updated successfully');
    }
}
