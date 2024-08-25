<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //read
    public function index(Request $request)
    {
        $categorias = Category::query();
        $categorias = $categorias->get();

        return response()->json([
            'categorias' => $categorias
        ],200);
    }

    //create
    public function store(Request $request)
    {
        $category = new Category();

        $category->nombre = $request->nombre;

        $category->save();
    }

    //update
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json([
            'category' => $category
        ],200);
    }

    public function update(Request $request, $id){

        $category = Category::find($id);

        $category->nombre = $request->nombre;

        $category->save();
    }

    //delete
    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
    }
}
