<?php

use Lavary\Menu\Facade;
use App\Models\Post;
use App\Models\User;
use \App\Models\TvSignal;

// https://github.com/lavary/laravel-menu
// TODO большой недостаток - собирается каждый раз при вызове любой страницы

// Меню из блоков для главной страницы "Панели администратора"
Menu::make('menu.admin.dashboard', function ($menu) {

    $menu->add('Посты', ['route' => 'admin.post.index'])->data('count', Post::count());
    $menu->add('Пользователи', ['route' => 'admin.user.index'])->data('count', User::count());
    $menu->add('Список позиций TV', ['route' => 'admin.tvsignal'])->data('count', TvSignal::count());

});
