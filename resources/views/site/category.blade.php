@extends('site.layouts.main')

@section('title', 'الاقسام')

@section('content')
@php
    $important_articles = App\Models\Important_article::all();
@endphp

@if ($important_articles->count() > 0)
<div class="news_slider" style="background: #FF00000F;display: flex;direction: rtl;padding: 10px;">
    <p style="white-space: nowrap;padding: 0px 1rem;border-left: 2px solid #c00;font-size: 20px;font-weight: 600;display: flex;align-items: center;">الاخبار العاجلة</p>
    <div class="ticker-wrap" style="width: 100%;">

        <div id="ticker" style="font-weight: 500;font-size: 19px;line-height: 36px;text-align: right;color: #000000;white-space: nowrap;">



            <div id="ticker-box" style="overflow: hidden; min-height: 40px;">
                <ul style="padding: 0px; margin: 0px; position: relative; list-style-type: none;">
                    
                    <li style="display: flex; justify-content: center; align-items: center; gap: 5px;    position: absolute; white-space: nowrap; right: -3543px; color: rgb(0, 0, 0);">
                        @foreach ($important_articles as $index => $important)
                          <a href="article/{{$important->article->id}}" style="text-decoration: none; color:rgb(0, 0, 0); display: inline-flex;justify-content: center; align-items: center;gap: 8px">
                              {{$important->article->title}} 
                              @if ($index + 1 !== $important_articles->count())
                              <img src="{{ asset("/site/imgs/logo_t.png")}}" alt="" style="width: 20px">
                              @endif
                            </a>
                        @endforeach
                    </li>
                </ul>
            </div>
            <script>startTicker('ticker-box', {speed: 1, delay:500});</script>
    
        </div>
        </div>
</div>
@endif
@if(isset($search_word) && $search_word)
<div class="container">
    <h1 style="margin: 1rem 0;text-align: right;">مقالات قسم: {{ $search_word}}</h1>
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
        $(".pagination_wrapper ul a").each(function() {
            $(this).attr('href', $(this).attr('href') + '&category_name=' + $('#search_words').val())
        })
    </script>  
@endsection

