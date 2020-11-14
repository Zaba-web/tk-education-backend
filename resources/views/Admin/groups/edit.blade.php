@extends('layouts.dashboard_ui')

@section('title')
    Групи - Редугвати групу - {{$group->name}}
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    На цій сторінці відображається список груп, основна інформація про них. Для керування групами потрібно скористатись посиланнями, що розташовано у комірці під заголовком "операції".
@endsection

@section('content')
<div class="content-wrapper">
    <h1 class="dark">Групи - Редугвати групу - {{$group->name}}</h1>
    <p class="dark">
        На цій сторінці відображається список груп, основна інформація про них. Для керування групами потрібно скористатись посиланнями, що розташовано 
        у комірці під заголовком "операції".
    </p>
    
    <div class="flex-horizontal">
        <div class="regular-block">
            <h3 class="dark">Редугвати групу</h3>
            <p>Заповніть поля форми.</p>
            <form method="POST" action="{{url('/')}}/admin/groups/update/{{$group->id}}" v-on:submit="validateForm">
                @csrf
                <input type="text" id="group-name" name='group-name' value='{{$group->name}}' class="dark" placeholder=" " autocomplete="off" v-on:blur="validateInput" name='login' data-from='2' data-to='12' data-validate='true' data-field="Назва групи">
                <label for="group-name" class="dark">Введіть назву групи</label>
                <br>
                <input type="text" id="grouop-master" name='master-name'  value='{{$group->master_vn}}' class="dark" placeholder=" " autocomplete="off" v-on:blur="validateInput" name='login' data-from='5' data-to='12' data-validate='true' data-field="Майстер в/н.">
                <label for="grouop-master" class="dark">Введіть ім'я майстра в/н.</label>
                <input type="hidden" name="_method" value='PUT'>
                <button class="dashboard regular"><span>Зберегти</span></button>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
   
@endsection