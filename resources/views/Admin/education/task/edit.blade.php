@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали - {{$task->title}} - Редагувати завдання
@endsection

@section('menu')
    @include('includes.admin_menu')
@endsection

@section('description')
    На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
@endsection

@section('content')
<div class="content-wrapper">
    <small class='back-container'>
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="16" height="16"viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M116.45833,9.63021l-64.5,71.66667l-4.25521,4.70313l4.25521,4.70313l64.5,71.66667l10.75,-9.40625l-60.24479,-66.96354l60.24479,-66.96354z"></path></g></g></svg>
        <a href="{{url()->previous()}}" class='white'>Повернутись назад</a>
    </small>
    <br>
    <br>
    <br>
    <h1 class="dark">Навчальні матеріали - Редугвати завдання - {{$task->title}} </h1>
    <p class="dark">
        На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
    </p>
    <form method="POST" action="{{url('admin/education/task/update')}}/{{$task->id}}" v-on:submit="validateForm">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="no-bg-container">
        <div class="regular-block-full">
            <h3 class="dark">Загальні дані</h3>
            <p>Заповніть форму із загальною інформацією про завдання.</p>
            <br>
                <input type="text" name='title' id="section-name" class="dark" value="{{$task->title}}" placeholder=" " autocomplete="off" v-on:blur="validateInput" data-from='2' data-to='256' data-validate='true' data-field="Заголовок">
                <label for="section-name" class="dark">Введіть заголовок завдання</label>
                <br>
                <select name="check_mode" class="dark">
                    <option value="1" class="dark" selected disabled>Налаштування перевірки</option>
                    <option value="1" class="dark" @if($task->check_mode == 1) selected @endif>Не перевіряти (теоретичне завдання)</option>
                    <option value="2" class="dark" disabled>Перевіряти (вбудований редактор)</option>
                    <option value="3" class="dark" @if($task->check_mode == 3) selected @endif>Перевіряти (надсилання файлів)</option>
                </select>
                <br><br><br>
                <select name="publication_setting" class="dark">
                    <option value="1" class="dark" selected disabled>Налаштування публікації</option>
                    <option value="1" class="dark" @if($task->is_draft == 1) selected @endif>Опублікувати</option>
                    <option value="2" class="dark" @if($task->is_draft == 2) selected @endif>Чернетка</option>
                </select>
                <br><br><br>
                <span class='p-like'>Підсумкова робота:</span><input type="checkbox" name="summary_work" style='margin-left:10px;' @if($task->is_themactic == "on") checked @endif>
        </div>
        <div class="regular-block-full">
            <h3 class="dark">Теоретичні відомості</h3>
            <p>Введіть необхідну для опанування даної теми теоретичну інформацію.</p>
            <details>
                <summary><b>Рекомендації</b></summary>
                <ul>
                    <li>Написання матеріалу слід починати із заголовку 2 рівня.</li>
                    <li>Використовувати заголовки першого рівня не рекомендується.</li>
                    <li>Слідкуйте за ієрархією заголовків.</li>
                    <li>Зображення слід розміщувати в невидимі або універсальні контейнери.</li>
                    <li>Рекомендовані формати зображень: jpeg, webp, gif, svg</li>
                    <li>Не слід використовувати додаткові шрифти, кольлори або змінювати розміри тексту.</li>
                    <li>Замість цього скористайтесь меню "Стилі" та "Форматування".</li>
                    <li>Якщо є необхідність завершити роботу пізніше, завдання можна зберегти як чернетку.</li>
                </ul>
            </details>
            <textarea id="theory" name="theory">{{$task->theory}}</textarea>
        </div>
        <div class="regular-block-full">
            <h3 class="dark">Завдання</h3>
            <p>Введіть завдання, яке повинен буде виконати учень.</p>
            <textarea id="task" name="task">{{$task->task}}</textarea>
        </div>
    </div>
    <button class="dashboard bright" type="submit"><span>Зберегти</span></button>
</form>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.11.3/full-all/ckeditor.js"></script>
    <script src="{{asset('js/editor.js')}}"></script>
@endsection