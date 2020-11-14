
<div class="sidebar-container">

    <img src="{{asset('images/icons/logo.svg')}}" alt="Виробниче навчання - веб розробка">
    <b class="white sidebar-title">
        Керування
    </b>

    <div class="menu-wrapper" v-on:click="switchMenu">
        <div class="menu-container">
            <div class="menu-item"></div>
            <div class="menu-item"></div>
            <div class="menu-item"></div>
        </div>
        <span class="white p-like">Меню</span>
    </div>

    <admin-menu></admin-menu>

  </div>