@extends('layouts.dashboard_ui')

@section('title')
    Групи
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    На цій сторінці відображається список груп, основна інформація про них. Для керування групами потрібно скористатись посиланнями, що розташовано у комірці під заголовком "операції".
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Групи</h1>
    <p class="dark">
        На цій сторінці відображається список груп, основна інформація про них. Для керування групами потрібно скористатись посиланнями, що розташовано 
        у комірці під заголовком "операції".
    </p>
    <a href="{{url('admin/groups/create')}}" class='non-dec'><button class="dashboard regular"><span>Створити групу</span></button></a>
    <br>
    
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