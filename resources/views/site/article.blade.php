@extends('site.layouts.main')

@section('title', $article ? $article->title : '404')

@section('content')
@php
    $important_articles = App\Models\Important_article::all();
@endphp
@if ($important_articles->count() > 0)
<div class="news_slider" style="background: #FF00000F;display: flex;direction: rtl;padding: 10px;">
    <p style="white-space: nowrap;padding: 0px 1rem;border-left: 2px solid #c00;font-size: 20px;font-weight: 600;display: flex;align-items: center;">عاجل</p>
    <div class="ticker-wrap" style="width: 100%;">

        <div id="ticker" style="font-weight: 500;font-size: 19px;line-height: 36px;text-align: right;color: #000000;white-space: nowrap;">



            <div id="ticker-box" style="overflow: hidden; min-height: 40px;">
                <ul style="padding: 0px; margin: 0px; position: relative; list-style-type: none;">
                    
                    <li style="display: flex; justify-content: center; align-items: center; gap: 5px;    position: absolute; white-space: nowrap; right: -3543px; color: rgb(0, 0, 0);">
                        @foreach ($important_articles as $index => $important)
                          <a href="/article/{{$important->article->id}}" style="text-decoration: none; color:rgb(0, 0, 0); display: inline-flex;justify-content: center; align-items: center;gap: 12px;margin-right: 12px">
                              {{$important->article->title}} 
                              @if ($index + 1 !== $important_articles->count())
                              <img src="{{ asset("/site/imgs/logo_t.png")}}" alt="" style="width: 20px">
                              @endif
                            </a>
                        @endforeach
                    </li>
                </ul>
            </div>
            <script>
              var isMobile = window.innerWidth <= 767;
              if (isMobile)
                  startTicker('ticker-box', {speed: 16, delay:500});
              else
                  startTicker('ticker-box', {speed: 1, delay:500});
          </script>
  
        </div>
        </div>
</div>
@endif

@if ($article)
@section("heads")
<meta property="og:title" content="{{ $article->title }}">
<meta property="og:description" content="{{ $article->content }}">
<meta property="og:image" content="{{ "https://elgomhuriaeljadida.com" . $article->thumbnail_path }}">
<meta property="og:locale" content="ar_Ar">
<meta property="og:type" content="article">
@endsection

<link rel="stylesheet" href="{{ asset('/libs/css/swiperadmin.css') }}?v={{ time() }}" />

<style>
  article p {
    display: flex !important;
    flex-wrap: wrap !important;
    line-height: 1.5 !important;
  }
  article span {
    display: flex !important;
    flex-wrap: wrap !important;
    line-height: 1.5 !important;
  }
  iframe {
    width: 100% !important;
  }
    main swiper-container {
        direction: rtl;
        width: 630px !important;
        max-width: 100% !important;
        padding-bottom: 0;
        padding: 0 !important
    }
    main swiper-slide {
        margin: 0 8px !important;
        margin-bottom: 2rem !important
    }
    main .swiper-pagination-bullet {
      background-color: #b10a0b !important;
      bottom: 0;
    }
    .swiper-horizontal > .swiper-pagination-bullets, .swiper-pagination-bullets.swiper-pagination-horizontal, .swiper-pagination-custom, .swiper-pagination-fraction {
      bottom: 0 !important;
    }
    main swiper-slide:first-child {
        margin-left: 0 !important
    }
    main swiper-slide:last-child {
        margin-right: 0 !important
    }
    main swiper-slide img {
        object-fit: fill !important;
        height: max-content !important;
        width: 100% !important;
        border-radius: 10px
    }
    @media (max-width: 1199.98px) {
      main swiper-container
      {
        direction: rtl;
        width: 580px !important;
        padding-bottom: 0;
      }
    }
    @media (max-width: 992.98px) {
      main swiper-container
      {
        direction: rtl;
        width: 415px !important;
        padding-bottom: 0;
      }
    }
    @media (max-width: 992.98px) {
      main swiper-container
      {
        direction: rtl;
        width: 415px !important;
        max-width: 100% !important;
        padding-bottom: 0;
      }
    }
</style>
<main class="aritcle">
    <div class="container">
      @php
          $main_articles = App\Models\Home_article::all();
      @endphp

        <section class="article">
            <aside>
              <h1>اهم عناوين الاخبار</h1>
              <div class="links">
                @foreach ($main_articles as $item)   
                @php
                    $main_article = App\Models\Article::find($item->article_id);
                @endphp                     
                  <a href="/article/{{$main_article->id}}" target="_blanck" class="swiper-slide">
                    {{Illuminate\Support\Str::limit($main_article->title, 100)}}
                  </a>
                @endforeach
              </div>
              <a href="" class="show_more_article">المزيد</a>
            </aside>
            <article>
                <h1>{{ $article->title }}</h1>
                <h1 class="sub_title" style="font-weight: 500;font-size: 15px;line-height: 26px;margin-top: -10px;">{{ $article->sub_title }}</h1>
                <div class="thumbnail">
                    <img src="{{ $article->thumbnail_path }}" alt="">
                </div>
                <h4>{{ $article->category->main_name }}</h4>
                <p>
                    <span>كتب: {{ $article->author_name }}</span> <br>
                    {!! $article->content !!}
                </p>
                @if($article->tags && $article->tags->count() > 0)
                <h3 style="width: 100%; font-weight: 500;direction: rtl">الكلمات المفتاحية:</h3>
                <div class="tags">
                  @foreach ($article->tags as $tag)
                      <a href="/search?s={{$tag->name}}&tag_id={{$tag->id}}">{{ $tag->name }}</a>
                  @endforeach
                </div>
                <br>
                @endif
            </article>
            @php
                $ads = App\Models\Ad::all()->first();
            @endphp
            @if ($ads)                
                  <div class="ad_wrapper" style="margin-bottom: 1rem">
                      <section class="ad">
                          @if ($ads->ad_1)
                          <img src="{{ '/images/uploads/ads/' . $ads->ad_1 }}" alt="">
                          @endif
                      </section>
                  </div>
              @endif        
      </section>
    </div>
</main>
@endif

@php
  $latestArticles = App\Models\Article::where("isDraft", false)->latest()->take(4)->get();
@endphp
@php
$more_visited = App\models\Visit::with(['article' => function($query) {
  $query->where('isDraft', false);
}])->orderby('total_visits', 'desc')->take(4)->get();
@endphp
@if($latestArticles)
<main class="category">
  <h1 style="text-align: center">احدث المقالات</h1>
    <div class="container">
        @foreach ($latestArticles as $article)
            <a href="/article/{{$article->id}}" class="article">
                <img src="{{$article->thumbnail_path}}" alt="">
                <span>
                    {{ $article->title }}
                </span>
            </a>
        @endforeach
    </div>
</main>
@endif
@if($more_visited && $more_visited->count() > 3)
<main class="category">
  <h1 style="text-align: center">الاكثر قراءة</h1>
    <div class="container">
        @foreach ($more_visited as $article)
          @if ($article->article)
              
            <a href="/article/{{$article->id}}" class="article">
              <img src="{{$article->article->thumbnail_path}}" alt="">
              <span>
                {{ $article->article->title }}
              </span>
            </a>
          @endif
        @endforeach
    </div>
</main>
@endif

@endsection

@section('scripts')
<script src="{{ asset('/libs/swiperadmin.js') }}"></script>

    <script>
        $(function () {
            setTimeout(() => {
                $('.mySwiper').attr('pagination', 'true');
            }, 500);
        })
    </script>
    <script>
        const swiperEl = document.querySelector('swiper-container')
        Object.assign(swiperEl, {
        slidesPerView: 1,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            575: {
                slidesPerView: 2,
            },
        },
        });
        swiperEl.initialize();
  </script>
@endsection
