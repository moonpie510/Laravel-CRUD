@extends('product.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-6">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Артикул</th>
                        <th scope="col">Название</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Атрибуты</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><a href="{{route('products.show', $product->id)}}">{{$product->article}}</a></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->status}}</td>
                            <td>
                                @foreach($product->data as $key => $attribute)
                                    <div>{{$key}}: {{$attribute}}</div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-1">
                <a href="{{route('products.create')}}" class="btn btn-primary">Добавить</a>
            </div>
        </div>
    </div>
@endsection
