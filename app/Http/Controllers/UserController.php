<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function list()
    {
        return datatables()
            ->eloquent(User::query()->latest())
            ->addColumn('action', function () {
                return '
                <form action="/user/" method="POST">
                <input type="hidden" name="_token" value="'. @csrf_token() .'">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-sm btn-danger mr-2">
                <i class="fa fa-trash"></i>
                </button>
                </td>
            </form>
                ';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    public function index()
    {
        return view('user.index');
    }
    public function destroy($id)
    {
    $item = User::findOrFail($id);
    $path = public_path('storage/avatars/' . $item->image);
    if(File::exists($path))
    {
        File::delete($path);
    }
    $item->delete();

    return redirect('/user')->with('success', 'User deleted successfully');
    }
}
