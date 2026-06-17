<div>
    <h5>Überprüfe deine Angaben</h5>
    <div class="proof__list">





        <?php if ($product_cat === "Kurs") : ?>
            <div class="proof__item" id="proof--date">
                <span class="item__name">Dein Starttermin</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div>
        <?php endif; ?>
        <?php if ($product_cat === "Workshop" || $product_cat === "Ferienprogramm") : ?>
            <div class="proof__item" id="proof--date">
                <span class="item__name">Dein Termin</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div>
        <?php endif; ?>
        <?php if ($product_cat === "Geburtstag") : ?>
            <div class="proof__item" id="proof--date">
                <span class="item__name">Dein Wunschtermin</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div>
        <?php endif; ?>
        <?php if ($product_cat === "Kunstevent") : ?>
            <div class="proof__item" id="proof--date">
                <span class="item__name">Dein Wunschtermin</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div>
        <?php endif; ?>





        <?php if ($product_cat === "Geburtstag" || $product_cat === "Kunstevent") : ?>
            <div class="proof__item" id="proof--peoplecount">
                <span class="item__name">Teilnehmerzahl</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div>
        <?php endif; ?>






        <?php if ($product_group === "Kinder") : ?>
            <div class="proof__item" id="proof--childname">
                <span class="item__name">Name des Kindes</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div>
            <div class="proof__item" id="proof--childage">
                <span class="item__name">Alter des Kindes</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div>
        <?php endif; ?>





        <?php if ($product_cat === "Kunstevent") : ?>
            <div class="proof__item" id="proof--eventtype">
                <span class="item__name">Rahmen des Events</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div>
            <div class="proof__item" id="proof--duration">
                <span class="item__name">Eventdauer</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div>
        <?php endif; ?>




        <?php if ($product_cat === "Geburtstag") : ?>
            <!-- <div class="proof__item" id="proof--extra">
                <span class="item__name">Extras</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div> -->
        <?php endif; ?>





        <div class="proof__item" id="proof--fullname">
            <span class="item__name">Vor- & Nachname</span>
            <p class="item__value"></p>
            <div class="edit__button">
                <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
            </div>
        </div>







        <?php if ($product_cat === "Geburtstag") : ?>
            <!-- <div class="proof__item" id="proof--childname">
                <span class="item__name">Geburtstagskind</span>
                <p class="item__value"></p>
                <div class="edit__button">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
                </div>
            </div> -->
        <?php endif; ?>







        <div class="proof__item" id="proof--email">
            <span class="item__name">E-Mail-Adresse</span>
            <p class="item__value"></p>
            <div class="edit__button">
                <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
            </div>
        </div>
        <div class="proof__item" id="proof--phone">
            <span class="item__name">Telefonnummer</span>
            <p class="item__value"></p>
            <div class="edit__button">
                <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
            </div>
        </div>
        <div class="proof__item --mobile-wrap" id="proof--message">
            <span class="item__name">Anmerkungen</span>
            <p class="item__value"></p>
            <div class="edit__button">
                <img src="<?= get_template_directory_uri() ?>/assets/img/website/book/icon_edit.svg">
            </div>
        </div>


    </div>



    <?php echo do_shortcode('[contact-form-7 id="4964" title="Buchungsformular"]'); ?>

    <?php
    // if( $product_cat === "Kurs" ) :
    //     echo do_shortcode( '[contact-form-7 id="2636" title="Buchungsformular für Kurse"]' );
    // endif;
    // if( $product_cat === "Workshop" ) :
    //     echo do_shortcode( '[contact-form-7 id="2886" title="Buchungsformular für Workshops"]' );
    // endif;
    // if( $product_cat === "Geburtstag" ) :
    //     echo do_shortcode( '[contact-form-7 id="2887" title="Buchungsformular für Geburtstage"]' );
    // endif;
    // if( $product_cat === "Kunstevent" ) :
    //     echo do_shortcode( '[contact-form-7 id="2888" title="Buchungsformular für Kunstevents"]' );
    // endif;
    // if( $product_cat === "Ferienprogramm" ) :
    //     echo do_shortcode( '[contact-form-7 id="4194" title="Buchungsformular für Ferienprogramm"]' );
    // endif;
    ?>




</div>





<?php if ($product_cat === "Kurs") : ?>
    <div class="proof__acceptance">
        <p class="new__checkbox">
            <input type="checkbox" id="checkbox1" required>
            <label class="new__checkbox" for="checkbox1">Ich bin damit einverstanden, dass meine Buchung im Falle einer Überbelegung des Kurses storniert werden kann. In diesem Fall entstehen keine Kosten.</label>
            <span class="checkbox__error"></span>
        </p>
        <p>Wir verwenden deine personenbezogenen Daten, um deine Buchung durchführen zu können, eine möglichst gute Benutzererfahrung auf dieser Website zu ermöglichen und für weitere Zwecke, die in unserer <a href="https://atelier-delatron.shop/datenschutz" target="_blank">Datenschutzerklärung</a> beschrieben sind.</p>
    </div>
<?php elseif ($product_cat === "Workshop") : ?>
    <div class="proof__acceptance">
        <p class="new__checkbox">
            <input type="checkbox" id="checkbox1" required>
            <label class="new__checkbox" for="checkbox1">Ich bin damit einverstanden, dass meine Buchung im Falle einer Überbelegung des Workshops storniert werden kann. In diesem Fall entstehen keine Kosten.</label>
            <span class="checkbox__error"></span>
        </p>
        <p>Wir verwenden deine personenbezogenen Daten, um deine Buchung durchführen zu können, eine möglichst gute Benutzererfahrung auf dieser Website zu ermöglichen und für weitere Zwecke, die in unserer <a href="https://atelier-delatron.shop/datenschutz" target="_blank">Datenschutzerklärung</a> beschrieben sind.</p>
    </div>
<?php else : ?>

    <div class="proof__acceptance">
        <p>Wir verwenden deine personenbezogenen Daten, um deine Anfrage durchführen zu können, eine möglichst gute Benutzererfahrung auf dieser Website zu ermöglichen und für weitere Zwecke, die in unserer <a href="https://atelier-delatron.shop/datenschutz" target="_blank">Datenschutzerklärung</a> beschrieben sind.</p>
    </div>
<?php endif; ?>