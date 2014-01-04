<?php
if (!App::isProfilerEnabled()) {
    return;
}
$profiler = App::getConnection()->getProfiler();
?>
<div class="profiler small text-muted">
<div class='text-right'><small><small class='text-muted'>Время выполнения: <?php echo round($this->layout()->executionTime, 2) ?> сек.</small></small></div>
<table class="table">
    <tr>
        <th>Время</th>
        <th>Запрос</th>
    </tr>
    <?php foreach($profiler->getQueryProfiles() as $query): ?>
        <tr>
            <td><?= round($query->getElapsedSecs(), 4); ?></td>
            <td><?= $query->getQuery() ?></td>
        </tr>
    <?php endforeach ?>
</table>
</div>
