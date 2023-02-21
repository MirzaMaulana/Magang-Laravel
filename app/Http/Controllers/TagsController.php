<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class TagsController extends Controller
{
    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->user()->name
        ];

        $tag = Tags::create($data);

        return redirect('/tag/list')->with('success', 'Success Create Tags');
    }

    public function list(Request $request)
    {
        return datatables()
            ->eloquent(Tags::query()->when(!$request->order, function ($query) {
                $query->latest();
            }))

            ->addColumn('action', function ($tag) {
                return '
                <div class="d-flex">
                <form onsubmit="destroy(event)" action="' .  route('tag.destroy', $tag->id) . '" method="POST">
                <input type="hidden" name="_token" value="' . @csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn-danger btn btn-sm  mr-2">
                <i class="fa fa-trash"></i>
                </button>
                </td>
                </form>
                 <a href="' . route('tag.edit', $tag->id) . '" class="btn btn-sm btn-primary rounded"><i class="fa fa-pen"></i></a>
                 </div>  
            ';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }
    public function index()
    {
        return view('tag.list');
    }


    public function destroy(Tags $tag)
    {
        $tag->delete();

        return redirect('/tag/list')->with('success', 'Tags deleted successfully');
    }

    public function edit($id)
    {
        $tag = Tags::find($id);
        return view('tag.edit', compact('tag'));
    }

    public function update(Request $request, Tags $tag)
    {
        //Validasi data update tag
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        //Menyimpan data update tag
        $findtag = Tags::find($tag->id);
        $findtag->update($data);
        //mengembalikan ke halaman ketika user berhasil update
        return redirect('/tag/list')->with('success', 'User updated successfully');
    }
}
