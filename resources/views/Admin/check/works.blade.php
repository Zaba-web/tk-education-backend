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
    <h1 class="dark">Перевірка - {{$data['task']->title}}</h1>
    <p class="dark">
        Засобами даної сторінки можна переглядати роботи учнів, відсортовані по розділах, темах та групах, здійснювати оцінювання виконаних завдань та залишати коментарі.
    </p>
    <br>
    <div class="no-bg-container">
        <h3>Роботи, які очікують перевірки</h3>
        <p>
            Перелік всіх робіт за обраним завданням.
        </p>
        <div class="table-container">
            <button class="dashboard regular resetFilter">Скинути фільтр</button>
            <br><br>
            <table class='unchecked-table'>
                <tr class="t-head">
                    <th>Дата здачі</th>
                    <th>Група</th>
                    <th>Ім'я</th>
                    <th>Операції</th>
                </tr>
                @foreach ($data['uncheked'] as $work)
                    <tr class='group-{{$work->group_id}}'>
                        <td>{{$work->created_at}}</td>
                        <td class='filter' data-id='{{$work->group_id}}'>{{$work->getGroup()}}</td>
                        <td>{{$work->getStudentName()}}</td>
                        <td>
                            <a href='{{url('/admin/check/work/')}}/{{$work->id}}' class="dark">Перевірити</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="no-bg-container">
        <h3>Перевірені роботи</h3>
        <p>
            Роботи, перевірка яках завершена.
        </p>
        <div class="table-container">
            <button class="dashboard regular resetFilter">Скинути фільтр</button>
            <br><br>
            <table class='unchecked-table'>
                <tr class="t-head">
                    <th>Дата здачі</th>
                    <th>Група</th>
                    <th>Ім'я</th>
                    <th>Оцінка</th>
                    <th>Коментар</th>
                </tr>
                @foreach ($data['checked'] as $work)
                    <tr class='group-{{$work->group_id}}'>
                        <td>{{$work->created_at}}</td>
                        <td class='filter' data-id='{{$work->group_id}}'>{{$work->getGroup()}}</td>
                        <td>{{$work->getStudentName()}}</td>
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