@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали - Теми - {{$data["theme"]->title}}
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    
@endsection

@section('content')
<div class="content-wrapper">
    <small class='back-container'>
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="16" height="16"viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M116.45833,9.63021l-64.5,71.66667l-4.25521,4.70313l4.25521,4.70313l64.5,71.66667l10.75,-9.40625l-60.24479,-66.96354l60.24479,-66.96354z"></path></g></g></svg>
        <a href="{{url("/admin/education/course/manage/{$data["theme"]->course_id}")}}" class='white'>Повернутись назад</a>
    </small>
    <br>
    <br>
    <br>
    <h1 class="dark">Навчальні матеріали - Теми - {{$data["theme"]->title}}</h1>
    <p class="dark">
        На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
    </p>
    
    <a href="{{url('admin/education/task/create')}}/{{$data["theme"]->id}}" class='non-dec'><button class="dashboard regular"><span>Створити завдання</span></button></a>
    <div class="no-bg-container">
        <h3>Завдання</h3>
        <p>
            Список всіх завдань до теми {{$data["theme"]->title}}
        </p>
        <br>
        <div class="table-container">
            <task-list theme="{{$data["theme"]->id}}" v-on:delstart='showDeleteConfirmMessage'></task-list>         
        </div>
    </div>
    <br>
    <div class="no-bg-container">
        <h3>Доступ</h3>
        <p>
            Список груп, що мають доступ до теми {{$data["theme"]->title}}
        </p>
        <br>
        <div class="table-container">
            <table>
                <tr>
                    <th>Дата</th>
                    <th>ID (запису)</th>
                    <th>ID (групи)</th>
                    <th>Назва групи (не оновлюється)</th>
                </tr>
                @foreach ($data['access'] as $record)
                    <tr>
                        <td>{{$record->created_at}}</td>
                        <td>{{$record->id}}</td>
                        <td>{{$record->group_id}}</td>
                        <td>{{$record->group_name}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script src="{{asset('js/components/education.js')}}"></script>
@endsection