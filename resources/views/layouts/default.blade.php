<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('LayoutSectionPageTitle') | IT-заметки</title>
    @section('LayoutSectionPageCssFiles')
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/mindmap/dist/mindmap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/contextmenu/dist/jquery.contextMenu.css') }}">
    @show
    @section('LayoutSectionPageCssCode')
        <style>
            html, body {
                background: white;
            }
        </style>
    @show
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('site.home') }}">
                <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="20" height="20"
                     style="display: inline; vertical-align: top;" alt="">
                IT-заметки
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            {!! Menu::get('menu.header.left')->asUl(['class' => 'nav navbar-nav']) !!}
            {!! Menu::get('menu.header.right')->asUl(['class' => 'nav navbar-nav navbar-right'],['class' => 'dropdown-menu']) !!}
            @auth
                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                </form>
            @endauth
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">Всего знаний: {{ $appDbCountTechnology }}</a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>

<div class="container">
    <div class="page-header">
        <h1>@yield('LayoutSectionPageHeader')</h1>
        @yield('LayoutSectionPageBreadcrumb')

        @if(Route::is('site.home'))
            @include('layouts.partials.form-search')
        @endif
    </div>

    @include('layouts.partials.flash-message')
    @yield('LayoutSectionPageContent')
</div> <!-- /container -->

<footer class="footer">
    <div class="container">
        <hr class="my-12"/>
        <p class="text-muted">Версия 0.0.1/{{ $appProjectVersion }} | {{ config('app.name', 'Laravel') }}</p>
        <p>
            Над кодом - как это работает? Интерактивный справочник и копилка знаний. <br/>
            Код пишется для людей. https://bootstrap-4.ru/docs/3.4/getting-started/ <br/>
        </p>
    </div>
</footer>

@section('LayoutSectionPageJsFooterFiles')

    <script src="{{ asset('assets/js/app.js') }}"></script>
{{--    <script src="https://cdn.tiny.cloud/1/i7rtvlx6g594hivyfqzi1d4yk6e0uvnt71bu0wysnpqkkrnl/tinymce/5/tinymce.min.js"></script>--}}
{{--    <script src="{{ asset('assets/contextmenu/dist/jquery.contextMenu.js') }}"></script>--}}
@show

@section('LayoutSectionPageJsFooterCode')
@show

</body>
</html>
