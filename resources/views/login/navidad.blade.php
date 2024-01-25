<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>navidad</title>
  <link rel="stylesheet" href="./style.css">
<style>
    html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}

article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}

body {
  background: radial-gradient(#333,#000);
  background-repeat: no-repeat;
  height: 60vh;
  font-family: Tangerine, cursive;
}

h1{
  font-size: 100px;
  color: white;
  white-space: pre-line; /* Permite que el texto ocupe varias líneas */
  text-align: center;
  margin-top:60%;
  background: url('https://i.ibb.co/89Cf3dm/text-bg.png') no-repeat;
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  animation: moveBg 90s linear infinite;
  -webkit-animation: moveBg 90s linear infinite;
}

@media only screen and (max-width: 1252px) {
  body{
    background-repeat: repeat;
  }
}

@media only screen and (max-width: 600px) {
  h1{
    margin-top: 50%;
  }
}
/* Text Background Animation */
@keyframes moveBg {
  0% {
    background-position: 0% 30%;
  }

  100%{
    background-position: 100% 50%
  }
}

.snowflake {
  color: #fff;
  font-size: 2em;
  /*font-family: Arial, sans-serif;*/
  text-shadow: 0 0 5px #000;
}

@-webkit-keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@-webkit-keyframes snowflakes-shake{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}50%{-webkit-transform:translateX(80px);transform:translateX(80px)}}@keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@keyframes snowflakes-shake{0%,100%{transform:translateX(0)}50%{transform:translateX(80px)}}.snowflake{position:fixed;top:-10%;z-index:9999;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:default;-webkit-animation-name:snowflakes-fall,snowflakes-shake;-webkit-animation-duration:10s,3s;-webkit-animation-timing-function:linear,ease-in-out;-webkit-animation-iteration-count:infinite,infinite;-webkit-animation-play-state:running,running;animation-name:snowflakes-fall,snowflakes-shake;animation-duration:10s,3s;animation-timing-function:linear,ease-in-out;animation-iteration-count:infinite,infinite;animation-play-state:running,running}.snowflake:nth-of-type(0){left:1%;-webkit-animation-delay:0s,0s;animation-delay:0s,0s}.snowflake:nth-of-type(1){left:10%;-webkit-animation-delay:1s,1s;animation-delay:1s,1s}.snowflake:nth-of-type(2){left:20%;-webkit-animation-delay:6s,.5s;animation-delay:6s,.5s}.snowflake:nth-of-type(3){left:30%;-webkit-animation-delay:4s,2s;animation-delay:4s,2s}.snowflake:nth-of-type(4){left:40%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s}.snowflake:nth-of-type(5){left:50%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s}.snowflake:nth-of-type(6){left:60%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s}.snowflake:nth-of-type(7){left:70%;-webkit-animation-delay:2.5s,1s;animation-delay:2.5s,1s}.snowflake:nth-of-type(8){left:80%;-webkit-animation-delay:1s,0s;animation-delay:1s,0s}.snowflake:nth-of-type(9){left:90%;-webkit-animation-delay:3s,1.5s;animation-delay:3s,1.5s}.snowflake:nth-of-type(10){left:25%;-webkit-animation-delay:2s,0s;animation-delay:2s,0s}.snowflake:nth-of-type(11){left:65%;-webkit-animation-delay:4s,2.5s;animation-delay:4s,2.5s}

    *{padding: 0; margin: 0; box-sizing: border-box;}

    .contenedor {
  position: fixed; /* or 'absolute' */
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}


img {
  width: 165vw; /* Ancho relativo */
  height: auto; /* Altura automática para mantener la proporción */
  position: absolute;
  bottom: -20px;
  left: 50%;
  transform: translateX(-50%);
  animation: 3s ease sube;
}

.bolitanavidad {
  /* Usa unidades relativas para el tamaño y la posición */
  height: 3vw;
  width: 3vw;
  position: absolute;
  border-radius: 50%;
  animation: ease infinite 3s brilla alternate, centro 2s ease backwards;
}

/* Ajustes específicos para diferentes tamaños de pantalla con media queries */
@media (max-width: 600px) {
  .bolitanavidad {
    height: 10vw; /* Tamaño más grande en pantallas pequeñas */
    width: 10vw;
  }

  img {
    width: 90vw; /* Imagen más grande en pantallas pequeñas */
  }
}
.bolita1
{
  left: calc(50% - 10px);
  bottom: 217px;
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
}

.bolita2
{
  left: calc(50% - 132px);
  bottom: 720px;
  -webkit-animation-delay: 2.2s;
          animation-delay: 2.2s;
}

.bolita3
{
  left: calc(20% + 325px);
  bottom: 180px;
  -webkit-animation-delay: 2.4s;
          animation-delay: 2.4s;
}

.bolita4
{    
  left: calc(50% - 0px);
  bottom: 57px;
  -webkit-animation-delay: 2.6s;
          animation-delay: 2.6s;
}

.bolita5
{
  left: calc(50% - 155px);
  bottom: 390px;
  -webkit-animation-delay: 2.8s;
          animation-delay: 2.8s;
}

.bolita6
{
  left: calc(50% + 165px);
  bottom: 359px;
  -webkit-animation-delay: 3s;
          animation-delay: 3s;
}

.bolita7
{
  left: calc(50% + -23px);
  bottom: 900px;
  -webkit-animation-delay: 3.2s;
          animation-delay: 3.2s;
}

.bolita8
{
  left: calc(50% + 46px);
  bottom: 700px;
  -webkit-animation-delay: 3.4s;
          animation-delay: 3.4s;
}

.bolita9
{
  left: calc(50% - 380px);
  bottom: 170px;
  -webkit-animation-delay: 3.6s;
          animation-delay: 3.6s;
}

.bolita10
{
  left: calc(50% + 94px);
  bottom: 529px;
  -webkit-animation-delay: 4s;
          animation-delay: 4s;
}

.bolita11
{
  left: calc(50% - 70px);
  bottom: 309px;
  -webkit-animation-delay: 3.8s;
          animation-delay: 3.8s;
}

.gift
{
  display: inline-block;
  width: 100px;
  height: 100px;
  position: absolute;
  background-size: cover;
  -webkit-animation: sube 3s 4s both;
          animation: sube 3s 4s both;
}

.carton-cyan
{
  background-image: url(http://nobacks.com/wp-content/uploads/2014/11/Gift-Box-42-500x500.png);
  bottom: -5px;
  left: 40%;
}

.carton-rojo
{
  background-image: url('http://nobacks.com/wp-content/uploads/2014/11/Gift-Box-31-473x500.png');
  bottom: -3px;
  left: 60%;
  -webkit-animation-delay: 4.4s;
          animation-delay: 4.4s;
}
.imagen-decorativa {
  display: block;
  margin: 0 auto; /* Centra la imagen horizontalmente */
  max-width: 20%; /* Asegura que la imagen no sea más ancha que su contenedor */
  height: auto; /* Mantiene la proporción de la imagen */
  margin-bottom: 1380px; /* Espacio entre la imagen y el texto "Feliz Navidad" */
}

@-webkit-keyframes sube {
  from { transform: translateX(-50%) translateY(100%); }
  to { transform: translateX(-50%) translateY(0); }
}

@keyframes sube {
  from { transform: translateX(-50%) translateY(100%); }
  to { transform: translateX(-50%) translateY(0); }
}

@-webkit-keyframes brilla {
  0% { box-shadow: 0 0 15px red; }
  30% { box-shadow: 0 0 15px orange; background: gold;}
  60% { box-shadow: 0 0 15px violet; background: violet; }
  90% {box-shadow: 0 0 15px cyan; background: cyan;}
}

@keyframes brilla {
  0% { box-shadow: 0 0 15px red; }
  30% { box-shadow: 0 0 15px orange; background: gold;}
  60% { box-shadow: 0 0 15px violet; background: violet; }
  90% {box-shadow: 0 0 15px cyan; background: cyan;}
}

@-webkit-keyframes centro
{
  from{ left: 50%; bottom: calc(100% + 20px);}
  50%{ left: calc(50% - 10px); bottom: 217px; }
}

@keyframes centro
{
  from{ left: 50%; bottom: calc(100% + 20px);}
  50%{ left: calc(50% - 10px); bottom: 217px; }
}
</style>
</head>
<body>
<img src="{{asset('admin_aapp/images/img2.png')}}" alt="Imagen Decorativa" class="imagen-decorativa">

<h1>Feliz Navidad</h1>

    <div class="snowflakes" aria-hidden="true">
      <div class="snowflakes">
      ❅
      </div>
      <div class="snowflake">
      ❆
      </div>
      <div class="snowflake">
      ❅
      </div>
      <div class="snowflake">
      ❆
      </div>
      <div class="snowflake">
      ❅
      </div>
      <div class="snowflake">
      ❆
      </div>
      <div class="snowflake">
        ❅
      </div>
      <div class="snowflake">
        ❆
      </div>
      <div class="snowflake">
        ❅
      </div>
      <div class="snowflake">
        ❆
      </div>
      <div class="snowflake">
        ❅
      </div>
      <div class="snowflake">
        ❆
      </div>
    </div>
<div class="contenedor">

<img src="{{asset('admin_aapp/images/img.png')}}"alt="arbol de navidad" />
  <span class="bolitanavidad bolita1"></span>
  <span class="bolitanavidad bolita2"></span>
  <span class="bolitanavidad bolita3"></span>
  <span class="bolitanavidad bolita4"></span>
  <span class="bolitanavidad bolita5"></span>
  <span class="bolitanavidad bolita6"></span>
  <span class="bolitanavidad bolita7"></span>
  <span class="bolitanavidad bolita8"></span>
  <span class="bolitanavidad bolita9"></span>
  <span class="bolitanavidad bolita10"></span>
  <span class="bolitanavidad bolita11"></span>
  <span class="gift carton-cyan"></span>
  <span class="gift carton-rojo"></span>
</div>
<!-- partial -->
  
</body>
</html>
