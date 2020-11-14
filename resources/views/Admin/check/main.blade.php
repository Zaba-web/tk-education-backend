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
    <h1 class="dark">Перевірка</h1>
    <p class="dark">
        Засобами даної сторінки можна переглядати роботи учнів, відсортовані по розділах, темах та групах, здійснювати оцінювання виконаних завдань та залишати коментарі.
    </p>
    <br>
    
    <div class="no-bg-container">
        <h3>Розділи</h3>
        <p>
            Оберіть розділ для перевірки.
        </p>
        <br>
        <div class="table-container">
            <table>
                <tr>
                    <th>Заголовок</th>
                    <th>К-сть тем</th>
                    <th>Операції</th>
                </tr>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{$course->name}}</td>
                        <td>{{$course->themes()->count()}}</td>
                        <td>
                            <a href="{{url('/admin/check/')}}/{{$course->id}}" class="dark">Переглянути</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    
@endsection