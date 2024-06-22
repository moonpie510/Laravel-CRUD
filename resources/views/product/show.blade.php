@extends('product.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-6">
                <h3>{{$product->article}}</h3>
            </div>

            <div class="col-2">
                <a href="{{route('products.edit', $product->id)}}"><i class="fas fa-pen text-success"></i></a>
                <form method="post" action="{{route('products.destroy', $product->id)}}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 bg-transparent"><i class="fas fa-trash mx-4 text-danger"></i></button>
                </form>
                <a href="{{route('products.index')}}"><i class="fas fa-times"></i></a>
            </div>
        </div>

        <div class="row justify-content-start mt-4">
            <div class="col-2">
                <b>Артикул</b>
            </div>
            <div class="col-2">
                {{$product->article}}
            </div>
        </div>

        <div class="row justify-content-start mt-4">
            <div class="col-2">
                <b>Название</b>
            </div>
            <div class="col-2">
                {{$product->name}}
            </div>
        </div>

        <div class="row justify-content-start mt-4">
            <div class="col-2">
                <b>Статус</b>
            </div>
            <div class="col-2">
                {{$product->status}}
            </div>
        </div>

        <div class="row justify-content-start mt-4">
            <div class="col-2">
                <b>Атрибуты</b>
            </div>
            <div class="col-2">
                @foreach($product->data as $attributeName => $attributeValue)
                    <div>{{$attributeName}}: {{$attributeValue}}</div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
