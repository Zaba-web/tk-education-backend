@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали - {{$task->title}}
@endsection

@section('menu')
    @include('includes.user_menu')
@endsection

@section('description')

@endsection

@section('content')
    <div class="content-wrapper">
        <h1 class="dark">Навчальні матеріали - {{$task->title}}</h1>
        @if($task->check_mode != 4)
            <div class="regular-block-full content">
                <span class="dark h3-like">Теоретичні відомості</span>
                <span class="dark">
                    <div class="tableOfContents">
                        <ul class="table-of-contents">
                        </ul>
                    </div>
                    {!!$task->theory!!}
                </span>
            </div>
        @endif
        @if($task->check_mode > 1)
            <div class="regular-block-full content">
                <span class="dark h3-like">Практика</span>
                <p class="dark">
                    @if($task->check_mode >= 3)
                        Виконайте поставлене завдання та надішліть роботу, скориставшись кнопками нижче. Роботу слід надіслати у вигляді архіву, назва якого містить ваше прізвище.
                    @endif
                </p>
                <span class="dark">
                    {!!$task->task!!}            
                </span>
                {{--
                    <small class="dark">HTML:</small>
                    <input type="checkbox" class='editors' value='html' checked>
                    <small class="dark">CSS:</small>
                    <input type="checkbox" class='editors' value='css' checked>
                    <small class="dark">JS:</small>
                    <input type="checkbox" class='editors' value='js' checked>
                    <br><br>
                    <div class="code-editor-container">
                        <div class="html-editor-container">
                            <small class="editor-hint">HTML</small>
                            <div id="html-editor"></div>
                        </div>
                        <div class="css-editor-container">
                            <small class="editor-hint">CSS</small>
                            <div id="css-editor"></div>
                        </div>
                        <div class="js-editor-container">
                            <small class="editor-hint">JS</small>
                            <div id="js-editor"></div>
                        </div>
                        <div class="code-result">

                        </div>
                    </div>
                    <br> 
                --}}
                {{-- <button class="dashboard blue eval-script"><span>Виконати скріпт</span></button> --}}
                <form method="POST" action="{{url('/dashboard/study/task/complete')}}" v-on:submit="validateForm" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id='work' name='work' accept=".html, .rar, .7zip, .7z, .zip, .gz, .tgz" style='opacity:0;'>
                    <label for="work" class="dark" style='opacity:1;'>
                        <span style='padding:10px 35px;color:#fff;background:#001021;cursor:pointer;border-radius:10px;'>Обрати файл</span>
                        <span class="p-like" id='selected-file-name'>Файл не обрано...</span>
                    </label>
                    <input type="hidden" name='_sessTok' value='{{$task->id}}'>
                    <button class="dashboard bright"><span>Надіслати роботу</span></button>
                </form>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            let loadFileInput = document.getElementById("work");
            let fileNameDispalyer = document.getElementById("selected-file-name");
            loadFileInput.onchange = function(){
                if(this.files[0].name != undefined){
                    fileNameDispalyer.innerHTML = this.files[0].name;
                }else{
                    fileNameDispalyer.innerHTML = "Файл не обрано...";
                }
            }
        });
    </script>
    <script src="{{asset('js/tableOfContentGenerator.js')}}"></script>
@endsection