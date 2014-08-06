<!--
<a href='http://www.facebook.com/sharer.php?s=100&p[title]=this is a title &p[summary]=description here &p[url]=http://www.fantasycricleague.com/ &p[images][0]=http://www.fantasycricleague.com/fantasy/photos/footer/footer-bg.jpg'>facebook</a>
-->
<style type="text/css">
    #mydiv {
    background-color: lightblue;
    width: 200px;
    height: 200px
}
</style>
<div id="mydiv">
    <img src="/img/logo-white.png" />
    <p>text!</p>
</div>
<br>
<br>

<div id="canvas">
    <p>Canvas:</p>
    </div>

    <div id="image">
        <p>Image:</p>
    </div>
<script src="http://html2canvas.hertzen.com/build/html2canvas.js"></script>
<script>
html2canvas([document.getElementById('mydiv')], {
    onrendered: function (canvas) {
        document.getElementById('canvas').appendChild(canvas);
        var data = canvas.toDataURL('image/png');
        // AJAX call to send `data` to a PHP file that creates an image from the dataURI string and saves it to a directory on the server

        var image = new Image();
        image.src = data;
        document.getElementById('image').appendChild(image);
    }
});
</script>