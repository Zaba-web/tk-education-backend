@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали - {{$course->name}}
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    {{$course->description}}
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Навчальні матеріали - {{$course->name}}</h1>
    <p class="dark">
        {{$course->description}}
    </p>
    <a href="{{url('admin/education/theme/create')}}/{{$course->id}}" class='non-dec'><button class="dashboard regular"><span>Створити тему</span></button></a>
    <br>
    
    <div class="no-bg-container">
        <h3>Теми</h3>
        <p>
            Список всіх тем в розділі {{$course->name}}
        </p>
        <br>
        <div class="table-container">
            <theme-list :course="{{$course->id}}" v-on:delstart='showDeleteConfirmMessage'></theme-list>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script src="{{asset('js/components/education.js')}}"></script>
@endsection