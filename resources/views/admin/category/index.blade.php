@extends('admin.layout.master')

@section('title')
    Danh sách danh mục
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-4">
            <div class="card shadow ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm mới</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
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
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $category)
                                    <tr class="">
                                        <td scope="row">{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            @if ($category->status == 1)
                                                <span class="badge bg-success">Hoạt động</span>
                                            @else
                                                <span class="badge bg-light">Vô hiệu</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <a href="{{ route('categories.edit', $category) }}"
                                                    class="btn btn-primary btn-sm mr-1">Sửa</a>

                                                <form action="{{ route('categories.destroy', $category) }}" method="post">
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
        </div>

    </div>
@endsection
