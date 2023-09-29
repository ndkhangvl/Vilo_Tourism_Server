<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi tiết địa diểm</title>
</head>

<body>
    @foreach ($detail_place as $detail_place)
        <h1>{{ $detail_place->id_place }}</h1>
        <h1>{{ $detail_place->id_area }}</h1>
        <h1>{{ $detail_place->id_service }}</h1>
        <h1>{{ $detail_place->name_place }}</h1>
        <h1>{{ $detail_place->address_place }}</h1>
        <h1>{{ $detail_place->phone_place }}</h1>
        <h1>{{ $detail_place->email_contact_place }}</h1>
        <p>{!! $detail_place->describe_place !!}</p>
        <h1>{{ $detail_place->image_url }}</h1>
    @endforeach
</body>

</html>
