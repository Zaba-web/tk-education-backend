@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали - {{$task->title}}
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
        <a href="{{url("/admin/education/theme/manage/{$task->theme_id}")}}" class='white'>Повернутись назад</a>
    </small>
    <br>
    <br>
    <br>
    <h1 class="dark">Навчальні матеріали - {{$task->title}}</h1>
    <p class="dark">
        На даній сторінці міститься вся інформація про поточні навчальні матеріали та всі необхідні, для керування ними, інструменти.
    </p>
    <div class="no-bg-container content">
        <div class="regular-block-full">
            <span class="dark h3-like">{{$task->title}}</span>
            <p>Ви відкрили {{$task->title}} в режимі перегляду.</p>
            <div class="tableOfContents">
                <ul class="table-of-contents">
                </ul>
            </div>
            {!!$task->theory!!}
        </div>
        <div class="regular-block-full">
            <span class="dark h3-like">Завдання</span>
            <p>Завдання до {{$task->title}}.</p>
            <br>
            {!!$task->task!!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/tableOfContentGenerator.js')}}"></script>
@endsection