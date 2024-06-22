@extends('product.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-between mb-3">
            <div class="col-6">
                <h3>Редактирование "{{$product->article}}"</h3>
            </div>

            <div class="col-2">
                <a href="{{route('products.index')}}"><i class="fas fa-times"></i></a>
            </div>
        </div>

        <form method="post" action="{{route('products.update', $product->id)}}" class="w-50 ms-3" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{$product->id}}">

            <div class="mb-3 form-group">
                <label class="form-label">Артикул</label>
                <input type="text" class="form-control" name="article" value="{{$product->article}}">
            </div>
            @error('article')
            <div class="text-danger">{{$message}}</div>
            @enderror

            <div class="mb-3 form-group">
                <label class="form-label">Название</label>
                <input type="text" class="form-control" name="name" value="{{$product->name}}">
            </div>
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror

            <div class="mb-3 form-group">
                <label class="form-label">Статус</label>
                <select class="form-select" name="status">
                    <option value="available" {{$product->status === 'available' ? 'selected': ''}}>Доступен</option>
                    <option value="unavailable" {{$product->status === 'unavailable' ? 'selected': ''}}>Недоступен</option>
                </select>
            </div>

            <div class="mb-3 form-group">
                <label class="form-label">Атрибуты</label>
                @foreach($product->data as $attributeName => $attributeValue)
                    <div class="row mt-3 form-group" id="addedRow">
                        <div class="col-5">
                            <label class="form-label">Название</label>
                            <input type="text" class="form-control" value="{{$attributeName}}" id="nameInput">
                        </div>
                        <div class="col-5">
                            <label class="form-label">Значение</label>
                            <input type="text" class="form-control" value="{{$attributeValue}}" name="data[{{$attributeName}}]">
                        </div>
                        <div class="col-2 align-self-center">
                            <a href="#" id="deleteButton"><i class="fas fa-trash ju"></i></a>
                        </div>
                    </div>
                @endforeach

                <div>
                    <a href="#" id="attributeAdder" class="link-primary">+ Добавить атрибут</a>
                </div>
            </div>

            <input type="submit" class="btn btn-primary" value="Обновить" id="submitButton">
        </form>

        <script>
            $('#attributeAdder').on('click', function() {
                let newAttributeAdd = `<div class="row mt-3 form-group" id="addedRow">
                                       <div class="col-5">
                                           <label class="form-label">Название</label>
                                           <input type="text" class="form-control" id="nameInput">
                                       </div>
                                       <div class="col-5">
                                           <label class="form-label">Значение</label>
                                           <input type="text" class="form-control">
                                       </div>
                                       <div class="col-2 align-self-center">
                                           <a href="#" id="deleteButton"><i class="fas fa-trash ju"></i></a>
                                       </div>
                                   </div>`;
                $('#submitButton').before(newAttributeAdd);
                return false;
            });

            $('form').on('click', '#deleteButton', function () {
                $(this).parents('#addedRow').remove();
                return false;
            });

            $('form').on('input', '#nameInput', function () {
                // Добавляю атрибут name для input, чтобы на сервер отдавались данные в виде data[значение инпута 1] => значение инпута 2
                // Пример - data[color] => red
                $(this).attr('name', this.value);
                let attribute = `data[${$(this).attr('name')}]`
                $(this).parent().next().find('input').attr('name', attribute);
            });

        </script>
    </div>
@endsection
