@extends('layouts.dashboard_ui')

@section('title')
Перевірка
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Перевірка - {{$result->getFullTaskName()}}</h1>
    <p class="dark">
        Засобами даної сторінки можна переглядати роботи учнів, відсортовані по розділах, темах та групах, здійснювати оцінювання виконаних завдань та залишати коментарі.
    </p>
    <br>
    <div class="no-bg-container">
        <div class="regular-block-full">
            <h3 class="dark">Перевірка</h3>
            <p>Перевірка роботи учня {{$result->getStudentName()}}.</p>
            <span><a href="{{url('/admin/education/task/view/')}}/{{$result->task_id}}" class="dark p-like" target="_blank">Відкрити завдання</a></span>
            <br>
            <span><a href="{{$result->link}}" class="dark p-like" target="_blank">Скачати роботу</a></span>
            <br>
            <form action="{{url('/admin/check/complete')}}/{{$result->id}}" v-on:submit="validateForm">
                @csrf
                <input type="hidden" name='_method' value='PUT'>
                <select name="mark" class="dark">
                    <option value="1" selected>Введіть оцінку</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <br><br>
                <input type="text" id="comment" name='comment' class="dark" placeholder=" " autocomplete="off" v-on:blur="validateInput" value='Все добре (системний коментар)' data-from='2' data-to='256' data-validate='true' data-field="Коментар">
                <label for="comment" class="dark">Залишіть коментар</label>
                <br>
                <button class="dashboard blue">Оцінити</button>
            </form>
            <form action="{{url('/admin/check/reject')}}/{{$result->id}}" v-on:submit="validateForm">
                @csrf
                <input type="hidden" name='_method' value='DELETE'>
                <button class="dashboard bright">Відхилити</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    
@endsection