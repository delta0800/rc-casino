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
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/waves.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/feather.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome-n.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/chartist.css') }}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/widget.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/datatables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/buttons.datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/pages.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/switchery.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @stack('style')
</head>
@include('layouts.partials.nav')
@include('layouts.partials.sidebar')
@include('layouts.flash-message')
@yield('content')
@include('layouts.partials.footer')