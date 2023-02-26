<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function create()
    {
        return view('category.create');
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

        $category = Category::create($data);

        return redirect('/category/list')->with('success', 'Success Create Category');
    }

    public function list(Request $request)
    {
        return datatables()
            ->eloquent(Category::query()->when(!$request->order, function ($query) {
                $query->latest();
            }))

            ->addColumn('action', function ($category) {
                return '
                <div class="d-flex">
                <form onsubmit="destroy(event)" action="' .  route('category.destroy', $category->id) . '" method="POST">
                <input type="hidden" name="_token" value="' . @csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn-danger btn btn-sm  mr-2">
                <i class="fa fa-trash"></i>
                </button>
                </td>
                </form>
                 <a href="' . route('category.edit', $category->id) . '" class="btn btn-sm btn-primary rounded"><i class="fa fa-pen"></i></a>
                 </div>  
            ';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }
    public function index()
    {
        return view('category.list');
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['success' => 'Post has been Deleted!']);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        //Validasi data update category
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        //Menyimpan data update category
        $findcategory = Category::find($category->id);
        $findcategory->update($data);
        //mengembalikan ke halaman ketika user berhasil update
        return redirect('/category/list')->with('success', 'User updated successfully');
    }
}
