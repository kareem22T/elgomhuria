@extends('site.layouts.main')

@section('title', 'الرئيسية')

@section('content')
@php
    $news_bar = App\Models\News_bar::all();
@endphp

@if ($news_bar->count() > 0 && $news_bar->first()->text)
<div class="news_slider" style="background: #FF00000F;display: flex;direction: rtl;padding: 10px;">
    <p style="white-space: nowrap;padding: 0px 1rem;border-left: 2px solid #c00;font-size: 20px;font-weight: 600;display: flex;align-items: center;">اخر الاخبار</p>
    <div class="ticker-wrap" style="width: 100%;">

        <div id="ticker" style="font-weight: 500;font-size: 19px;line-height: 36px;text-align: right;color: #000000;white-space: nowrap;">



            <div id="ticker-box" style="overflow: hidden; min-height: 40px;">
                <ul style="padding: 0px; margin: 0px; position: relative; list-style-type: none;">
                    <li style="position: absolute; white-space: nowrap; right: -3543px; color: rgb(0, 0, 0);">
                        {{$news_bar->first()->text}}
                    </li>
                </ul>
            </div>
            <script>startTicker('ticker-box', {speed: 1, delay:500});</script>
    
        </div>
        </div>
</div>
@endif
@if($search_word)
<div class="container">
    <h1 style="margin: 1rem 0;text-align: right;">نتائج بحث: {{ $search_word}}</h1>
</div>
<input type="hidden" name="search_words" id="search_words" value="{{ $search_word}}">
@endif
@if($articles)
<main class="category">
    <div class="container">
        @foreach ($articles as $article)
            <a href="/article/{{$article->id}}" class="article">
                <img src="{{$article->thumbnail_path}}" alt="">
                <span>
                    {{ $article->title }}
                </span>
            </a>
        @endforeach
    </div>
</main>
<div class="pagination_wrapper">
    {!! $articles->links('pagination::bootstrap-4') !!}
</div>
@endif
{{-- <section class="more">
    <div class="container">
        <div>
            <span>اقرأ المزيد من جميع الاقسام</span>
            عاجل _ الاخبار  _ سياسة _ رآي _ فن وثقافة
            المرآة _ رياضة _ حوادث _ اقتصاد _ تحقيقات _ منوعات
        </div>
    </div>
</section> --}}
@endsection

@section('scripts')
    <script>
        let tagsSearch = "{{ isset($tag_id) ? $tag_id : '' }}"
        $(".pagination_wrapper ul a").each(function() {
            $(this).attr('href', $(this).attr('href') + '&s=' + $('#search_words').val() + (tagsSearch ? "&tag_id=" + tagsSearch : ''))
        })
    </script>  
@endsection

