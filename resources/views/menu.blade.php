@extends('layouts.app')

@push('style')
    <style>
        .swiper {
            /* height: 200px; */
        }

        .swiper-slide {
            width: fit-content;
            max-width: 120px !important;
            height: fit-content !important;
            text-align: center;
        }

        .category-img {
            width: 80px;
            height: auto;
            object-fit: cover;
        }

        main {
            max-width: 475px;
            margin: auto;
        }
    </style>

    <style>
        .accordion-header {
            background-color: #f8f9fa;
        }

        .accordion-button {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .accordion-button:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
        }

        .category-icon {
            object-fit: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            object-fit: cover;
            height: 150px;
        }

        .price {
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background-color: #4d869c;
            border: none;
        }

        .btn-primary:hover {
            background-color: #7ab2b2;
        }
    </style>

    <style>
        #contact img {
            max-width: 100%;
            height: auto;
        }

        section#contact {
            padding: 60px 0;
            /* min-height: 100vh;*/
        }

        #contact ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .contact-area {
            border-bottom: 1px solid #353C46;
        }

        .contact-content p {
            font-size: 15px;
            margin: 30px 0 60px;
            position: relative;
        }

        .contact-content p::after {
            background: #353C46;
            bottom: -30px;
            content: "";
            height: 1px;
            left: 50%;
            position: absolute;
            transform: translate(-50%);
            width: 80%;
        }

        .contact-content h6 {
            color: #8b9199;
            font-size: 15px;
            font-weight: 400;
            margin-bottom: 10px;
        }

        .contact-content span {
            color: #353c47;
            margin: 0 10px;
        }

        .contact-social {
            margin-top: 30px;
        }

        .contact-social>ul {
            display: inline-flex;
        }

        .contact-social ul li a {
            border: 1px solid #8b9199;
            color: #8b9199;
            display: inline-block;
            height: 40px;
            margin: 0 10px;
            padding-top: 7px;
            transition: all 0.4s ease 0s;
            width: 40px;
        }

        .contact-social ul li a:hover {
            border: 1px solid #FAB702;
            color: #FAB702;
        }

        .contact-content img {
            max-width: 210px;
        }

        section#contact,
        footer {
            background: #1A1E25;
            color: #868c96;
        }

        footer p {
            padding: 40px 0;
            text-align: center;
        }

        footer img {
            width: 44px;
        }
    </style>
@endpush

@section('content')
    <div class="menu-page">
        <header>
            <div class="container">
                <div class="img-cont mx-auto">
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="" class="logo img-fluid">
                </div>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="categories">
                    <!-- Swiper -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @if ($menu)
                                @foreach ($menu as $index => $category)
                                    <div class="swiper-slide">
                                        <div
                                            class="category p-2 border border-1 rounded-1 d-flex flex-column align-items-center justify-content-center">
                                            <a href="#heading{{ $index }}" class=" text-decoration-none">
                                                <div class="img-cont mx-auto">
                                                    <img src="{{ asset('storage/' . $category['image']) }}" alt=""
                                                        class="category-img img-fluid">
                                                </div>
                                                <p class="category-name">
                                                    {{ $category['name'] }}
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h1 class="text-center mx-auto">
                                    No Categories Found
                                </h1>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="menu-cont my-5">
                    <div class="accordion shadow-lg rounded" id="menuAccordion">
                        @if ($menu)
                            @foreach ($menu as $index => $category)
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button
                                            class="accordion-button bg-light text-dark fw-bold {{ $index == 0 ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            <i class="fa fa-plus category-icon me-3 rounded-circle border"
                                                style="width: 50px; height: 50px;">
                                            </i>
                                            {{ $category['name'] }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}"
                                        class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $index }}" data-bs-parent="#menuAccordion">
                                        <div class="accordion-body bg-white px-4 py-3">
                                            <div class="row gy-4">
                                                @foreach ($category['products'] as $product)
                                                    <div class="col-md-6">
                                                        <div class="card shadow-sm h-100 border-0">
                                                            @if ($product->image != null && file_exists(public_path('storage/' . $product['image'])))
                                                                <img src="{{ asset('storage/' . $product['image']) }}"
                                                                    class="card-img-top rounded-top"
                                                                    alt="{{ $product['name'] }}">
                                                            @endif
                                                            <div class="card-body">
                                                                <h5 class="card-title fw-bold text-dark">
                                                                    {{ $product['name'] }}
                                                                </h5>
                                                                <p class="card-text text-muted small mb-3">
                                                                    {{ $product['description'] }}</p>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <span
                                                                        class="price text-success fw-bold fs-5">${{ number_format($product['price'], 2) }}</span>
                                                                    <button class="btn btn-primary btn-sm">Order
                                                                        Now</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1 class="text-center mx-auto p-3">
                                No Food Items
                            </h1>
                        @endif
                    </div>
                </div>

            </div>

        </main>
        <section class="contact-area" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="contact-content text-center">
                            <a href="#">
                                <img src="{{ asset('storage/' . $settings->logo) }}" width="100px" class="text-white"
                                    alt="logo">
                            </a>
                            <h6 class="mt-3">{{ $settings->address }}</h6>
                            <h6>{{ $settings->phone }}</h6>
                            <div class="contact-social">
                                <ul>
                                    <li><a class="hover-target" href="{{ $settings->facebook }}"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="hover-target" href="{{ $settings->instagram }}"><i
                                                class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <p>Copyright &copy; 2024 All Rights Reserved.
            </p>
        </footer>
    </div>
@endsection

@push('scripts')
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            spaceBetween: 10,
            grabCursor: true,
        });
    </script>
@endpush
