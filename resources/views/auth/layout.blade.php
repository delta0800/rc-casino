<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Royal Casino | @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Royal Casino" />
  <meta name="keywords" content="Royal Casino" />
  <meta name="author" content="Royal Casino" />
  <link rel="icon" href="{{ asset('backend/png/logo.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/waves.min.css') }}" type="text/css" media="all"> 
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/feather.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/icofont.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/pages.css') }}">
</head>
@include('layouts.flash-message')
<body themebg-pattern="theme4">
@yield('content')
<script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/css-scrollbars.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/common-pages.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/waves.min.js') }}"></script>
<script src="{{ asset('backend/js/rocket-loader.min.js') }}"></script>
</body>
</html>