<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest('id')->get();
        return  response()->json([
            'seccess'   => true,
            'message'   => 'Seccessfully Data added',
            'data'      => $categories
        ]);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       $data =  Validator::make($request->all(),[
           'category_name'  => 'required|string|unique:categories,category_name' .$category->id
        ]);

       if ($data->fails()) {
           return response()->json([
            'seccess'   => false,
            'message'   => 'Error',
            'errors'    => $data->getMessageBag()
           ], 422);
       }

       $formData = $data->validated();
       $formData['category_slug'] = Str::slug($formData['category_name']);

       Category::create($formData);

        return response()->json([
            'seccess'  => true,
            'message'  => 'Category Seccessfully Created',
            'data'     => [] 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'seccess'  => false,
                'message'  => 'Category Not Found',
                'errors'     => [],
            ], 422);
        }

        return response()->json([
            'seccess'   => true,
            'message'   => 'Seccessful',
            'data'      => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'seccess'   => false,
                'message'   => 'Category Not Found',
                'errors'    => []
            ],422);
        }

        $data = Validator::make($request->all(),[
            'category_name'  => 'required|string|unique:categories'
        ]);

        if ($data->fails()) {
              return response()->json([
                'seccess'   => false,
                'message'   => 'Error',
                'errors'    => $data->getMessageBag()
            ],422);
        }

          $formData = $data->validated();
          $formData['category_slug'] = Str::slug($formData['category_name']);

       $category->update($formData);

        return response()->json([
            'seccess'  => true,
            'message'  => 'Category Seccessfully Updated',
            'data'     => [] 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'seccess'   => false,
                'message'   => 'Category Not Found',
                'errors'    => []
            ],422);
        }

        $category->delete();

         return response()->json([
            'seccess'  => true,
            'message'  => 'Category Seccessfully Deleted',
            'data'     => [] 
        ]);

    }
}
