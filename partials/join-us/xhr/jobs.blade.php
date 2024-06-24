<?php foreach($jobs as $job): ?>
<li>
    <a target="_blank" href="<?= $job['url'] ?>">
        <strong class="job-title"><?= $job['job'] ?></strong>
        <span class="job-location"><?= $job['city'] ?>, <?= $job['state'] ?> – <?= $job['department'] ?></span>
        <span class="apply-link"><em>Apply</em></span>
    </a>
</li>
<?php endforeach; ?>
