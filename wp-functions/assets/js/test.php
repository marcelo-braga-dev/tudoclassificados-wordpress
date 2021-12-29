<html>
  <head>
  <title>My Now Amazing Webpage</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick-1.8.1/slick/slick-theme.css"/>
  </head>
  <body>

  <div class="row  your-class">
<div class="card border-primary m-3" style="max-width: 18rem;">
  <div class="card-header">Cabeçalho</div>
  <div class="card-body text-primary">
    <h5 class="card-title">Título de Card Primary</h5>
    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
  </div>
</div>
<div class="card border-secondary m-3" style="max-width: 18rem;">
  <div class="card-header">Cabeçalho</div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Título de Card Secondary</h5>
    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
  </div>
</div>
<div class="card border-success m-3" style="max-width: 18rem;">
  <div class="card-header">Cabeçalho</div>
  <div class="card-body text-success">
    <h5 class="card-title">Título de Card Success</h5>
    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
  </div>
</div>
<div class="card border-danger m-3" style="max-width: 18rem;">
  <div class="card-header">Cabeçalho</div>
  <div class="card-body text-danger">
    <h5 class="card-title">Título de Card Danger</h5>
    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
  </div>
</div>
<div class="card border-warning m-3" style="max-width: 18rem;">
  <div class="card-header">Cabeçalho</div>
  <div class="card-body text-warning">
    <h5 class="card-title">Título de Card Warning</h5>
    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
  </div>
</div>
<div class="card border-info m-3" style="max-width: 18rem;">
  <div class="card-header">Cabeçalho</div>
  <div class="card-body text-info">
    <h5 class="card-title">Título de Card Info</h5>
    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
  </div>
</div>
<div class="card border-light m-3" style="max-width: 18rem;">
  <div class="card-header">Cabeçalho</div>
  <div class="card-body">
    <h5 class="card-title">Título de Card Light</h5>
    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
  </div>
</div>
<div class="card border-dark m-3" style="max-width: 18rem;">
  <div class="card-header">Cabeçalho</div>
  <div class="card-body text-dark">
    <h5 class="card-title">Título de Card Dark</h5>
    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
  </div>
</div>
</div>    

  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="slick-1.8.1/slick/slick.min.js"></script>
  <!--BOOTSTRAP -->
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <!----->
  

  <script type="text/javascript">
    $(document).ready(function(){
      $('.your-class').slick({
        dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
          
      });
    });
  </script>

  </body>
</html>