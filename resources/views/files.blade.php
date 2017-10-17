<form action="{{ route('search') }}" method="GET">
    <input type="text" name="search"/>
    <input type="submit" value="Search"/>
</form>

<style>
    .tooltip span {
        display: none;
    }

    .tooltip:hover span {
        display: block;
        position: fixed;
        overflow: hidden;
    }
</style>


<div title="regular tooltip">Hover me<span style="display: none" id="tooltip-span">safak</span></div>

<script>
    var tooltipSpan = document.getElementById('tooltip-span');
    window.onmousemove = function (e) {
        var x = e.clientX,
                y = e.clientY;
        tooltipSpan.style.top = (y + 20) + 'px';
        tooltipSpan.style.left = (x + 20) + 'px';
    };

//    var tooltips = document.querySelectorAll('.tooltip span');
//
//    window.onmousemove = function (e) {
//        var x = e.clientX,
//                y = e.clientY;
//        for (var i = 0; i < tooltips.length; i++) {
//            tooltips[i].style.top = y;
//            tooltips[i].style.left = x;
//        }
//
//    }
</script>

{{--<h1 rel="safak tooltip">naber</h1>--}}
{{--<script>--}}
{{--var x = document.getElementsByTagName("h1")[0].getAttribute("rel");--}}
{{--</script>--}}