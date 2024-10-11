<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::with('category')->latest('id')->paginate(5);

        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::pluck('name', 'id')->all();

        return view('admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'name'        => 'required',
            'image'       => 'nullable|image',
            'price'       => 'required',
            'sale_price'  => 'required',
            'description' => 'required',
            'status'      =>  ['nullable', Rule::in(0, 1)],
        ]);

        try {
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('products/image_avatar', $request->file('image'));
            }

            Product::query()->create($data);

            return redirect()->route('products.index')
                ->with('success', 'Thao tác thành công');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Thao tác thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $category = Category::pluck('name', 'id')->all();

        return view('admin.product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'name'        => 'required',
            'image'       => 'nullable|image',
            'price'       => 'required',
            'sale_price'  => 'required',
            'description' => 'required',
            'status'      =>  ['nullable', Rule::in(0, 1)],
        ]);

        try {
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('products/image_avatar', $request->file('image'));
            }

            $currentImage = $product->image;

            $product->update($data);

            if (
                $request->hasFile('image')
                && !empty($currentImage)
                && Storage::exists($currentImage)
            ) {
                Storage::delete($currentImage);
            }

            return redirect()->route('products.index')
                ->with('success', 'Thao tác thành công');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Thao tác thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            if (!empty($currentImage) && Storage::exists($currentImage)) {
                Storage::delete($currentImage);
            }

            return redirect()->route('products.index')
                ->with('success', 'Thao tác thành công');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Thao tác thất bại');
        }
        //
    }
}
