<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>P10 - <?=$title?></title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>
<body>
    <div id="donut" style="height: 250px;"></div>
    <div id="myfirstchart" style="height: 250px;"></div>
</body>
<script>
    new Morris.Line({
        element: 'myfirstchart',
        data: <?=$data?>,
        xkey: 'year',
        ykeys: ['sales','purchase'],
        labels: ['Sales','Purchase'],
        lineColors: ['red','black'],
        hideHover: true
    });
    new Morris.Donut({
        element: 'donut',
        data: <?=$pie?>,
    });
</script>
</html>