<?php if( $product_cat === "Geburtstag" || $product_cat ==="Kunstevent" ) : ?>
    <div>
        <h5>Anpassungen</h5>
        <p>In meinen Kindergeburtstage sind standardmäßig <b>30 Minuten Geschenke auspacken und Essen</b> eingeplant. Solltest du nur deine eigenen Feierlichkeiten haben wollen, kannst du diesen Teil <b>hier abwählen</b>.</p>
    </div>


    <div class="extras__list">

        <template id="extras__item">
            <label class="extras__item" id="extra--1" for="checkbox1" data-extra="1">
                <p class="new__checkbox">
                    <input type="checkbox" id="checkbox1">
                    <label class="new__checkbox">30 Minuten Feierlichkeiten abwählen</label>
                    <span class="checkbox__error"></span>
                </p>
                <p class="extra__price">-25€</p>
            </label>
        </template>

        <!-- <label class="extras__item" id="extra--onlyworkshop" for="checkbox1" data-extra="onlyworkshop">
            <p class="new__checkbox">
                <input type="checkbox" id="checkbox1">
                <label class="new__checkbox" for="checkbox1">30 Minuten Feierlichkeiten abwählen</label>
                <span class="checkbox__error"></span>
            </p>
            <p class="extra__price">-25€</p>
        </label> -->

    </div>

<?php endif; ?>