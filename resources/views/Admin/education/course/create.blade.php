@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали - Створити розділ
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Навчальні матеріали - Створити розділ</h1>
    <p class="dark">
        На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
    </p>
    
    <div class="flex-horizontal">
        <div class="regular-block">
            <h3 class="dark">Створити розділ</h3>
            <p>Заповніть поля форми.</p>
            <form method="POST" action="{{url('admin/education/course/create')}}" v-on:submit="validateForm">
                @csrf
                <input type="text" id="course-name" name='name' class="dark" placeholder=" " autocomplete="off" v-on:blur="validateInput" name='login' data-from='2' data-to='64' data-validate='false' data-field="Назва розділу">
                <label for="course-name" class="dark">Введіть назву розділу</label>
                <br>
                <input type="text" id="course-description" name='description' class="dark" placeholder=" " autocomplete="off" v-on:blur="validateInput" name='login' data-from='5' data-to='4096' data-validate='false' data-field="Опис розділу">
                <label for="course-description" class="dark">Введіть опис розділу</label>
                <button class="dashboard regular"><span>Створити</span></button>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
   
@endsection