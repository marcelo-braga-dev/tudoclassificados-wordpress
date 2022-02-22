<?php
include_once 'partials/checkout.php';
?>
<?php if ($_SESSION['novo-anuncio']) : unset($_SESSION['novo-anuncio']) ?>
      <div class="row mt-4">
            <div class="col-12 alert alert-success" role="alert">
                  Seu anúncio foi publicado.
            </div>
      </div>
<?php endif ?>

<style>
      .mercadopago-button,
      .anunciar {
            background-color: var(--principal);
            border-radius: 50px !important;
            padding: 8px 15px !important;
            font-size: 14px !important;
            line-height: normal !important;
      }
</style>

<script>
      $(function() {           

            $('#pctPremiumUnico').click(function() {
                  verificaLogin('<?php echo $pctPremiumUnico->init_point; ?>');
            });
            $('#pctPremium').click(function() {
                  verificaLogin('<?php echo $pctPremium->init_point; ?>');
            });
            $('#autoProfi').click(function() {
                  verificaLogin('<?php echo $autoProfi->init_point; ?>');
            });
            $('#autoIli').click(function() {
                  verificaLogin('<?php echo $autoIli->init_point; ?>');
            });
            $('#imoveisBasico').click(function() {
                  verificaLogin('<?php echo $imoveisBasico->init_point; ?>');
            });
            $('#imoveisIli').click(function() {
                  verificaLogin('<?php echo $imoveisIli->init_point; ?>');
            });

            function verificaLogin(link) {
                  var logado = '<?= is_user_logged_in() ?>';

                  if (logado) {
                        location.href = link;
                  } else {
                        $('#modalExemplo').modal('toggle');
                  }
            }
      });
</script>