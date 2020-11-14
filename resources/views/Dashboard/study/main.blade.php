@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали
@endsection

@section('menu')
    @include('includes.user_menu')
@endsection

@section('description')

@endsection

@section('content')
    <div class="content-wrapper">
        <h1 class="dark">Навчальні матеріали</h1>
        <p class="dark">
            На даній сторінці ви можете переглянути список доступних для вашої групи навчальних матеріалів. Для отримання повного списку тем та завдань перейдіть на сторінку відповідного розділу.
        </p>
        <div class="flex-wrap">
            @foreach ($courses as $course)
                <div class="regular-block">
                    <h3 class="dark">{{$course->name}}</h3>
                    <p class="dark">
                        {{$course->description}}                    
                    </p>
                    <br>
                    <small>
                        Кількість тем: {{$course->theme_count}}
                    </small>
                    <br>
                    <a href="{{url('/dashboard/study')}}/{{$course->id}}" class="p-like dark">Перейти</a>
                    <br>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')

@endsection