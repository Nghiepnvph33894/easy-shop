@extends('admin.layout.master')

@section('title')
    Cập nhật sản phẩm: {{ $product->name }}
@endsection

@section('content')
    <div class="card shadow ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark"> Cập nhật sản phẩm: {{ $product->name }} </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-9">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{$product->name }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$product->description }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach ($category as $id => $name)
                                    <option @if ($product->category_id == $id)
                                        selected
                                    @endif value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Giá gốc</label>
                            <input type="number" name="price" id="price" class="form-control"
                                value="{{$product->price }}">
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sale_price" class="form-label">Giá sale</label>
                            <input type="number" name="sale_price" id="sale_price" class="form-control"
                                value="{{$product->sale_price }}">
                            @error('sale_price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh đại diện</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <img src="{{ Storage::url($product->image) }}" alt="image" style="max-width:100%">

                        </div>

                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>

            </form>

        </div>
    </div>
@endsection
