@extends('layouts.dashboard_ui')

@section('title')
    Домашня сторінка
@endsection

@section('menu')
    @include('includes.user_menu')
@endsection

@section('description')
В   и успішно авторизувались в системі та потрапили на домашню сторінку. Тут відображається загальна інформація про ваш профіль та активність. Скористайтесь меню в лівій частині інтерфейсу для початку роботи.
@endsection

@section('content')
    <div class="content-wrapper">
        <h1 class="dark">Домашня сторінка</h1>
        <p class="dark">
            Ви успішно авторизувались в системі та потрапили на домашню сторінку. Тут відображається загальна інформація про ваш профіль та активність. Скористайтесь меню в лівій частині інтерфейсу для початку роботи.
        </p>
        <div class="flex-horizontal">
            <div class="regular-block dark-block welcome-container">
                <h3 class="white">Ласкаво просимо</h3>
                <br>
                <p class="white">
                    Вітаємо вас у системі, {{Auth::user()->name}}.<br>
                    Що далі? Скористайтесь посиланнями:
                </p>
                <a href="{{url('/dashboard/study')}}" class="non-dec">
                    <button class="dashboard bright">
                        <span>Навчання</span>
                    </button>
                </a>
                <a href="{{url('/dashboard/activity')}}" class="non-dec">
                    <button class="dashboard blue">
                        <span>Активність</span>
                    </button>
                </a>
                <br><br>
                <img src="{{asset("images/dashboard.svg")}}" alt="dashboard" class="home-image">
            </div>
            <div class="regular-block">
                <h3 class="dark">Загальна інформація</h3>
                <p class="dark">
                    Інформація про ваш профіль та його статус.
                </p>
                <br>
                <div class="main-incofmration-container">
                    <div>
                        <div>
                            <small>Логін:</small><br>
                            <span class="p-like dark">{{Auth::user()->login}}</span>
                        </div>
                        <br>
                        <div>
                            <small>Ім'я:</small><br>
                            <span class="p-like dark">{{Auth::user()->name}}</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <small>Email:</small><br>
                            <span class="p-like dark">{{Auth::user()->email}}</span>
                        </div>
                        <br>
                        <div>
                            <small>Група:</small><br>
                            <span class="p-like dark">{{$data['group'][0]->name}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="no-bg-container">
            <h3>Остання активність</h3>
            <p>
                Останні записи про вашу навчальну діяльність в системі.
            </p>
            <br>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Дата</th>
                        <th>Назва</th>
                        <th>Оцінка</th>
                        <th>Коментар</th>
                    </tr>
                    @foreach ($data['activity'] as $record)
                        <tr>
                            <td>{{$record->created_at}}</td>
                            <td><small>{{$record->getFullTaskName()}}</small></td>
                            <td>{{$record->mark}}</td>
                            <td>{{$record->comment}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="no-bg-container">
            <h3>Прогрес</h3>
            <p>
                Прогрес у вивченні теми "Веб-розробка".
            </p>
            <br>
            <div class="flex-horizontal">
                <div class="regular-block dark-block">
                    <div class="chart-container">
                        @foreach ($data['courses'] as $course)
                            <div class="chart-item">
                                <small>{{$course->getProgress()}}%</small>
                                <div class="chart">
                                    <div class="chart-fill" style='height:{{$course->getProgress()}}%'></div>
                                </div>
                                <br>
                                <span class="p-like white">{{$course->name}}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="regular-block">
                    <h3>Календар</h3>
                    <p>
                        Розклад проведення виробничого навчання.
                    </p>
                    <div class="calendar-container">
                        <div class="calendar-item @if($data['group'][0]->day_vn == 1) active-day @endif">
                            <span class="calendar-day">ПН</span>
                            @if($data['group'][0]->day_vn == 1)
                            <span class="calendar-date">
                                <span>
                                    Зміна: 
                                    @if(($data['group'][0]->order_vn == 1 && Auth::user()->subgroup == 1) || ($data['group'][0]->order_vn == 2 && Auth::user()->subgroup == 2)) 
                                        I 
                                    @else
                                        II
                                    @endif
                                </span>
                            </span>
                            @endif
                        </div>
                        <div class="calendar-item @if($data['group'][0]->day_vn == 2) active-day @endif" >
                            <span class="calendar-day">ВТ</span>
                            @if($data['group'][0]->day_vn == 2)
                            <span class="calendar-date">
                                <span>
                                    Зміна: 
                                    @if(($data['group'][0]->order_vn == 1 && Auth::user()->subgroup == 1) || ($data['group'][0]->order_vn == 2 && Auth::user()->subgroup == 2)) 
                                        I 
                                    @else
                                        II
                                    @endif
                                </span>
                            </span>
                            @endif
                        </div>
                        <div class="calendar-item @if($data['group'][0]->day_vn == 3) active-day @endif">
                            <span class="calendar-day">СР</span>
                            @if($data['group'][0]->day_vn == 3)
                            <span class="calendar-date">
                                <span>
                                    Зміна: 
                                    @if(($data['group'][0]->order_vn == 1 && Auth::user()->subgroup == 1) || ($data['group'][0]->order_vn == 2 && Auth::user()->subgroup == 2)) 
                                        I 
                                    @else
                                        II
                                    @endif
                                </span>
                            </span>
                            @endif
                        </div>
                        <div class="calendar-item @if($data['group'][0]->day_vn == 4) active-day @endif">
                            <span class="calendar-day">ЧТ</span>
                            @if($data['group'][0]->day_vn == 4)
                            <span class="calendar-date">
                                <span>
                                    Зміна: 
                                    @if(($data['group'][0]->order_vn == 1 && Auth::user()->subgroup == 1) || ($data['group'][0]->order_vn == 2 && Auth::user()->subgroup == 2)) 
                                        I 
                                    @else
                                        II
                                    @endif
                                </span>
                            </span>
                            @endif
                        </div>
                        <div class="calendar-item @if($data['group'][0]->day_vn == 5) active-day @endif">
                            <span class="calendar-day">ПТ</span>
                            @if($data['group'][0]->day_vn == 5)
                            <span class="calendar-date">
                                <span>
                                    Зміна: 
                                    @if(($data['group'][0]->order_vn == 1 && Auth::user()->subgroup == 1) || ($data['group'][0]->order_vn == 2 && Auth::user()->subgroup == 2)) 
                                        I 
                                    @else
                                        II
                                    @endif
                                </span>
                            </span>
                            @endif
                        </div>
                        <div class="calendar-item @if($data['group'][0]->day_vn == 6) active-day @endif">
                            <span class="calendar-day">СБ</span>
                            @if($data['group'][0]->day_vn == 6)
                            <span class="calendar-date">
                                <span>
                                    Зміна: 
                                    @if(($data['group'][0]->order_vn == 1 && Auth::user()->subgroup == 1) || ($data['group'][0]->order_vn == 2 && Auth::user()->subgroup == 2)) 
                                        I 
                                    @else
                                        II
                                    @endif
                                </span>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection