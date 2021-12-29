<div class="row justify-content-center">
   <div class="col-md-10">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
         <li class="nav-item">
            <a class="nav-link active" id="pills-aba-ingaia" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
               inGaia
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="pills-aba-bling" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
               Bling
            </a>
         </li>
      </ul>
   </div>
</div>
<div class="tab-content" id="pills-tabContent">
   <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-aba-ingaia">
      <?php include ABSPATH . 'wp-functions/aplicacoes/ingaia/principal.php'; ?>
   </div>
   <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-aba-bling">
      <?php include ABSPATH . 'wp-functions/aplicacoes/bling/principal.php'; ?>
   </div>
</div>