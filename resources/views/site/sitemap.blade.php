@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Карта сайта')
@section('LayoutSectionPageHeader', 'Карта сайта')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.sitemap'))

@section('LayoutSectionPageContent')
    <div style="overflow: scroll; border: red 0px solid;">
        <ol type="I">
            @foreach($postsList as $k => $post)
                <li>
                    <a href="{{ route('site.post', $post->id) }}"
                       style="white-space: nowrap;">{{ $post->name_short }}</a><br/>
                    <ol type="I">
                        @foreach($post->children as $k2 => $post2)
                            <li>
                                <a href="{{ route('site.post', $post2->id) }}"
                                   style="white-space: nowrap;">{{ $post2->name_short }}</a><br/>
                            </li>
                        @endforeach
                    </ol>
                </li>
            @endforeach
        </ol>
    </div>
@stop
