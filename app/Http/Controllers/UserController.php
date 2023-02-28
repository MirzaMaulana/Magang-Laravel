<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'Admin'
        ];

        $user = User::create($data);
        return redirect('/user/list')->with('success', 'Success Create Admin');
    }

    public function list()
    {
        return datatables()
            ->eloquent(User::query()->where('role', '!=', 'SuperAdmin')->latest())

            ->addColumn('action', function ($user) {
                return '
                <div class="d-flex">
                <form onsubmit="destroy(event)" action=" ' . route('user.destroy', $user->id) . ' " method="POST">
                <input type="hidden" name="_token" value="' . @csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn-danger btn btn-sm  mr-2">
                <i class="fa fa-trash"></i>
                </button>
                </td>
                </form>
                 <a href=" ' . route('user.edit', $user->id) . '" class="btn btn-sm btn-primary rounded"><i class="fa fa-pen"></i></a>
                 </div>  
            ';
            })
            ->addColumn('image', function ($user) {
                return $user->image
                    ? '<img src="/storage/avatars/' . $user->image . '" class="rounded-circle shadow-sm" height="30" width="30">'
                    : '<img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1" class="shadow-sm rounded-circle" height="30" width="30">';
            })
            ->editColumn('status', function ($user) {
                return $user->status == 'Active'
                    ? '<p class="badge badge-success">' . $user->status . '</p>' : '<p class="badge badge-danger">' . $user->status . '</p>';
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
        if (File::exists($path)) {
            File::delete($path);
        }

        $user->delete();
        return response()->json(['success' => 'User has been deleted.']);
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
                'name' => ['required', 'string', 'max:255'],
                'image' => ['image', 'max:2048']
            ]
        );
        // input data
        $data = [
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ];
        //Mengecek apakah user upload image
        if ($request->hasFile('image')) {
            // Menginput image user
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('avatars', $filename);
            $data = ['image' => $filename];
        }

        //Menyimpan data update user
        $findUser = User::find($user->id);
        $findUser->update($data);
        //mengembalikan ke halaman ketika user berhasil update
        return redirect('/user')->with('success', 'User updated successfully');
    }
}
