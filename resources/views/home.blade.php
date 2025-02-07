<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MEAT WAY</title>
    <link href="{{ asset('scss/app.scss') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://www.sirinfarm.com/wp-content/uploads/2021/07/shutterstock_1021135813-scaled-1.jpg"
                        alt="" style="width: 100px"> MEAT WAY
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">หน้าแรก</a>
                            </li>

                            @if (Auth::user()->type == 1)
                                <!-- เงื่อนไขสำหรับ Admin -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products.index') }}">จัดการสินค้า</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products.order') }}">คำสั่งซื้อทั้งหมด</a>
                                </li>
                            @else
                                <!-- เงื่อนไขสำหรับ User -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('shops.index') }}">ร้านค้า</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('orders.index') }}">ตระกร้าสินค้า
                                        {{ $cartItemCount ?? 0 }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('orders.completed') }}"
                                        class="btn btn-primary">ดูคำสั่งซื้อที่สำเร็จ</a>
                                </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="home-border">
            LET'S ORDER FOR PICK UP OR DELIVERY<div class="btn btn-danger">Start Order</div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://www.sirinfarm.com/wp-content/uploads/2021/07/shutterstock_1021135813-scaled-1.jpg"
                                class="d-block w-100 carousel-img" alt="...">
                            {{-- <img src="{{ asset('storage/webimage/item1.jpg') }}" class="d-block w-100 carousel-img" alt="..."> --}}
                        </div>
                        <div class="carousel-item">
                            <img src="https://www.thailand.aussiebeefandlamb.com/contentassets/9f69e615043243818901991acb23d773/imagen49m7.png"
                                class="d-block w-100 carousel-img" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                class="d-block w-100 carousel-img" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="category">
                BROWSE MENU CATEGORIES
                <div class="category-list">
                    <div class="item1">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 600px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                    <div class="item2">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                    <div class="item3">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                    <div class="item4">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                    <div class="item5">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                    <div class="item6">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                    <div class="item7">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                    <div class="item8">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                    <div class="item9">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                    <div class="item10">
                        <div class="card h-100">
                            <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg"
                                alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                Promotion
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="item">

                    </div>
                </div>
            </div>
        </div>
</body>
