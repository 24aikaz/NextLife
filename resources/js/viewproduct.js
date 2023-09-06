import '../css/viewproduct.css';

//To view product on full screen
//Source: https://stackoverflow.com/a/74505101

$(document).ready(function(){$("img").click(function(){this.requestFullscreen()})});