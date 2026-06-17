<?php
/*------------------------------------*/
/* Block Name: Kontakt Hero Banner */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$faq_aktivieren = get_field("faq_aktivieren");
?>

<?php if ($faq_aktivieren) : ?>
    <?php if (have_rows("faq", "options")) : ?>


        <div class="faq" id="<?= $id ?>">
            <div class="wrapper">
                <div class="faq__header">
                    <h3>Häufig gestellte Fragen</h3>
                    <span>FAQ</span>
                </div>

                <div class="faq__accordeon accordeon accordeon--closed">
                    <?php while (have_rows("faq", "options")) : the_row();
                        $question = get_sub_field("frage");
                        $answer = get_sub_field("antwort");
                    ?>
                        <div class="accordeon__item">
                            <dt class="accordeon__header">
                                <h5><?= $question ?></h5>
                            </dt>
                            <dd class="accordeon__content">
                                <div>
                                    <?= $answer ?>
                                </div>
                            </dd>
                        </div>
                    <?php endwhile; ?>
                </div>

            </div>
        </div>


    <?php endif; ?>
<?php endif; ?>