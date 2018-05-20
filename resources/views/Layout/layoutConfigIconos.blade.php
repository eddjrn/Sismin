<!-- Favicon-->
<link rel="icon" href="{{asset('/images/iconoMin.svg')}}" type="image/x-icon">
<!-- Mobile -->
<link rel="apple-touch-icon" href="{{asset('/images/apple-touch-icon.png')}}">
<meta name="apple-mobile-web-app-title" content="SisMin">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<!-- Evita que los links se abran fuera de la aplicación web -->
<script type="text/javascript">
if(("standalone" in window.navigator) && window.navigator.standalone){
    var noddy, remotes = false;
    document.addEventListener('click', function(event) {
        noddy = event.target;
        while(noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
            noddy = noddy.parentNode;
        }
        if('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 && event.target.target != "_blank" || remotes)){
            event.preventDefault();
            document.location.href = noddy.href;
        }
    },false);
}
</script>
