@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Навчальні матеріали</h1>
    <p class="dark">
        На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
    </p>
    <a href="{{url('admin/education/course/create')}}" class='non-dec'><button class="dashboard regular"><span>Створити розділ</span></button></a>
    <br>
    
    <div class="no-bg-container">
        <h3>Розділи</h3>
        <p>
            Список всіх розділів навчальних матеріалів.
        </p>
        <br>
        <div class="table-container">
            <course-list v-on:delstart='showDeleteConfirmMessage'></course-list>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script src="{{asset('js/components/education.js')}}"></script>
@endsection