<!-- Descricao -->
<?php
$x = parse_url($post_meta['video'][0]);

$a = explode('&', $x['query']);
$f = [];
foreach ($a as $b) {
    $d = explode('=', $b);
    $f[$d[0]] = $d[1];
}
?>
<?php if ($f['v']) : ?>
    <div class="card p-3 mb-3">
        <div class="row">
            <div class="col-12 mx-auto">
                <div video-id="<?= $f['v'] ?>" class="rounded w-100" id="player"></div>
            </div>
        </div>
    </div>
<?php endif; ?>