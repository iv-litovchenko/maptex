@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Разные картинки')
@section('LayoutSectionPageHeader', 'Разные картинки')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.pic'))

@section('LayoutSectionPageContent')
    <center>
        @foreach($images as $image)
            2
            <img src="{{ asset('uploads/image/pic/'.$image->getBasename()) }}"
                 style="width: auto; max-width: 50%; border: gray 3px solid;"/>
            @auth
                <br/>
                <b>{{ $file->getBasename() }}</b>
            @endauth
            <br/>
            <hr/>
        @endforeach
    </center>
@stop
