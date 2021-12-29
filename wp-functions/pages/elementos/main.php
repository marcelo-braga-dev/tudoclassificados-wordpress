<?php

?>
<div class="d-none d-md-block">
    <div class="container" style="font-weight: 400;">
        <div class="row justify-content-around pt-2 align-items-center" style="color:var(--principal); font-size:14px;">
            <div class="col-md-0 col-lg-auto mb-1">
                <a href="/">
                    <img src="https://www.tudoclassificados.com/wp-content/uploads/2021/03/cropped-logo_completa_trans_x350.png" style="max-height: 40px">
                </a>
            </div>
            <div class="col-auto text-center">
                <div class="row justify-content-center text-center">
                    <span>
                        A melhor forma de comprar e anunciar seus produtos e serviços!
                    </span>
                </div>
            </div>
            <?php if (is_user_logged_in()) { ?>
                <div class="col-md-auto col-lg-auto">
                    <a href="/minha-conta" style="color:var(--principal)">Minha Conta</a>
                    <span>|</span>
                    <a href="/anuncios-favoritos" style="color:var(--principal)">Favoritos</a>
                    <span>|</span>
                    <a href="https://www.tudoclassificados.com/wp-login.php?action=logout&redirect_to=https%3A%2F%2Fwww.tudoclassificados.com%2F&_wpnonce=9adacc281d" style="color:var(--principal)">Sair</a>
                </div>
            <?php } else { ?>
                <div class="col-lg-auto text-right">
                    <a href="/login" style="color:var(--principal)">Entrar / Registrar</a>
                </div>
                <?php /*
                <div class="col-lg-auto text-right">
                    <a href="/login" style="color:var(--principal)">Entrar</a>
                    <!-- <a href="#" data-toggle="modal" data-target="#modalExemplo">Entrar</a> -->
                    <span>|</span>
                    <a href="#" data-toggle="modal" data-target="#modalExemplo1" style="color:var(--principal)">Criar Conta</a>
                </div>
            <?php */} ?>
        </div>
    </div>
</div>

<?php /*
<?php if (!is_uwp_login_page()) : ?>
    <!-- MODAL LOGIN -->
    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content px-3">
                <?php echo do_shortcode("[uwp_login]"); ?>

            </div>
        </div>
    </div>
<?php endif ?>
<!-- CRIAR CONTA -->
<div class="modal fade" id="modalExemplo1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content px-3">
            <?php echo do_shortcode("[uwp_register]");
            //if (!do_shortcode("[uwp_register]")) {
              //  echo do_shortcode("[uwp_login]");
            //}
            ?>
        </div>
    </div>
</div>
*/?>
<?php
/*
function verifica_dados_requiridos_usuario()
{
    if (is_user_logged_in()) :

        $user_meta = get_user_meta(get_current_user_id());

        if (!empty($_POST['cep-usuario'])) {
            set_cep_usuario($_POST['cep-usuario']);
        }

        if (empty($user_meta['cep'][0])) :
?>
            <!-- Modal -->
            <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TituloModalCentralizado">Minha Conta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" class="m-0">
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <span>Por favor, informe o seu CEP e encontre os anúncios que estão mais
                                            próximo de você.
                                        </span>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-10 col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" for="cep-usuario">Cep</div>
                                            </div>
                                            <input type="text" class="form-control" name="cep-usuario" id="cep-usuario" data-mask="00000-000" pattern="[0-9]{5}-[0-9]{3}" placeholder="00000-000" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(function() {
                    $('#ExemploModalCentralizado').modal('show');
                })
            </script>
<?php
        endif;
    endif;
}*/
//verifica_dados_requiridos_usuario();
