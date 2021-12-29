<!--  include '/home/tudocl45/public_html/wp-functions/assets/js/slick-1.8.1/funcoes/animar_titulo_card.php'-->
<script>
    $(".slider").hide();
$(function(){
    $('.animado').hide();
    $(".slider").show();
    $( "div.card" ).mouseenter(function() {
        $( "div.animado", this ).stop();
        $( "div.animado", this ).toggle(400);
    }).mouseleave(function() {
        $( "div.animado", this ).stop();
        $( "div.animado", this ).toggle(400);
    });
    
    $(".slider").slick({
        //dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: 
        [
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
        ]
      });
});
</script>