<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Виробниче навчання | Веб-розробка</title>
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>
    <script src="{{asset('/js/index.js')}}"></script>
</head>
<body>
    @if(count($errors) > 0)
        <div class="alert-container reg-error">
            <div class="alert">
                <h3 class="dark">Помилка</h3>
                <p class="dark alert-text">
                    Відбулась невідома помилка. Перевірте введені дані та спробуйте ще раз.
                </p>
                <div class="reg-error-progressbar"></div>
            </div>
        </div>
    @endif
    <div class="preloader-container">
    </div>
    <div class="alert-container">
        <div class="alert">
            <h3 class="dark">Повідомлення</h3>
            <p class="dark alert-text"></p>
            <button class="black-button close-alert">
                <span>
                    OK
                </span>
            </button>
        </div>
    </div>
    <header id="screen-0">
        <div class="full-menu-container">
            <div class="full-menu-header">
                <b class="dark h4-like">Меню</b>
                <span class="close-full-menu">
                    <img src="{{asset('/images/icons/close-black.svg')}}" alt="Закрити меню">
                </span>
            </div>
            <div class="full-menu-main">
                <div>
                    <b class="h4-like">Головне меню</b>
                    <ul>
                        <li><a href="{{url('/')}}" class="non-dec dark to-accent">Головна</a></li>
                        <li><a href="{{url('/dashboard/study/')}}" class="non-dec dark to-accent">Матеріали</a></li>
                        @if(!Auth::check())
                            <li><a href="#" class="non-dec dark to-accent reg-trigger">Реєстрація</a></li>
                            <li><a href="#" class="non-dec dark to-accent auth-trigger">Авторизація</a></li>
                        @endif
                    </ul>
                </div>
                <div>
                    <b class="h4-like">Розділи</b>
                    <ul>
                        <li><a href="{{url('/dashboard/study/1')}}" class="non-dec dark to-accent">HTML</a></li>
                        <li><a href="{{url('/dashboard/study/2')}}" class="non-dec dark to-accent">CSS</a></li>
                        <li><a href="{{url('/dashboard/study/3')}}" class="non-dec dark to-accent">Javascript</a></li>
                        <li><a href="{{url('/dashboard/study/4')}}" class="non-dec dark to-accent">Backend</a></li>
                    </ul>
                </div>
                @if(Auth::check())
                    <div>
                        <b class="h4-like">Системні</b>
                        <ul>
                            <li><a href="{{url('/dashboard')}}" class="non-dec dark to-accent">Домашній кабінет</a></li>
                            @if(Auth::user()->access_level == 2)
                                <li><a href="{{url('/admin/home')}}" class="non-dec dark to-accent">Панель адміністратора</a></li>
                            @endif
                            <li><a href="{{url('/logout')}}" class="non-dec dark to-accent">Вийти</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="login-second-form-container">
            <div class="close-login-second-form close-window">
                <img src="{{asset('/images/icons/left-arrow.svg')}}" alt="Назад">
                <span class="p-like white">Назад</span>
            </div>
            <div>
                <h3 class="white">Авторизація</h3>
                <form method="POST" action="{{url('login')}}" autocomplete="off" >
                    @csrf
                    <h4 class="white">Дані для входу</h4>
                    <br>
                    <input type="text" id="additional-auth-form-login" class="white validate" placeholder=" " name='login' data-from='3' data-to='32' data-validate='false' data-field="Логін">
                    <label for="additional-auth-form-login" class="white">Введіть логін</label>
                    <br>
                    <input type="password" id="additional-auth-form-password" class="white validate" placeholder=" " name='password' data-from='6' data-to='120' data-validate='false' data-field="Пароль">
                    <label for="additional-auth-form-password" class="white">Введіть пароль</label>
                    <span>
                        <button class="white-button" type="submit">
                            <span>
                                Увійти
                            </span>
                        </button>
                        <span><a href="#" class="p-like forgot-password-text"> Забули пароль?</a></span>
                    </span>
                </form>
            </div>
        </div>
        <div class="register-second-form-container">
            <div class="close-register-second-form close-window">
                <span class="p-like dark">Назад</span>
                <img src="{{asset('/images/icons/left-arrow-black.svg') }}" alt="Назад">
            </div>
            <div>
                <h3 class="dark">Реєстрація</h3>
                <form method="POST" action="{{url('register')}}" autocomplete="off" >
                    @csrf
                    <h4 class="dark">Дані для входу</h4>
                    <div class="reg-form-container">
                        <div>
                            <br>
                            <input type="text" id="second-reg-form-login" class="dark validate" placeholder=" " name='login' data-from='3' data-to='32' data-validate='false' data-field="Логін">
                            <label for="second-reg-form-login" class="dark">Введіть логін</label>
                            <br>
                            <input type="text" id="second-reg-form-email" class="dark validate" placeholder=" " name='email' data-from='5' data-to='32' data-validate='false' data-field="Email">
                            <label for="second-reg-form-email" class="dark">Введіть адресу пошти</label>
                        </div>
                        <div>
                            <br>
                            <input type="password" id="second-reg-form-password" class="dark top-reg-pass validate" placeholder=" " name='password' data-from='6' data-to='120' data-validate='false' data-field="Пароль" data-link = "top-reg-pass-conf">
                            <label for="second-reg-form-password" class="dark">Введіть пароль</label>
                            <br>
                            <input type="password" id="second-reg-form-password-re" class="dark top-reg-pass-conf validate" placeholder=" " name='password_confirmation' data-validate='false' data-field="Повтор паролю" data-link = "top-reg-pass">
                            <label for="second-reg-form-password-re" class="dark">Повторіть пароль</label>
                        </div>
                    </div>
                    <br><br>
                    <h4 class="dark">Дані про користувача</h4>
                    <div class="reg-form-container">
                        <div>
                            <br>
                            <input type="text" id="second-reg-form-name" class="dark validate" placeholder=" " name='name' data-from='6' data-to='48' data-validate='false' data-field="ПІБ">
                            <label for="second-reg-form-name" class="dark">Введіть ваше ПІБ</label>
                        </div>
                        <div>
                            <br>
                            <select id="second-reg-form-group" name="group">
                                <option value="1" selected>Оберіть групу...</option>

                                @foreach ($groups as $group)
                                    <option value="{{$group['id']}}">{{$group['name']}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <span>
                        <button class="black-button" type="submit">
                            <span>
                                Зареєструватись
                            </span>
                        </button>
                        <span class="p-like register-text dark">
                            Реєструючись на сайті ви погоджуєтесь на зберігання та обробку введених даних.
                        </span>
                    </span>
                </form>
            </div>
        </div>
        <div class="header-backround-color">
            <div class="container">
                <nav>
                    <div class="logo-container">
                        <img src="{{asset('/images/icons/logo.svg')}}" alt="Веб-розробка">
                        <span class="logo-text-container">
                            <b class="sitename white">Виробниче навчання</b><br>
                            <small class="white">Розділ: "Веб-розробка"</small>
                        </span>
                    </div>
                    <div class="menu-container">
                        <ul>
                            <li>
                                <a href="{{url('/')}}">Головна</a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/study/')}}">Матеріали</a>
                            </li>
                            @if(Auth::check())
                                <li>
                                    <a href="{{url('/dashboard/home/')}}">Особистий кабінет</a>
                                </li>
                            @else
                                <li>
                                    <a href="#" class="auth-trigger">Увійти</a>
                                </li>
                                <li>
                                    <a href="#" class="reg-trigger">Зареєструватись</a>
                                </li>
                            @endif
                            <li>
                                <div class="menu-expand">
                                    <div class="menu-line"></div>
                                    <div class="menu-line"></div>
                                    <div class="menu-line menu-line-short"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="header-content-wrapper">
                    <div class="header-content header-text">
                        <span class="white p-like header-text-anim">Навчальний сайт</span>
                        <h1 class="white header-text-anim">Виробниче навчання</h1>
                        <br>
                        <p class="white header-text-anim">
                            На даному веб ресурсі міститься вся необхідна інформація для вивчення теми "Веб-розробка" в межах професії "Оператор з обробки інформації та програмного забезпечення"
                        </p>
                        <button class="red-button header-text-anim reg-trigger">
                            <span>
                                Зареєструватись
                            </span>
                        </button>
                        <a href="{{url('/dashboard/study/')}}">
                            <button class="white-button header-text-anim">
                                
                                    <span>
                                        Розпочати навчання
                                    </span>
                                
                            </button>
                        </a>
                    </div>
                    <div class="header-content header-themes">
                        <div class="header-themes-container">
                            <div class="header-theme-container">
                                <div class="header-theme-icon">
                                    <img src="{{asset('/images/icons/html.svg')}}" alt="HTML">
                                    <span class="h3-like light-bg">HTML</span>
                                    <p class="white header-theme-icon-desciption">
                                        Гіпертекстова розмітка
                                    </p>
                                </div>
                                <div class="header-theme-decoration">
                                    <div class="theme-decoration-line-container">
                                               
                                    </div>
                                </div>
                            </div>
                            <div class="header-theme-container">
                                <div class="header-theme-decoration">
                                    <div class="theme-decoration-line-container line-decoration-reversed">
                                        
                                    </div>
                                </div>
                                <div class="header-theme-icon">
                                    <img src="{{asset('/images/icons/css.svg')}}" alt="CSS">
                                    <span class="h3-like light-bg">CSS</span>
                                    <p class="white header-theme-icon-desciption">
                                        Каскадні таблиці стилів
                                    </p>
                                </div>
                            </div>
                            <div class="header-theme-container">
                                <div class="header-theme-icon">
                                    <img src="{{asset('/images/icons/js.svg')}}" alt="JS">
                                    <span class="h3-like light-bg">Javascript</span>
                                    <p class="white header-theme-icon-desciption">
                                        Мова програмування
                                    </p>
                                </div>
                                <div class="header-theme-decoration">
                                    <div class="theme-decoration-line-container">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-themes-button-container">
                            <a href="{{url('/dashboard/study')}}">
                                <button class="white-button">
                                    <span>
                                        Більше інформації
                                    </span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-hint" id="scroll-down">
                <small class="white">прокрутіть</small>
            </div>
        </div>
        
    </header>
    <section id="screen-1" class="scrollable about-us">
        <div class="container">
            <h2 class="text-align-center">
                Про сайт
            </h2>
            <div class="title-line accent"></div>
            <p class="text-align-center">
                Мета даного сайту полягає в наданні зручного ресурсу для вивчення тем, що стосуються веб-розробки
            </p>
            <h3 class="gray text-align-center main-themes-title">Що я дізнаюсь?</h3>
            <div class="title-line gray"></div>
            <div class="main-themes-cards-wrapper">
                <div class="main-themes-wrapper-decoration">
                    <div class="main-themes-decoration-element"></div>
                    <div class="main-themes-decoration-element"></div>
                    <div class="main-themes-decoration-element"></div>
                    <div class="main-themes-decoration-element"></div>
                    <div class="main-themes-decoration-element"></div>
                </div>
                <div class="main-themes-cards-container">
                    <article class="main-theme-card">
                        <div class="main-theme-card-pin"></div>
                        <img class="main-theme-card-icon" src="{{asset('/images/icons/html-light.svg')}}" alt="HTML">
                        <h4 class="dark">HTML</h4>
                        <p class="dark main-theme-card-preview-full">
                            Загальне розуміння мови розмітки HTML, яке дозволить здійснювати верстку шаблонів стандартного рівня складності.
                        </p>
                        <p class="dark main-theme-card-preview-mobile">
                            Верстка сторінки.
                        </p>
                        <div class="main-theme-card-description">
                            <p class="white">
                                Загальне розуміння мови розмітки HTML, яке дозволить здійснювати верстку шаблонів стандартного рівня складності.
                            </p>
                        </div>
                    </article>
                    <article class="main-theme-card">
                        <div class="main-theme-card-pin"></div>
                        <img class="main-theme-card-icon" src="{{asset('/images/icons/css-light.svg')}}" alt="CSS">
                        <h4 class="dark">CSS</h4>
                        <p class="dark main-theme-card-preview-full">
                            Форматування тексту, створення анімацій, сучасні техніки блокової верстки, псевдокласи та псевдоелементи.
                        </p>
                        <p class="dark main-theme-card-preview-mobile">
                            Блоки, анімація, адаптивність
                        </p>
                        <div class="main-theme-card-description">
                            <p class="white">
                                Форматування тексту, створення анімацій, сучасні техніки блокової верстки, псевдокласи та псевдоелементи.
                            </p>
                        </div>
                    </article>
                    <article class="main-theme-card">
                        <div class="main-theme-card-pin"></div>
                        <img class="main-theme-card-icon" src="{{asset('/images/icons/js-light.svg')}}" alt="JavaScript">
                        <h4 class="dark">Javascript</h4>
                        <p class="dark main-theme-card-preview-full">
                            Основи розробки сценаріїв засобами скриптової мовипрограмування JavaScript сучасного стандарту ECMAScript 6.
                        </p>
                        <p class="dark main-theme-card-preview-mobile">
                            Основи мови програмування Javascript.
                        </p>
                        <div class="main-theme-card-description">
                            <p class="white">
                                Основи розробки сценаріїв засобами скриптової мовипрограмування JavaScript сучасного стандарту ECMAScript 6.
                            </p>
                        </div>
                    </article>
                    <article class="main-theme-card">
                        <div class="main-theme-card-pin"></div>
                        <img class="main-theme-card-icon" src="{{asset('/images/icons/backend-light.svg')}}" alt="Backend">
                        <h4 class="dark ">Backend</h4>
                        <p class="dark main-theme-card-preview-full">
                            Робота з системами керування контентом, публікація сайту, робота з хостингом, основи мовип рограмування PHP.
                        </p>
                        <p class="dark main-theme-card-preview-mobile">
                            Публікація сайту, CMS, PHP.
                        </p>
                        <div class="main-theme-card-description">
                            <p class="white">
                                Робота з системами керування контентом, публікація сайту, робота з хостингом, основи мовип рограмування PHP.
                            </p>
                        </div>
                    </article>
                </div>
            </div>
            <br>
            <div class="text-align-center">
                <button class="black-button">
                    <a href="{{url('/dashboard/study/')}}" class='non-dec white'>
                        <span>
                            Розпочати навчання
                        </span>
                    </a>
                </button>
            </div>
        </div>
        <div class="about-us-bottom-decor">
                
        </div>
    </section>
    <section id="screen-2" class="scrollable auth-reg">
        <div class="auth-reg-container auth-reg-container-left">
            <div class="small-container">
                <div class="auth-decoration-line"></div>
                <div class="auth-lines-black">
                    <img src="{{asset('/images/auth-black-lines.svg')}}" alt="">
                </div>
                <div class="auth-text">
                    <h3 class="white">Авторизація</h3>
                    <br>
                    <p class="white">
                        Для авторизації в системі вам необхідно ввести дані, які було  використано при реєстрації. Перед тим, як увійти в профіль, переконайтесь, що ваш профіль активовано адміністрацією.
                    </p>
                </div>
                <form method="POST" action="{{url('login')}}" class="auth-form" autocomplete="off">
                    @csrf
                    <h4 class="white">Дані для входу</h4>
                    <br>
                    <input type="text" id="auth-form-login" class="white validate" placeholder=" " name='login' data-from='3' data-to='32' data-validate='false' data-field="Логін">
                    <label for="auth-form-login" class="white" >Введіть логін</label>
                    <br>
                    <input type="password" id="auth-form-password" class="white validate" placeholder=" " name='password' data-from='6' data-to='120' data-validate='false' data-field="Пароль">
                    <label for="auth-form-password" class="white" >Введіть пароль</label>
                    <span class="auth-reg-submit">
                        @if(!Auth::check())
                            <button class="white-button" type="submit" >
                                <span>
                                    Увійти
                                </span>
                            </button>
                            <span><a href="#" class="p-like forgot-password-text"> Забули пароль?</a></span>
                        @else
                            <span class="p-like white">
                                Ви не можете увійти, оскільки вже авторизовані.
                            </span>
                        @endif
                    </span>
                    <br><br>
                    <h4 class="white p-like mobile-to-reg" id="to-reg">Немає акаунту? Тисніть сюди!</h4>
                </form>
                
            </div>
        </div>
        <div class="auth-reg-container">
            <div class="small-container">
                <div class="reg-lines-white">
                    <img src="{{asset('/images/reg-white-lines.svg')}}" alt="">
                </div>
                <div class="reg-decoration-line"></div>
                <div class="reg-text">
                    <h3 class="dark">Реєстрація</h3>
                    <br>
                    <p class="dark">
                        Для отримання доступу до всього наповнення сайту 
                        необхідно пройти процедуру реєстрації.<span class='reg-text-additional-text'> Уважно заповнюйте 
                        поля та майте на увазі, що профілі проходять модерацію.</span>
                    </p>
                </div>
                <form method="POST" action="{{url('register')}}" class="reg-form main-reg-form" autocomplete="off" >
                    @csrf
                    <h4 class="dark">Дані для входу</h4>
                    <div class="reg-form-container">
                        <div>
                            <br>
                            <input type="text" id="reg-form-login" class="dark validate" placeholder=" " name='login' data-from='3' data-to='32' data-validate='false' data-field="Логін">
                            <label for="reg-form-login" class="dark">Введіть логін</label>
                            <br>
                            <input type="text" id="reg-form-email" class="dark validate" placeholder=" " name='email' data-from='5' data-to='32' data-validate='false' data-field="Email">
                            <label for="reg-form-email" class="dark">Введіть адресу пошти</label>
                        </div>
                        <div>
                            <br>
                            <input type="password" id="reg-form-password" class="dark validate main-reg-pass" placeholder=" " name='password' data-from='6' data-to='120' data-validate='false' data-field="Пароль" data-link = "main-reg-pass-conf">
                            <label for="reg-form-password" class="dark">Введіть пароль</label>
                            <br>
                            <input type="password" id="reg-form-password-re" class="dark validate main-reg-pass-conf" placeholder=" " name='password_confirmation' data-validate='false' data-field="Повтор паролю" data-link = "main-reg-pass">
                            <label for="reg-form-password-re" class="dark">Повторіть пароль</label>
                        </div>
                    </div>
                    <br><br>
                    <h4 class="dark">Дані про користувача</h4>
                    <div class="reg-form-container">
                        <div>
                            <br>
                            <input type="text" id="reg-form-name" class="dark validate" placeholder=" " name='name' data-from='6' data-to='48' data-validate='false' data-field="ПІБ">
                            <label for="reg-form-name" class="dark">Введіть ваше ПІБ</label>
                        </div>
                        <div>
                            <br>
                            <select id="reg-form-group" name='group'>
                                <option value="1" selected>Оберіть групу...</option>
                                @foreach ($groups as $group)
                                    <option value="{{$group['id']}}">{{$group['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <span class="auth-reg-submit">
                        @if(!Auth::check())
                            <button class="black-button main-reg-submit" type="submit" data-target="main-reg-form">
                                <span>
                                    Зареєструватись
                                </span>
                            </button>
                            <span class="p-like register-text dark">
                                Реєструючись на сайті ви погоджуєтесь на зберігання та обробку введених даних.
                            </span>
                        @else
                            <span class="p-like dark">
                                Ви не можете зареєструватись, оскільки вже авторизовані.
                            </span>
                        @endif
                    </span>
                    <br><br>
                    <h4 class="dark p-like mobile-to-reg" id="to-auth">Вже є акаунт? Увійдіть!</h4>
                </form>
            </div>
        </div>
    </section>
    <footer id="screen-3" class="scrollable">
        <div class="container">
            <div class="logo-container footer-logo">
                <img src="{{asset('/images/icons/logo.svg')}}" alt="Веб-розробка">
                <span class="logo-text-container">
                    <b class="sitename white">Виробниче навчання</b><br>
                    <small class="white">Розділ: "Веб-розробка"</small>
                </span>
            </div>
            <div class="footer-content-wrapper">
                <div class="footer-content">
                    <h4 class="white">Меню</h4>
                    <ul>
                        <li><a href="{{url('/dashboard')}}" class="non-dec footer-item-color to-accent">Головна</a></li>
                        <li><a href="{{url('/dashboard/study/')}}" class="non-dec footer-item-color to-accent">Матеріали</a></li>
                    </ul>
                </div>
                <div class="footer-content footer-content-themes">
                    <h4 class="white">Матеріал</h4>
                    <div class="footer-content-theme-container">
                        <div>
                            <ul>
                                <li class="footer-item-color">HTML:</li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Основи</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Поняття тегу</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Робота з текстом</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Посилання</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Зображення</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul>
                                <li class="footer-item-color">CSS:</li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul>
                                <li class="footer-item-color">Javascript:</li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul>
                                <li class="footer-item-color">Backend:</li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                                <li><a href="#" class="non-dec footer-item-color to-accent">Тема</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-content">
                    <h4 class="white">Контакти</h4>
                    <ul>
                        <li class="footer-item-color">admin@domain.com</li>
                        <li class="footer-item-color">admin2@domain.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-content-wrapper">
                <div class="footer-content footer-about-us">
                    <h4 class="white">Про нас</h4>
                    <p class="footer-item-color">
                        Даний сайт розроблено в якості інтерактивного посібника з вивчення тем, що стосуються веб розробки в рамках професії "Оператор з обробки інформації та програмного забезпечення"
                    </p>
                </div>
                <div class="footer-content footer-logos-wrapper">
                    <h4 class="white">Корисні посилання</h4>
                    <div class="footer-logos-container">
                        {{-- <img src="{{asset('/images/footer-logos.svg')}}" alt="Логотипи"> --}}
                        <a href="http://mkkp.tk.te.ua" target="_blank"><img src="{{asset('/images/mkkp.svg')}}" alt="Методична комісія"></a>
                        <a href="http://edu.tk.te.ua/okg" target="_blank"><img src="{{asset('/images/okg.svg')}}" alt="Основи комп'ютерної графіки та веб дизайну"></a>
                        <a href="https://developer.mozilla.org/ru/" target="_blank"><img src="{{asset('/images/mdn.svg')}}" alt="Документація MDN"></a>
                        <a href="https://caniuse.com" target="_blank"><img src="{{asset('/images/canuse.svg')}}" alt="Can I use...?"></a>
                    </div> 
                </div>
            </div>
            <div class="copyright-container">
                <p class="white">
                    domen.com | Навчальний сайт з виробничого навчання (веб-розробка) © 2020
                </p>
                <p class="footer-item-color">
                    Публікація контенту на інших ресурсах можлива тільки з вказанням джерела.
                </p>
            </div>    
        </div>
    </footer>
</body>
</html>