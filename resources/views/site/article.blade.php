@extends('site.layouts.main')

@section('title', $article ? $article->title : '404')

@section('content')
@if ($article)
<link rel="stylesheet" href="{{ asset('/libs/css/swiperadmin.css') }}?v={{ time() }}" />

<style>
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
                    <span>للكاتب: {{ $article->author_name }}</span> <br>
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
