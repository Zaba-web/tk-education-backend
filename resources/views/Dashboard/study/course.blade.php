@extends('layouts.dashboard_ui')

@section('title')
    Навчальні матеріали - {{$data['course']->name}}
@endsection

@section('menu')
    @include('includes.user_menu')
@endsection

@section('description')

@endsection

@section('content')
    <div class="content-wrapper">
        <h1 class="dark">Навчальні матеріали - {{$data['course']->name}}</h1>
        <p class="dark">
            {{$data['course']->description}}
        </p>
        <div>
            @foreach ($data['course']->themes()->get() as $theme)
                <div class="study-theme-block">
                    <div class="study-theme-block-header">
                        <h3 class="dark">{{$theme->title}}</h3>
                        <div class="study-theme-line"></div>
                    </div>
                    <div class="study-theme-block-body">
                        @if($theme->isThemeAvailable(Auth::user()->group_id))
                            <svg class='theme-lock-icon' xmlns="http://www.w3.org/2000/svg" width="7.658" height="9.747" viewBox="0 0 7.658 9.747"> <g id="lock" transform="translate(-51.2)"> <g id="Group_111" data-name="Group 111" transform="translate(51.2)"> <g id="Group_110" data-name="Group 110" transform="translate(0)"> <path id="Path_426" data-name="Path 426" d="M58.51,3.481h-.348V3.133a3.133,3.133,0,0,0-6.266,0v.348h-.348a.348.348,0,0,0-.348.348V9.4a.348.348,0,0,0,.348.348H58.51a.348.348,0,0,0,.348-.348V3.829A.348.348,0,0,0,58.51,3.481Zm-5.918-.348a2.437,2.437,0,1,1,4.873,0v.348H52.592Zm5.57,5.918H51.9V4.177h6.266Z" transform="translate(-51.2)" fill="#001021"/> </g> </g> <g id="Group_113" data-name="Group 113" transform="translate(53.985 5.221)"> <g id="Group_112" data-name="Group 112" transform="translate(0)"> <path id="Path_427" data-name="Path 427" d="M189.784,256.7a1.044,1.044,0,1,0-1.333,1.329v.76a.348.348,0,1,0,.7,0v-.76A1.042,1.042,0,0,0,189.784,256.7Zm-.985.7a.348.348,0,1,1,.348-.348A.348.348,0,0,1,188.8,257.392Z" transform="translate(-187.756 -256)" fill="#001021"/> </g> </g> </g> </svg>
                            <p class="dark">Ця тема поки що закрита для вашої групи. </p>
                        @else
                            <ul>
                                @foreach ($theme->tasks()->get() as $task)
                                    @if($task->is_draft == 1)
                                        <li>
                                            <a href="{{url('/dashboard/study/task')}}/{{$task->id}}" class="dark non-dec p-like">{{$task->title}}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            @if($theme->middleMark(Auth::user()->id) != 0)
                                <br><br><br><br>
                                <span class="p-like">Ви вже пройшли цю тему. Ваша оцінка: {{$theme->middleMark(Auth::user()->id)}}</span>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')

@endsection