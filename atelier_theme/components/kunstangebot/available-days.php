<?php
$days = $args['days'];

if (!isset($days)) return;

$weekdays = [
    'monday' => 'Mo',
    'tuesday' => 'Di',
    'wednesday' => 'Mi',
    'thursday' => 'Do',
    'friday' => 'Fr',
    'saturday' => 'Sa',
    'sunday' => 'So'
];
?>

<div class="days">
    <span class="days__title">Verfügbare Tage</span>
    <div class="days__list">
        <?php foreach ($weekdays as $weekday => $short) : ?>
            <?php if (in_array($weekday, $days)) : ?>
                <div class="--active">
                    <span><?= $short ?></span>
                </div>
            <?php else : ?>
                <div></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>