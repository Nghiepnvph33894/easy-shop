@extends('admin.layout.master')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    <div class="card shadow ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Danh sách</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Ảnh đại diện</th>
                            <th scope="col">Giá gốc</th>
                            <th scope="col">Giá sale</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $product)
                            <tr class="">
                                <td scope="row">{{ $product->id }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <img src="{{ Storage::url($product->image) }}" alt="image" style="max-width:70px">
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->sale_price }}</td>
                                <td>
                                    <div class="d-flex ">
                                        <a href="{{ route('products.edit', $product) }}"
                                            class="btn btn-primary btn-sm mr-1">Sửa</a>

                                        <form action="{{ route('products.destroy', $product) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Có chắc chắn muốn xoá không?')">Xoá</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

                {{ $data->links() }}
            </div>

        </div>
    </div>
@endsection
