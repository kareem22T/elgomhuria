@php
    $categories = App\Models\Category::all();
@endphp
<section class="categories">
    <div class="container">
        <h1>اقرأ المزيد من جميع الاقسام</h1>
        <div class="links">
            @foreach ($categories as $category)
                <a href="/category/{{$category->id}}">{{ $category->main_name }} -</a>
            @endforeach
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <p>
            نهتم بكل أخبار المدن الجديدة مثل 
            <br>
            مدينتي - الرحاب - الشروق - التجمع - العاصمة الإدارية  - مدينة الجلالة - العلمين - مدينة سلام مصر - مدينة بدر - مدينة برج العرب الجديدة - مدينة السادس من أكتوبر -  الشيخ زايد - العاشر من رمضان  - السويس الجديدة - الإسماعيلية الجديدة  - الفيوم الجديدة  - القاهرة الجديدة  - الصالحية الجديدة  - بني سويف الجديدة  - توشكى الجديدة  - طيبة الجديدة  - مدينة السادات - مدينة ناصر الجديدة  - سوهاج الجديدة - مشروع دهشور - سفنكس الجديدة - الضبعه - الأسمرات الجديده  - العبور  - المنصوره الجديده  - نور  - المستقبل  - حدائق الأهرام 
        </p>
        <p dir="rtl">
            حقوق الطبع والنشر محفوظة لدى
            <span>Post Production</span> 
            للدعاية والإعلان والتسويق الإلكتروني
            <br>
             للتواصل:
            01000680569 - 
            01000680596
        </p>
    </div>
</footer>