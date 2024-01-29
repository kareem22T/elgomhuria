@php
    $categories = App\Models\Category::all();
@endphp

<header id="header_wrapper">
    <div class="container">
        <div>
            <button @click="showSearchPopUp = true"><i class="fa fa-search"></i></button>
            <p>
                <span>رئيس مجلس أدارة</span> <br>
                <span>حسام البحيري</span><br>
                <span>رئيس التحرير</span><br>
                <span>{{ App\Models\Editor_master::first() && App\Models\Editor_master::first()->name ? App\Models\Editor_master::first()->name : "لم يحدد بعد"}}</span><br>
            </p>
        </div>
        <div>
            <a href="{{ route('site.home') }}"><img src="{{ asset('/dashboard/images/logo.png') }}" alt="logo"></a>
        </div>
        <div>
            <div class="social">
                <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                <a href=""><i class="fa-brands fa-x-twitter"></i></a>
                <a href=""><i class="fa-brands fa-linkedin-in"></i></a>
                <a href=""><i class="fa-brands fa-whatsapp"></i></a>
            </div>
            <div class="more">
                <button class="show_left_nav"><i class="fa fa-bars"></i></button>
                <div class="links animate__animated">
                    @foreach ($categories as $category)
                    <a href="/category/{{$category->id}}">{!! $category->icon !!} {{ $category->main_name }} </a>
                    @endforeach
                </div>        
            </div>
        </div>
    </div>
    <div class="hide-content"></div>
    <div class="hide-content" v-if="showSearchPopUp" :style="showSearchPopUp ? 'display: block' : ''"></div>
    <div class="pop-up search-pop-up" dir="rtl" v-if="showSearchPopUp" style="top: calc(clamp(3.125rem, calc(1.7314rem + 5.9459vw), 6.5625rem) + 20px) !important;border-radius: 0;">
        <div class="input-search">
            <input type="text" name="search" id="search" placeholder="ابحث عن مقالات" v-model="search" @keyup="getSugesstions()" @keyup.enter="goToSearch" @focus="showSuggesstion = true" @blur="showSuggesstion = false">
            <i class="fa fa-search" style="cursor: pointer" @click="goToSearch"></i>
            <div class="suggestions suggestions2" v-if="results && results.length">
                <a :href="`/article/${item.id}`" v-for="item in results.slice(0, 5)" :key="item.id" @click="showSearchPopUp = false">@{{ item.title }}</router-link>
                <a :href="`/search?s=${this.search}`" style="text-align: center !important; font-weight: 600 !important">عرض الكل</a>
            </div>
        </div>
        <button @click="showSearchPopUp = false; this.search = ''">الغاء</button>
    </div>
</header>
<div class="mobile-social">
    <a href=""><i class="fa-brands fa-facebook-f"></i></a>
    <a href=""><i class="fa-brands fa-x-twitter"></i></a>
    <a href=""><i class="fa-brands fa-linkedin-in"></i></a>
    <a href=""><i class="fa-brands fa-whatsapp"></i></a>
</div>

<p class="mobile-paragraph">
    <span>رئيس مجلس أدارة: حسام البحيري</span>
    <span>رئيس التحرير: {{ App\Models\Editor_master::first() && App\Models\Editor_master::first()->name ? App\Models\Editor_master::first()->name : "لم يحدد بعد"}}</span>
</p>

