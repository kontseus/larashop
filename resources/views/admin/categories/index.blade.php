@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Categories') }}</h3>
            </div>
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <table class="table align-self-center">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">Description</th>
                        <th class="text-center" scope="col">Quantity of products</th>
                        <th class="text-center" scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-center" scope="col">{{ $category->id }}</td>
                            <td class="text-center" scope="col">{{ $category->name }}</td>
                            <td class="text-center" scope="col">{{ $category->description }}</td>
                            <td class="text-center" scope="col"><a href="{{ route('admin.category.products', $category) }}"> {{ $category->products_count }}</a></td>
                            <td class="text-center" scope="col">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-info form-control">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger form-control" value="Remove">
                                </form>
                                {{--                                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-success form-control">View</a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
