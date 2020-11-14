@extends('layouts.dashboard_ui')

@section('title')
    Домашня сторінка
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    Ви успішно авторизувались в системі та потрапили на домашню сторінку. Тут відображається загальна інформація про ваш профіль та активність. Скористайтесь меню в лівій частині інтерфейсу для початку роботи.
@endsection

@section('content')
    <div class="content-wrapper">
        <h1 class="dark">Домашня сторінка</h1>
        <p class="dark">
            Вас вітає домашня сторінка адміністративної панелі. На цій сторінці ви можете переглянути узагальнену інформацію про поточне наповненнясистеми.                    
        </p>
        <div class="flex-horizontal">
            <div class="regular-block dark-block welcome-container">
                <h3 class="white">Ласкаво просимо</h3>
                <br>
                <p class="white">
                    Вітаємо вас у системі, {{Auth::user()->name}}.<br>
                    Що далі? Скористайтесь посиланнями:
                </p>
                <a href="{{url('/admin/groups')}}" class="non-dec">
                    <button class="dashboard bright">
                        <span>Групи</span>
                    </button>
                </a>
                <a href="{{url('/admin/check')}}" class="non-dec">
                    <button class="dashboard blue">
                        <span>Перевірка</span>
                    </button>
                </a>
                <br><br>
                <img src="{{asset('images/dashboard.svg')}}" alt="dashboard" class="home-image">
            </div>
            <div class="regular-block dark-block">
                <h3 class="white">Інформація про учнів</h3>
                <p class="white">
                    Загальна інформація про зареєстрованих учнів.
                </p>
                <br>
                <div class="main-incofmration-container">
                    <div>
                        <div>
                            <small class="white">Активних:</small><br>
                            <span class="p-like white active">{{$students['active']}}</span>
                        </div>
                        <br>
                        <div>
                            <small class="white">Очікують підтвердження:</small><br>
                            <span class="p-like white unactive">{{$students['unactive']}}</span>
                        </div>
                    </div>
                    <div>
                        <div class="chart chart-horizontal">
                            <div class="chart-fill chart-fill-horizontal" style='width:100%;'></div>
                        </div>
                        <div class="chart chart-horizontal">
                            <div class="chart-fill chart-fill-horizontal" :style='{width:adminChartWidth}' style='max-width:100%;'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="no-bg-container">
            <h3>Групи</h3>
            <p>
                Список всіх зареєстрованих у системі груп.
            </p>
            <br>
            <div class="table-container">
                <group-list v-on:delstart='showDeleteConfirmMessage'></group-list>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/components/groups.js')}}"></script>
@endsection