<form action="{{ route('search') }}" method="GET">
    <input type="text" name="search" />
    <input type="submit" value="Search" />
</form>



<h1 rel="safak tooltip">naber</h1>
<script>
    var x = document.getElementsByTagName("h1")[0].getAttribute("rel");
    alert(x);
</script>