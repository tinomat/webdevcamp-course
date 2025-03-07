<?php
foreach ($alerts as $key => $alert) {
    foreach ($alert as $msg) { ?>
        <div class="alert alert--<?= $key ?>"><?= $msg ?></div>
<?php }
}
