<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ss, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('/components.constraint')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <title>{{ trans('msg.list_place') }}</title>
</head>

<body>
    @include('/components.header_home')
    <div class="container md:pt-6 md:px-16 mx-auto sm:w-750 md:w-970 lg:w-1170">
        <livewire:search-place />
    </div>
    @livewireScripts
    @include('/components.footer')
</body>

</html>
