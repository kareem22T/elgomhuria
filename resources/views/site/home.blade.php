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
@php
$more_visited = App\Models\Visit::with(['article' => function ($query) {
    $query->where('isDraft', false);
}])
->orderBy('total_visits', 'desc')
->take(4)
->get();
@endphp

<main class="home">
    <div class="container">
        <div class="col-1">
            @if ($ads)                
                <div class="ad_wrapper">
                    <section class="ad">
                        @if ($ads->main_ad)
                        <img src="{{ '/images/uploads/ads/' . $ads->main_ad }}" alt="">
                        @endif
                    </section>
                </div>
            @endif
            <section class="latest">
                <div class="cat-head">
                    <div class="cat">
                        الاحدث                    
                    </div>
                    <span></span>
                </div>
                @if($latestArticles && count($latestArticles) > 0)
                    @foreach ($latestArticles as $article)
                        <a href="article/{{$article->id}}" class="card">
                            <p>
                                {{ $article->title }}
                            </p>
                            <div class="img">
                                <img src="{{ $article->thumbnail_path }}" alt="">
                            </div>
                        </a>
                    @endforeach
                @endif
                @if($more_visited && $more_visited->count() > 3)
                <div class="cat-head" style="margin-top: 30px;">
                    <div class="cat">
                        الاكثر قراءة                    
                    </div>
                    <span></span>
                </div>
                @foreach ($more_visited as $visit)
                    {{-- Check if the associated article exists --}}
                    @if($visit->article)
                        <a href="article/{{ $visit->article->id }}" class="card">
                            <p>
                                {{ $visit->article->title }}
                            </p>
                            <div class="img">
                                <img src="{{ $visit->article->thumbnail_path }}" alt="">
                            </div>
                        </a>
                    @endif
                @endforeach
            @endif
            </section>
        </div>
        <div class="col-2">
            @php
                $main_articles = App\Models\Home_article::all();
            @endphp
            @if ($main_articles->count() > 0)
            <div class="swiper mainSwiper">
                <div class="swiper-wrapper">
                    @foreach ($main_articles as $item)   
                    @php
                        $main_article = App\Models\Article::find($item->article_id);
                    @endphp                     
                    <a href="/article/{{$main_article->id}}" target="_blanck" class="swiper-slide">
                        <div class="thumbnail">
                            <img src="{{$main_article->thumbnail_path}}" alt="">
                        </div>
                        <div class="text">
                            <h2>{{ $main_article->title }}</h2>
                            <h2 class="sub-title">{{ $main_article->sub_title }}</h2>
                            <p>
                                <span>للكاتب: {{$main_article->author_name}}</span><br>
                                {{Illuminate\Support\Str::limit($main_article->intro, 195)}}
                            </p>
                            
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="mainSwiper-swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
                <div class="mainSwiper-swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
                <div class="mainSwiper-swiper-pagination"></div>
            </div>
            @endif
            @if ($ads)                
                <div class="ad_wrapper main_ad">
                    <section class="ad">
                        @if ($ads->main_ad)
                        <img src="{{ '/images/uploads/ads/' . $ads->main_ad }}" alt="">
                        @endif
                    </section>
                </div>
            @endif


            <section class="categories">
                @if ($categories_per_home && count($categories_per_home )> 0)
                    @foreach ($categories_per_home as $index => $category)                            
                        <div class="swiper catSwiper">
                            <div class="swiper-wrapper">
                                @foreach ($category->articles as $article)
                                    <a href="article/{{$article->id}}" class="swiper-slide">
                                        <div class="thumbnail">
                                            <img src="{{ $article->thumbnail_path }}" alt="">
                                        </div>
                                        <div class="text">
                                            <div class="cat-head">
                                                <span></span>
                                                <div class="cat">
                                                    {{$category->main_name}}                    
                                                </div>
                                            </div>
                                            <p dir="rtl">
                                                {{Illuminate\Support\Str::limit($article->title, 85)}}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="navYpag">
                                <div class="mainSwiper-swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
                                <div class="mainSwiper-swiper-pagination"></div>
                                <div class="mainSwiper-swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
                            </div>
                        </div>
                        @if ($ads && $index == 1)                
                            <div class="ad_wrapper" style="margin-bottom: 1rem">
                                <section class="ad">
                                    @if ($ads->mobile_ad_1)
                                    <img src="{{ '/images/uploads/ads/' . $ads->mobile_ad_1 }}" alt="">
                                    @endif
                                </section>
                            </div>
                        @endif        
                    @endforeach
                @endif
            </section>
            @if ($ads)                
                <div class="ad_wrapper">
                    <section class="ad">
                        @if ($ads->mobile_ad_2)
                        <img src="{{ '/images/uploads/ads/' . $ads->mobile_ad_2 }}" alt="">
                        @endif
                    </section>
                </div>
            @endif
            <section class="latest">
                <div class="cat-head">
                    <div class="cat">
                        الاحدث                    
                    </div>
                    <span></span>
                </div>
                @if($latestArticles && count($latestArticles) > 0)
                    @foreach ($latestArticles as $article)
                        <a href="article/{{$article->id}}" class="card">
                            <p>
                                {{ $article->title }}
                            </p>
                            <div class="img">
                                <img src="{{ $article->thumbnail_path }}" alt="">
                            </div>
                        </a>
                    @endforeach
                @endif
                @if($more_visited && $more_visited->count() > 3)
                <div class="cat-head" style="margin-top: 30px;">
                    <div class="cat">
                        الاكثر قراءة                    
                    </div>
                    <span></span>
                </div>
                @foreach ($more_visited as $visit)
                    {{-- Check if the associated article exists --}}
                    @if($visit->article)
                        <a href="article/{{ $visit->article->id }}" class="card">
                            <p>
                                {{ $visit->article->title }}
                            </p>
                            <div class="img">
                                <img src="{{ $visit->article->thumbnail_path }}" alt="">
                            </div>
                        </a>
                    @endif
                @endforeach
                @endif
            </section>
            @if ($ads)                
                <div class="ad_wrapper">
                    <section class="ad">
                        @if ($ads->mobile_ad_3)
                        <img src="{{ '/images/uploads/ads/' . $ads->mobile_ad_3 }}" alt="">
                        @endif
                    </section>
                </div>
            @endif
        </div>
        @if($ads)
        <div class="col-3">
            <div class="ad_wrapper">
                <section class="ad">
                    @if ($ads->ad_1)
                        <img src="{{ '/images/uploads/ads/' . $ads->ad_1 }}" alt="">
                    @endif
                </section>
            </div>
            <div class="ad_wrapper">
                <section class="ad">
                    @if ($ads->ad_2)
                        <img src="{{ '/images/uploads/ads/' . $ads->ad_2 }}" alt="">
                    @endif
                </section>
            </div>
            <div class="ad_wrapper">
                <section class="ad">
                    @if ($ads->ad_3)
                        <img src="{{ '/images/uploads/ads/' . $ads->ad_3 }}" alt="">
                    @endif
                </section>
            </div>
        </div>
        @endif
    </div>
</main>
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
    var swiper = new Swiper(".mainSwiper", {
      navigation: {
        nextEl: ".mainSwiper-swiper-button-next",
        prevEl: ".mainSwiper-swiper-button-prev",
      },
      spaceBetween: 30,
      pagination: {
        el: ".mainSwiper-swiper-pagination",
      },
    });
    var swiper = new Swiper(".catSwiper", {
      navigation: {
        nextEl: ".mainSwiper-swiper-button-next",
        prevEl: ".mainSwiper-swiper-button-prev",
      },
      spaceBetween: 30,
      pagination: {
        el: ".mainSwiper-swiper-pagination",
      },
    });
</script>
@endsection