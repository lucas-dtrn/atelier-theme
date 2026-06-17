<?php
$button = $args['button'];
$color = $args['color'] ?? 'main';
$direction = $args['direction'] ?? 'right';
if ($button) :
    $link_url = $button['url'];
    $link_title = $button['title'];
    $link_target = !empty($button['target']) ? $button['target'] : '_self';
?>
    <a class="button--back button-link --color-<?= $color ?> --direction-<?= $direction ?>" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
        <span><?php echo $link_title; ?></span>

        <svg class="arrow" width="8" height="12" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.00012 9.32739C1.26532 9.32734 1.51954 9.22197 1.70703 9.03442L5.37012 5.37036C5.55767 5.18287 5.66303 4.92852 5.66309 4.66333C5.66303 4.39814 5.55767 4.14379 5.37012 3.9563L1.70703 0.294189C1.5195 0.106718 1.26529 0.0012207 1.00012 0.0012207C0.734958 0.0012207 0.480619 0.106718 0.293091 0.294189C0.10562 0.481717 0.000244141 0.736057 0.000244141 1.00122C0.000244141 1.26638 0.10562 1.52072 0.293091 1.70825L3.24915 4.66333L0.293091 7.62036C0.10562 7.80789 0.000244141 8.06223 0.000244141 8.32739C0.000244141 8.59256 0.10562 8.8469 0.293091 9.03442C0.480584 9.22197 0.734927 9.32734 1.00012 9.32739Z" fill="#55D045" />
        </svg>
    </a>
<?php endif; ?>