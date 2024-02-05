<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/libs/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/fontawsome.css') }}">
    <script src="{{ asset('/libs/tricker.js') }}?v={{time()}}"></script>
    {{-- sadfsadf --}}
    <link rel="stylesheet" href="{{ asset('/site/css/main.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset("/site/imgs/logo_t.png")}}" type="image/x-icon">
    <style>
    .loader {
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        justify-content: center;
        align-items: center;
        z-index: 99999999999999999999999999999;
        backdrop-filter: blur(1px);
        display: flex;
        background: white !important
        }
        .custom-loader {
        --d:22px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        color: #ff3100;
        box-shadow: 
            calc(1*var(--d))      calc(0*var(--d))     0 0,
            calc(0.707*var(--d))  calc(0.707*var(--d)) 0 1px,
            calc(0*var(--d))      calc(1*var(--d))     0 2px,
            calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
            calc(-1*var(--d))     calc(0*var(--d))     0 4px,
            calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
            calc(0*var(--d))      calc(-1*var(--d))    0 6px;
        animation: s7 1s infinite steps(8);
        }

        @keyframes s7 {
        100% {transform: rotate(1turn)}
        }

        #errors {
            position: fixed;
            top: 190px;
            right: 1.25rem;
            display: flex;
            flex-direction: column;
            max-width: calc(100% - 1.25rem * 2);
            gap: 1rem;
            z-index: 99999999999999999999;

            }
            #errors >* {
            width: 100%;
            color: #fff;
            font-size: 1.1rem;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            }

            #errors .error {
            background: #e41749;
            }
            #errors .success {
            background: #12c99b;
            }

    </style>
    <title>الجمهورية الجديدة | @yield('title')</title>
</head>
<body>
    <div class="loader" style="background-color: #fff;">
        <div class="custom-loader"></div>
    </div>
    <div id="errors"></div>
    @include('site.includes.header')
    @yield('content')
    @include('site.includes.footer')
    <script src="{{ asset('/libs/vue.js') }}"></script>
    <script src="{{ asset('/libs/jquery.js') }}"></script>
    <script src="{{ asset('/libs/axios.js') }}"></script>
    <script src="{{ asset('/libs/swiper.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".more .show_left_nav, .hide-content").on("click", function (e) {
                e.preventDefault()
                if ($(".more .links").is(":visible")) {
                    $(".more .links, .hide-content").addClass("animate__slideOutRight").fadeOut()
                    $(".more .links, .hide-content").removeClass("animate__slideInRight")
                }
                else {
                    $(".more .links, .hide-content").addClass("animate__slideInRight").fadeIn()
                    $(".more .links, .hide-content").removeClass("animate__slideOutRight")
                }
            })
        });
    </script>
    <script>
        const { createApp, ref } = Vue
        
        createApp({
            data() {
                return {
                    showSuggesstion: false,
                    user: null,
                    search: '',
                    showSearchPopUp: false,
                    cart: null,
                    quantities: {},
                    total: 0,
                    products_cart: null,
                    cards_cart: null,
                    results: null,
                    products: null,
                    cards: null,
                    lang: "en",
                    page_data: null,
                    showLangMore: false,
                    categories: null,
                    categoriesWithSub: null,
                    referral_code: null
                }
            },
            methods: {
                async getSugesstions() {
                    try {
                        const response = await axios.post(`/admin/articles/search?search_words=${this.search}`,
                        );
                        if (response.data.status === true) {
                            this.products = response.data.data.data
                            this.results = this.products

                        } else {
                            this.results = null
                        }

                    } catch (error) {
                        document.getElementById('errors').innerHTML = ''
                        let err = document.createElement('div')
                        err.classList = 'error'
                        err.innerHTML = 'server error try again later'
                        document.getElementById('errors').append(err)
                        $('#errors').fadeIn('slow')
                        $('.loader').fadeOut()

                        setTimeout(() => {
                            $('#errors').fadeOut('slow')
                        }, 3500);

                        console.error(error);
                    }
                },
                goToSearch() {
                    window.location.href = `/search?s=${this.search}`
                }
            },
            created() {
            },
        }).mount('#header_wrapper')
    </script>
        <script>
        $('.loader').fadeOut()

        </script>
    @yield('scripts')
</body>
</html>