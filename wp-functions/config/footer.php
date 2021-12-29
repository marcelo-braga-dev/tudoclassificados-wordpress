<?php
function bs4_script_principal() 
{
?>
      <!-- INICIA FOOTER FUNCTION --------------------------------------------------->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

      <script type="text/javascript" src="/wp-functions/assets/js/mask.js"></script>    

      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


      <script type="text/javascript" src="/wp-functions/assets/js/slick-1.8.1/slick/slick.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
      <script src="/wp-functions/assets/js/spinner.js"></script>
      
      <script type="text/javascript" src="/wp-functions/assets/js/main.js"></script>
      
      <script>
            $(document).ready(function() {
                  $('.select2').select2({
                        // theme: 'bootstrap4',
                  });
            });

            // Spinner
            // $.LoadingOverlay("show");
            $.LoadingOverlaySetup({
                  background: "rgba(0, 0, 0, 0.5)",
                  //     imageAnimation  : "1.5s fadein",
                  imageColor: "#004da9",
                  imageAutoResize: true,
                  imageResizeFactor: 0.5,
            });
      </script>
      
      <script>
            $(document).ready(function() {
                $('#mobile').mask('(00) 0 0000-0000');
            });    
        </script>
      <!-- FINALIZA FOOTER FUNCTION --------------------------------------------------->

<?php
}
add_action('wp_footer', 'bs4_script_principal', 100);
?>