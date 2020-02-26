<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css"/>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    {{--    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>--}}
    {{--    <script src="https://code.jquery.com/jquery-3.1.1.slim.js"></script>--}}
</head>
<style>

</style>
<body>
<div class="container">
    <h1>Laravel Broadcast Redis Socket io Tutorial</h1>

    <div id="notification"></div>
</div>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="test">Pricing</a>
                </li>
                <li class="nav-item dropdown clear-noti" id="clear-noti">
                    <?php
                    $list_noti = \App\Notification::orderBy('id', 'desc')->get();
                    $list_noti_no_read = \App\Notification::where('read', 0)->orderBy('id', 'desc')->get();
                    ?>
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)">
                        <i class="fas fa-bell" style="font-size: 20px"></i>
                        <span class="bell-number">{{ $list_noti_no_read->count() }}</span>
                    </a>
                    <div class="dropdown-menu lol sdsss">
                        <div class="sdasd" style="background-color: aliceblue">
                        </div>
                        @foreach($list_noti as $item)
                            <a class="dropdown-item" @if($item->read == 0) style="background-color: aliceblue" @endif href="#">{{ $item->id }} . {{ $item->title }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>

</body>

<script type="text/javascript">

    window.laravel_echo_port = '{{env("LARAVEL_ECHO_PORT")}}';
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
<script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('/js/bootstrap-notify.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/bootstrap-notify.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    window.Echo.channel('user-channel').listen('.UserEvent', (data) => {
        i = data.count;
        $(".sdasd").prepend('<a class="dropdown-item">' + data.data.id + '.' + data.data.title + '</a>');
        $('.bell-number').css('display', 'block');
        $('.bell-number').text(i);

        $.notify({
            // options
            message: data.data.title,
        },{
            // settings
            type: 'danger'
        });
    });

    $('.dropdown-toggle').click(function() {
        $(this).next('.dropdown-menu').slideToggle(300);
        var url = '{{ route('clear-number-noti') }}';
        $.ajax({
            url : url,
            method: 'get',
            success : function (data) {
                if (data.code == 200) {
                    // alert("aloo");
                    // $('.bell-number').text(data.count);
                    $('.bell-number').css('display', 'none');
                }
            }
        });
    });
</script>


</html>