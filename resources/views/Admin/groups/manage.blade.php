@extends('layouts.dashboard_ui')

@section('title')
    Групи - Редугвати групу - {{$group->name}}
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
На цій сторінці відображається інформація про обрану групу.
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Групи - {{$group->name}}</h1>
    <p class="dark">
        На цій сторінці відображається інформація про обрану групу.
    </p>
    <br><br>
    <div class="table-container">
        <students-list-confirmed group={{$group->id}} v-on:delstart='showDeleteConfirmMessage'></students-list-confirmed>
    </div>
</div>

<div class="no-bg-container">
    <h3>Непідтверджені</h3>
    <p>
        Список учнів групи {{$group->name}}, які очікують підтвердження.
    </p>
    <div class="flex-horizontal">
        <div class="table-container half-screen">
            <students-list-unconfirmed group={{$group->id}} v-on:delstart='showDeleteConfirmMessage'></students-list-unconfirmed>
        </div>
        <div class="regular-block dark-block">
            <h3 class="white">Налаштування групи</h3>
            <p class="white">
                Інформація про групу
            </p>
            <form method="POST" action="{{url('/')}}/admin/groups/setup/{{$group->id}}" v-on:submit="validateForm">
                @csrf
                <select name="day" class="white">
                    <option value="1" selected disabled class="dark">Оберіть день проведення</option>
                    <option value="1" class="dark" @if($group->day_vn == 1) selected @endif>Понеділок</option>
                    <option value="2" class="dark" @if($group->day_vn == 2) selected @endif>Вівторок</option>
                    <option value="3" class="dark" @if($group->day_vn == 3) selected @endif>Середа</option>
                    <option value="4" class="dark" @if($group->day_vn == 4) selected @endif>Четвер</option>
                    <option value="5" class="dark" @if($group->day_vn == 5) selected @endif>П'ятниця</option>
                    <option value="6" class="dark" @if($group->day_vn == 6) selected @endif>Субота</option>
                </select>
                <br><br><br>
                <input type="hidden" name="_method" value='PUT'>
                <select name="order" class="white">
                    <option value="1" selected class="dark">Оберіть порядок змін</option>
                    <option value="1" class="dark">перша підгрупа в I, друга в II</option>
                    <option value="2" class="dark">перша підгрупа в в II, друга в I</option>
                </select><br>
                <button class="dashboard bright">Зберегти</button>
            </form>
        </div>
    </div>
</div>

</div>
@endsection

@section('scripts')
    <script src="{{asset('js/components/students.js')}}"></script>
@endsection