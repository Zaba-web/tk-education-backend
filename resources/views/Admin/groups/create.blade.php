@extends('layouts.dashboard_ui')

@section('title')
    Групи - Створити групу
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    На цій сторінці відображається список груп, основна інформація про них. Для керування групами потрібно скористатись посиланнями, що розташовано у комірці під заголовком "операції".
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Групи - Створити групу</h1>
    <p class="dark">
        На цій сторінці відображається список груп, основна інформація про них. Для керування групами потрібно скористатись посиланнями, що розташовано 
        у комірці під заголовком "операції".
    </p>

    <div class="flex-horizontal">
        <div class="regular-block">
            <h3 class="dark">Створити групу</h3>
            <p>Заповніть поля форми.</p>
            <form method="POST" action="{{url('admin/groups/create')}}" v-on:submit="validateForm">
                @csrf
                <input type="text" id="group-name" name='group-name' class="dark" placeholder=" " autocomplete="off" v-on:blur="validateInput" name='login' data-from='2' data-to='12' data-validate='false' data-field="Назва групи">
                <label for="group-name" class="dark">Введіть назву групи</label>
                <br>
                <input type="text" id="grouop-master" name='master-name' class="dark" placeholder=" " autocomplete="off" v-on:blur="validateInput" name='login' data-from='5' data-to='12' data-validate='false' data-field="Майстер в/н.">
                <label for="grouop-master" class="dark">Введіть ім'я майстра в/н.</label>
                <button class="dashboard regular"><span>Створити</span></button>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
   
@endsection