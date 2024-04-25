<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <title>DEBT-BOOK</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('asset/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    {{--    for bootsrap--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Libraries Stylesheet -->
    <link href="{{asset('asset/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />
    <!-- font awesome link for icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">
    @yield('head')
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">  @lang('message.Loading').</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="{{route('admin.index')}}" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa-solid fa-cart-plus"></i> <i class="fa-solid fa-book"></i></h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
            </div>
            <div class="navbar-nav w-100">


                <a href="{{url('costumer')}}" class="nav-item nav-link active"><i class="fa-solid fa-users me-2"></i>@lang('message.customers')</a>
                <a href="{{url('debt')}}" class="nav-item nav-link active"><i class="fa-solid fa-cart-shopping me-2"></i></i>@lang('message.debt')</a>
                <a href="{{url('payment')}}" class="nav-item nav-link active"><i class="fa-solid fa-money-bill-1-wave me-2"></i>@lang('message.payment')</a>

                @if(auth()->user()->hasRole('admin'))
                    <a href="{{url('statistics')}}" class="nav-item nav-link active"><i class="fa-solid fa-chart-line me-2"></i>@lang('message.statistics')</a>

                    <a href="{{route('admin.index')}}" class="nav-item nav-link active" style="text-align: center"><i class="fa solid fa-user me-2"></i>@lang('message.list')</a>
                @endif
                <a href="{{route('admin.message')}}" class="nav-item nav-link active"><i class="fa-solid fa-message me-2"></i>@lang('message.xabar')</a>

            </div>

        </nav>
    </div>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="#" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4" method="get" action="{{ route('admin.search') }}" style="align-items: center">
            <div class="form-group mt-3 mr-2 " style="width: 180px; display: inline-block;align-items: center; ">
                <select name="context" class="form-control" style="align-items: center">
                    <option value="costumers">@lang('message.customers')</option>
                    <option value="debts">@lang('message.debt')</option>
                    <option value="payments">@lang('message.payment')</option>
                    @if(auth()->user()->hasRole('admin')) <option value="permissions">@lang('message.list')</option> @endif
                    <option value="messages">@lang('message.xabar')</option>
                    <option value="last_weeks">@lang('message.last_week')</option>
                </select>
            </div>
                <input class="form-control border-0" type="search" placeholder="@lang('message.search')" name="search" style="width: 150px;">
                <button class="btn btn-outline-success ml-3 " type="submit">@lang('message.search')</button>
            </form>

{{--            <div class="container">--}}
{{--                <div class="search">--}}
{{--                    <input type="search" name="search" id="search" placeholder="Search" class="form-control ml-4"--}}
{{--                    style="--}}
{{--                    width: 100%;--}}
{{--                    text-align: center;--}}
{{--                    padding-top: 15px;--}}
{{--                    padding-bottom: 15px;--}}
{{--                    "--}}
{{--                    >--}}

{{--                </div>--}}
{{--            </div>--}}


{{--            Tilni tanlash uchun--}}

            <div class="navbar-nav align-items-center ms-auto" style="">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="float: right;">
                        <i class="fa fa-language me-lg-2"></i>
                        <span class="d-none d-lg-inline-flex">@lang('message.language')</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="{{route('lang.switch', ['lang' => 'uz'])}}" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">Uzbek</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="{{route('lang.switch', ['lang' => 'en'])}}" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">English</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="{{route('lang.switch', ['lang' => 'ru'])}}" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">Russian</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="navbar-nav align-items-center ms-auto">

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="{{asset('asset/img/adminimage.png')}}" alt="" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex">{{auth()->user()->name}}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="route('logout')"
                               onclick="event.preventDefault();
                this.closest('form').submit();" class="dropdown-item">
                                <i class="icon-key"></i>
                                <span class="ml-2">@lang('message.logout') </span>
                            </a>
                            <a href="{{route('account')}}" class="dropdown-item">@lang('message.myprofile')</a>

                        </form>
                    </div>


                </div>
            </div>
        </nav>
        <!-- Navbar End -->



        @yield('content')

        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded-top p-4">
                <div class="row">

                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>
    <!-- Content End -->


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('asset/lib/chart/chart.min.js')}}"></script>
<script src="{{asset('asset/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('asset/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('asset/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('asset/lib/tempusdominus/js/moment.min.js')}}"></script>
<script src="{{asset('asset/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
<script src="{{asset('asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

{{--    simple money frmat for numbers by jquery--}}
    <script src="//code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="{{asset('asset/simple.money.format.js')}}"></script>
    <script>
        $('.money').simpleMoneyFormat();
        console.log($('.money').text());

    </script>

{{--    search jquery--}}
{{--    <script type="text/javascript">--}}
{{--        $('#search').on('keyup',function (){--}}
{{--            $value=$(this).val();--}}

{{--            if($value){--}}
{{--                $('.alldata').hide();--}}
{{--                $('.searchdata').show();--}}
{{--            }--}}
{{--            else{--}}
{{--                $('.alldata').show();--}}
{{--                $('.searchdata').hide();--}}
{{--            }--}}

{{--            $.ajax({--}}
{{--                type:'get',--}}
{{--                url: '{{URL::to('search')}}',--}}
{{--                date:{'search',$value},--}}

{{--                success:function (data){--}}
{{--                    console.log(data);--}}
{{--                    $('#Content').html(data);--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}

    {{--    for sweet Alert--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Template Javascript -->
<script src="{{asset('asset/js/main.js')}}"></script>
@yield('script')
</body>

</html>
