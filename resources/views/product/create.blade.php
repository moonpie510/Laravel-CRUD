@extends('product.layouts.main')

@section('content')
    <form action="{{route('products.store')}}" class="w-50 ms-3" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 form-group">
            <label class="form-label">Артикул</label>
            <input type="text" class="form-control" name="article" value="{{old('article')}}">
        </div>
        @error('article')
        <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="mb-3 form-group">
            <label class="form-label">Название</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        @error('name')
        <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="mb-3 form-group">
            <label class="form-label">Статус</label>
            <select class="form-select" name="status">
                <option selected value="available">Доступен</option>
                <option value="unavailable">Недоступен</option>
            </select>
        </div>

        <div class="mb-3 form-group">
            <label class="form-label">Атрибуты</label>
            <div>
                <a href="#" id="attributeAdder" class="link-primary">+ Добавить атрибут</a>
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Добавить" id="submitButton">
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

@endsection
