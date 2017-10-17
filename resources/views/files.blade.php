<form action="{{ route('search') }}" method="GET">
    <input type="text" name="search"/>
    <input type="submit" value="Search"/>
</form>



<style>
    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -60px;
        opacity: 0;
        transition: opacity 1s;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /*.tooltip:hover .tooltiptext {*/
        /*visibility: visible;*/
        /*opacity: 1;*/
    /*}*/
</style>

<div class="tooltip" id="test">Hover over me
    <span class="tooltiptext">Tooltip text</span>
</div>

<script>
    var test = document.getElementById("test");
    // this handler will be executed only once when the cursor moves over the unordered list
    test.addEventListener("mouseover", function( event ) {
        document.getElementsByClassName("tooltiptext")[0].style.visibility = "visible";
        document.getElementsByClassName("tooltiptext")[0].style.opacity = 1;
    }, false);

    test.addEventListener("mouseleave", function( event ) {
        document.getElementsByClassName("tooltiptext")[0].style.visibility = "hidden";
        document.getElementsByClassName("tooltiptext")[0].style.opacity = 0;
    }, false);

</script>