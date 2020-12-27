@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали - {{$data["course"]->name}} - Створити Тему
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    {{$data["course"]->description}}
@endsection

@section('content')
<div class="content-wrapper">
    <small class='back-container'>
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="16" height="16"viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M116.45833,9.63021l-64.5,71.66667l-4.25521,4.70313l4.25521,4.70313l64.5,71.66667l10.75,-9.40625l-60.24479,-66.96354l60.24479,-66.96354z"></path></g></g></svg>
        <a href="{{url("/admin/education/course/manage/{$data["course"]->id}")}}" class='white'>Повернутись назад</a>
    </small>
    <br><br>
    <h1 class="dark">Навчальні матеріали - {{$data["course"]->name}} - Створити Тему</h1>
    <p class="dark">
        На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
    </p>
    
    <div class="flex-horizontal">
        <div class="regular-block">
            <h3 class="dark">Створити тему</h3>
            <p>Заповніть поля форми.</p>
            <form method="POST" action="{{url('admin/education/theme/create')}}" v-on:submit="validateForm">
                @csrf
                <input type="text" id="theme-name" name='name' class="dark" placeholder=" " autocomplete="off" v-on:blur="validateInput" name='login' data-from='2' data-to='128' data-validate='false' data-field="Назва теми">
                <label for="theme-name" class="dark">Введіть назву теми</label>
                <br>
                <select name="course_id" class="dark">
                    <option selected value="{{$data["course"]->id}}">{{$data["course"]->name}}</option>
                </select>
                <br>
                <button class="dashboard regular"><span>Створити</span></button>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
   
@endsection