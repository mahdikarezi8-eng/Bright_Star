<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta Tag Description -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="format-detection" content="telephone=no">
    <!-- Meta Tag Description -->
    <!-- Page Title Text -->
    <title>Login</title>
    <!-- Page Title Text -->
    <!--Fevicon Icon Start-->
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <!--Fevicon Icon End-->
    <!--Font Description-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <!--Font Description-->

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">


</head>
</head>

<body class="skin-blue sidebar-mini">
    <div>
        {{ $slot }}
    </div>
</body>


</html>
