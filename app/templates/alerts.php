<?php $alerts = App::popAlerts(); ?>
<?php foreach ($alerts as $key => $alert): ?>
    <?php
    $class = 'alert-success';
    if ($key == 'error') {
        $class = 'alert-danger';
    }
    ?>
    <div class="alert <?= $class ?> fade in">
        <?= $alert ?>
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <script>
            window.setTimeout(function() { $('div.alert-success').alert('close'); }, 2000)
        </script>
    </div>
<?php endforeach ?>
