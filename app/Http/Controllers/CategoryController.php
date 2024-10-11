<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::latest('id')->paginate(5);

        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('categories'),
            ]
        ]);

        try {
            Category::query()->create($data);

            return back()->with('success', 'Thao tác thành công');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Thao tác thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return back()->with('success', 'Thao tác thành công');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Thao tác thất bại');
        }
    }
}
