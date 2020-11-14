@extends('layouts.dashboard_ui')

@section('title')
    Користувачі
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    Загальний перелік всіх зареєстрованих в системі користувачів. Включає в себе як учнів так і адміністраторів. Дана сторінка надає можливість змінювати рівень доступу користувачів.
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Користувачі</h1>
    <p class="dark">
        Загальний перелік всіх зареєстрованих в системі користувачів. Включає в себе як учнів так і адміністраторів. Дана сторінка надає можливість змінювати рівень доступу користувачів.
    </p>
    <br>
    
    <div class="no-bg-container">
        <h3>Користувачі</h3>
        <p>
            Список всіх зареєстрованих у системі користувачів.
        </p>
        <br>
        <div class="table-container">
            <user-list v-on:delstart='showDeleteConfirmMessage'></user-list>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script src="{{asset('js/components/users.js')}}"></script>
@endsection