<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dplayer/1.25.0/DPlayer.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hls.js/0.12.4/hls.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dplayer/1.25.0/DPlayer.min.js"></script>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        /*html,body{*/
        /*    width: 100%;*/
        /*    height: 100%;*/
        /*}*/
    </style>
</head>
<body>
<div id="dplayer"></div>
<script>
    const dp = new DPlayer({
        container: document.getElementById('dplayer'),
        screenshot: true,
        preload: 'auto',
        video: {
            url: '{{ $url }}',
        },
    });
</script>
</body>
</html>