@extends('layouts.dashboard_ui')

@section('title')
    Налаштування
@endsection

@section('menu')
    @include('includes.user_menu')
@endsection

@section('description')

@endsection

@section('content')
    <div class="content-wrapper">
        <h1 class="dark">Налаштування</h1>
        <p class="dark">
            На даній сторінці ви можете здійснити налаштування свого профілю в систему.        
        </p>
        <div class="flex-horizontal">
            <div class="regular-block">
                <h3 class="dark">Email</h3>
                <p>Змінити адресу електронної пошти.</p>
                <form action="{{url('/dashboard/settings/email')}}/{{Auth::user()->id}}" method='POST' v-on:submit="validateForm">
                    @csrf
                    <input type="text" id="change-email" name='email' class="dark email" placeholder=" " data-from='3' data-to='120' data-validate='false' data-field="Email" data-link = "email-confirm" v-on:blur="validateInput">
                    <label for="change-email" class="dark">Введіть нову адресу пошти</label>
                    <br>
                    <input type="text" id="change-email-repeat" class="dark email-confirm" placeholder=" " data-validate='false' data-field="Повтор email" data-link = "email" v-on:blur="validateInput">
                    <label for="change-email-repeat" class="dark">Повторіть адресу пошти</label>
                    <button class="dashboard regular"><span>Зберегти</span></button>
                </form>
            </div>
            <div class="regular-block">
                <h3 class="dark">Пароль</h3>
                <p>Змінити пароль від профілю.</p>
                <form action="{{url('/dashboard/settings/password')}}/{{Auth::user()->id}}" method='POST' v-on:submit="validateForm">
                    @csrf
                    <input type="password" id="change-password-old" class="dark" placeholder=" " name='old_password' data-validate='false' data-from='6' data-to='64' data-field="Старий пароль" v-on:blur="validateInput">
                    <label for="change-password-old" class="dark">Введіть старий пароль</label>
                    <br>
                    <input type="password" id="change-password-new" class="dark new-password" placeholder=" " name='new_password' data-from='6' data-to='64' data-field="Новий пароль" v-on:blur="validateInput" data-link='new-password-repeat'>
                    <label for="change-password-new" class="dark">Введіть новий пароль</label>
                    <br>
                    <input type="password" id="change-password-new-repeat" class="dark new-password-repeat" placeholder=" " name='new_password_confirm' data-from='6' data-to='64' data-field="Повтор нового пароля" v-on:blur="validateInput" data-link='new-password'>
                    <label for="change-password-new-repeat" class="dark">Повторіть новий пароль</label>
                    <button class="dashboard regular"><span>Зберегти</span></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection