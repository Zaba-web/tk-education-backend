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
        <h3>Завдання</h3>
        <p>
            Оберіть завдання для перевірки.
        </p>
        <br>
        <div class="table-container">
            <table>
                <tr>
                    <th>Заголовок</th>
                    <th>Операції</th>
                </tr>
                @foreach ($tasks as $task)
                    @if($task->is_draft == 1)
                        <tr>
                            <td><small>{{$task['theme_name']}} - </small>{{$task->title}} @if($task->is_themactic == "on") <sup>Тематична</sup> @endif</td>
                            <td>
                                <a href="{{url('/admin/check/')}}/{{$task['course_id']}}/task/{{$task->id}}" class="dark">Переглянути</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    
@endsection