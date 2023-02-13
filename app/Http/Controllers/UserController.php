<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function list()
    {
        return datatables()
            ->eloquent(User::query()->latest())
            
            ->addColumn('action', function ($user) {
                return '
                <div class="d-flex">
                <form onsubmit="destroy(\'event\')" action=" ' . route('user.destroy', $user->id) . ' " method="POST">
                <input type="hidden" name="_token" value="'. @csrf_token() .'">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn-danger btn btn-sm  mr-2" onclick="return confirm(\'Are you sure you want to delete this user?\')">
                <i class="fa fa-trash"></i>
                </button>
                </td>
                </form>
                 <a href=" ' . route('user.edit', $user->id) . '" class="btn btn-sm btn-primary rounded"><i class="fa fa-pen"></i></a>
                 </div>  
            ';
            })
            ->addColumn('image', function($user) {
                return $user->image
                ? '<img src="/storage/avatars/' . $user->image . '" class="rounded-circle" height="30" width="30">'
                : '<img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1" class="rounded-circle" height="30" width="30">';
            })
            ->addColumn('status', function($user){
                return $user->status == 'Active'
                ? '<p class="text-success fw-bold">'.$user->status.'</p>' : '<p class="text-danger fw-bold">'.$user->status.'</p>';
            })
            ->addIndexColumn()
            ->escapeColumns(['action']) 
            ->toJson();
           
            
    }

    public function index()
    {
        return view('user.index');
    }
    public function destroy(User $user)
    {
    $path = public_path('storage/avatars/' . $user->image);
    if(File::exists($path))
    {
    File::delete($path);
    }
    $user->delete();

    return redirect('/user')->with('success', 'User deleted successfully');
    }

     public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
       //Validasi data update user
        $request->validate(
            [
            'name' => ['required', 'string', 'max:255']
            ]
        );

        $data = [
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ];
        //Menyimpan data update user
        $findUser = User::find($user->id);
        $findUser->update($data);
        //mengembalikan ke halaman ketika user berhasil update
        return redirect('/user')->with('success', 'User updated successfully');
    }
}
