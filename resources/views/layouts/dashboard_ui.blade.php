<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="{{asset('js/components/systemMessage.js')}}"></script>
    <script src="{{asset('js/components/adminMenu.js')}}"></script>
    <script src="{{asset('js/components/userMenu.js')}}"></script>
    @yield('scripts')
    <title>@yield('title') | Вирбониче навчання</title>
</head>
<body>
    <span id="token" style='display:none'>{{ csrf_token() }}</span>
    <div class="dashboard-warapper" id="application">
        <div class="sidebar-wrapper">
            @yield('menu')
        </div>
        <main>
            <div class="main-container">
                @include('includes.header')
                @yield('content')
                    <system-message-container></system-message-container>
            </div>
        </main>

    </div>
    <script src="{{asset('js/dashboard.js')}}"></script>
</body>
</html>