<!-- wp-content\plugins\advanced-classifieds-and-directory-pro\public\partials\user\acadp-public-manage-listings-display.php -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h3 class="mb-0">Todos Anúncios</h3>
                    </div>
                    <div>
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">                
                <div class="row">
                    <div class="col-12">
                        <?= do_shortcode("[acadp_manage_listings]"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>