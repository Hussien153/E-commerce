<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CategoriesController extends Controller
{
    public function index() {
        $categories = Categories::all();
        return response()->json($categories,200);
    }

    public function show($id) {
        $categories = Categories::find($id);
        if($categories) {
            return response()->json($categories,200);
        }else return response()->json('Category not found');
    }

    public function store(Request $request)
    {
        try{
            $validate = Validator::make(
                $request->all(),
            [
                'name' => 'required|string',
                'image' => 'required'
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validate->errors(),
                ]);
            }
            $categories = new Categories();
            $categories->name=$request->name;
            $categories->save();
            return response()->json('Category was added',201);
        }catch (Exception $e)
        {
            return response()->json($e, 500);
        }
    }
    public function update_category($id, Request $request)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|unique:Brands,name',
                'image' => 'required'
            ]);
            $category=Categories::find($id);
            if($request->hasFile('image')){
                $path= 'assets/uploads/category/' . $category->image;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                try{
                    $file->move('assets/uploads/category/' . $filename);
                }catch(FileException $e) {
                    dd($e);
                }
                $category->image=$filename;
                }
            $category->name=$request->name;
            $category->update();
            return response()->json('Category updated',200);
        }catch (Exception $e)
        {
            return response()->json($e, 500);
        }
    }

    public function delete_category($id)
    {
        $categories=Categories::find($id);
        if($categories){
            $categories->delete();
            response()->json('Category deleted');
        }else
        return response()->json('Category not found');
    }
}
