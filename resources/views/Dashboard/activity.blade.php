@extends('layouts.dashboard_ui')

@section('title')
Активність
@endsection

@section('menu')
    @include('includes.user_menu')
@endsection

@section('description')
    На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Активність</h1>
    <p class="dark">
        Тут відображається ваша навчальна діяльність. Ви можете переглянути список всіх виконаних робіт, переглянути оцінку та коментар майстра виробничого
        навчання.    </p>
    <br>
    
    <div class="no-bg-container">
        <h3>Активність</h3>
        <p>
            Список виконаних завдань
        </p>
        <br>
        <div class="table-container">
            <table>
                <tr>
                    <th>Дата</th>
                    <th>Тема</th>
                    <th>Оцінка</th>
                    <th>Коментар</th>
                </tr>
                @foreach ($works as $work)
                <tr>
                    <td>{{$work->created_at}}</td>
                    <td><small>{{$work->getFullTaskName()}}</small></td>
                    <td>{{$work->mark}}</td>
                    <td>{{$work->comment}}</td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    
@endsection