<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$message["title"]}} | Веб-розробка</title>
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>
</head>
<body>
    <section class="register-done">
        <div>
            <h1 class="white">{{$message["title"]}}</h1><br>
            <p class="white">{!! ($message["text"]) !!}</p>
            <br>
            <a href="{{url($message['url'])}}" class="white p-like">Повернутись</a>
        </div>
    </section>
</body>
</html>
