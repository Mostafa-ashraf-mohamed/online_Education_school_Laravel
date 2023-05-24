<!DOCTYPE html>
<html
@if(app()->getLocale() == "en")
    lang="en"
@else
    lang="ar" dir="rtl"
@endif
>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>online learning</title>
  <link rel="icon" href="../images/icon.png">
    <!-- the font text -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- the font icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- bootestrab css -->
    <link href="{{url('assets/bootstrap.min.css')}}" rel="stylesheet">
    <!-- my css -->
    @yield('mycss')
</head>

<body>

    @yield('navbar')


    @yield('contant')



    <script src="{{url('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <!-- My JS -->
    @yield('myjs')
</body>

</html>
