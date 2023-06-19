<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <p>Latitude: {{ $geo['geoplugin_latitude'] }}</p>
    <p>Longitude: {{ $geo['geoplugin_longitude'] }}</p>
    <p>Country : {{ $geo['geoplugin_longitude'] }}</p>
    <p>Region : {{ $geo['geoplugin_longitude'] }}</p>
    <p>City : {{ $geo['geoplugin_longitude'] }}</p>
    <p>Latitude : {{ $geo['geoplugin_longitude'] }}</p>
    <p>Longitude : {{ $geo['geoplugin_longitude'] }}</p>
    <a
        href="{{ 'https://www.google.com/maps/search/?api=1&query=' . $geo['geoplugin_latitude'] . ',' . $geo['geoplugin_longitude'] }}">Open
        in Maps</a>
</body>

</html>
