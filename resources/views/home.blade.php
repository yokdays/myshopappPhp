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
                    <img src="{{ asset('storage/webimage/MEAT_WAY.png') }}" alt="" style="width: 70px"><span style="font-size:25px; padding-left: 1rem; font-weight: bold;">MEAT WAY</span>
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
                                    <a href="{{ route('orders.completed') }}" class="nav-link">ดูคำสั่งซื้อ</a>
                                </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
            สั่งได้ทั้งแบบรับที่ร้านหรือเดลิเวอรี<a href="shops"><div class="btn btn-danger">เริ่มสั่งอาหาร</div></a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/webimage/dddddd.png') }}" class="d-block w-100 carousel-img"
                                alt="...">
                            {{-- <img src="{{ asset('storage/webimage/item1.jpg') }}" class="d-block w-100 carousel-img"
                                alt="..."> --}}
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/webimage/asdsadasd.png') }}" class="d-block w-100 carousel-img"
                                alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/webimage/421321.png') }}" class="d-block w-100 carousel-img"
                                alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/webimage/77777.png') }}" class="d-block w-100 carousel-img"
                                alt="...">
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
                ค้นหาประเภทเมนู
                <div class="category-list">
                    <div class="item2">
                        <a href="shops#pig">
                            <div class="card h-100">
                                <img src="{{ asset('storage/webimage/porkl.jpg') }}" alt="" class="card-img-top w-100"
                                    style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    เนื้อหมู (Pork)
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item1">
                        <a href="shops#cow">
                            <div class="card h-100">
                                <img src="{{ asset('storage/webimage/unnamed.jpg') }}" alt="" class="card-img-top w-100"
                                    style="height: 600px; object-fit: cover;">
                                <div class="card-body">
                                    เนื้อวัว
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item3">
                        <a href="shops#chicken">
                            <div class="card h-100">
                                <img src="{{ asset('storage/webimage/22470333_s.jpg') }}" alt=""
                                    class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    เนื้อไก่
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item4">
                        <a href="shops#egg">
                            <div class="card h-100">
                                <img src="{{ asset('storage/webimage/egg.jpg') }}" alt="" class="card-img-top w-100"
                                    style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    ไข่ไก่
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item5">
                        <a href="shops#fish">
                            <div class="card h-100">
                                <img src="{{ asset('storage/webimage/qb.jpg') }}" alt="" class="card-img-top w-100"
                                    style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    เนื้อปลา
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item6">
                        <a href="shops#sheep">
                            <div class="card h-100">
                                <img src="{{ asset('storage/webimage/rack-of-lamb.jpg') }}" alt=""
                                    class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    เนื้อแกะ
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item7">
                        <a href="shops#duck">
                            <div class="card h-100">
                                <img src="{{ asset('storage/webimage/Photo-for-Website-19-3.jpg') }}" alt=""
                                    class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    เนื้อเป็ด
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item8">
                        <a href="shops#crocodile">
                            <div class="card h-100">
                                <img src="{{ asset('storage/webimage/1642582643_38572_1.jpg') }}" alt=""
                                    class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    เนื้อจระเข้
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item9">
                        <a href="shops">
                            <div class="card h-100">
                                <img src="{{ asset('storage/webimage/2323.png') }}" alt="" class="card-img-top w-100"
                                    style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    ดูเมนูทั้งหมด
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item10 mt-5" style="font-size: 1.5rem">
                        <span style="font-size: 2.5rem">MEAT WAY</span> - สั่งเนื้อสดใหม่ ส่งตรงถึงหน้าบ้านคุณ! 🥩🚀
                        <br>
                        🌟 สด สะอาด ได้มาตรฐาน - คัดสรรเนื้อคุณภาพเยี่ยมจากแหล่งผลิตที่ได้มาตรฐาน
                        เพื่อให้ทุกมื้อของคุณพิเศษกว่าที่เคย
                        <br>
                        🛒 ช้อปง่ายในคลิกเดียว - เลือกซื้อเนื้อวัว เนื้อหมู และเนื้อไก่สดใหม่ผ่าน MEAT WAY
                        ได้ทุกที่ทุกเวลา พร้อมรายละเอียดสินค้าและราคาชัดเจน
                        <br>
                        💳 สะดวก ปลอดภัย รองรับทุกการชำระเงิน - ชำระเงินผ่าน QR Code บัตรเครดิต/เดบิต
                        และโมบายแบงกิ้งได้ง่ายๆ
                        <br>
                        🚚 ส่งตรง รวดเร็ว ถึงมือคุณ - มีบริการจัดส่งถึงบ้านในเวลารวดเร็ว
                        มั่นใจได้ว่าเนื้อสดใหม่ทุกคำสั่งซื้อ
                        <br>
                        🔥 โปรโมชั่นสุดคุ้มทุกวัน - สมัครสมาชิกวันนี้! รับสิทธิพิเศษและส่วนลดมากมาย
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <footer>
        <div class="container">
            <div class="row justify-item-md-center" align="center">
                <div class="col"><img src="{{ asset('storage/webimage/MEAT_WAY.png') }}" alt="" style="width: 9.5rem"></div>
                <div class="col">12</div>
                <div class="col">12</div>
            </div>
        </div>
    </footer> --}}
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <!-- เกี่ยวกับร้าน -->
                <div class="col-md-3" align="center">
                    <img src="{{ asset('storage/webimage/MEAT_WAY.png') }}" alt="" style="width: 7.4rem">
                    <p>เนื้อสดใหม่ คัดคุณภาพ ส่งตรงถึงมือคุณ</p>
                </div>
    
                <!-- เมนูลัด -->
                <div class="col-md-3">
                    <h5>เมนูลัด</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">หน้าหลัก</a></li>
                        <li><a href="#" class="text-light text-decoration-none">สินค้า</a></li>
                        <li><a href="#" class="text-light text-decoration-none">โปรโมชั่น</a></li>
                        <li><a href="#" class="text-light text-decoration-none">ติดต่อเรา</a></li>
                    </ul>
                </div>
    
                <!-- ช่องทางการติดต่อ -->
                <div class="col-md-3">
                    <h5>ติดต่อเรา</h5>
                    <p>📍 123 ถนนสายเนื้อ เมืองกรุงเทพ</p>
                    <p>📞 098-765-4321</p>
                    <p>✉️ support@meatway.com</p>
                </div>
    
                <!-- โซเชียลมีเดีย -->
                <div class="col-md-3">
                    <h5>ติดตามเรา</h5>
                    <a href="#" class="text-light me-2"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-light me-2"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-light me-2"><i class="fab fa-line fa-lg"></i></a>
                </div>
            </div>
    
            <hr class="bg-light">
            <div class="text-center">
                <p class="mb-0">© 2025 MEAT WAY. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- FontAwesome CDN (สำหรับไอคอนโซเชียลมีเดีย) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    
</body>
<button onclick="scrollToTop()" id="goToTopBtn" class="btn btn-danger rounded-circle shadow" title="กลับไปด้านบน">
    ^
</button>
<script>
    // เมื่อ Scroll ลงให้แสดงปุ่ม
    window.onscroll = function () {
        let button = document.getElementById("goToTopBtn");
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    };

    // เมื่อกดปุ่ม ให้เลื่อนขึ้นไปบนสุด
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>