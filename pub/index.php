<?php


require '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'App.php';
$executionTime = App::run();

$profiler = sprintf("<div class='container text-right'><small><small class='text-muted'>Время выполнения: %s сек.</small></small></div>", $executionTime);
print $profiler;

