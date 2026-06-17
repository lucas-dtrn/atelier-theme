<div>
    <h5>Zahlungsinformationen</h5>
    <?php if( $product_cat === "Kurs" ) : ?>
        <p><b>Du musst jetzt noch nichts bezahlen!</b> Sobald du auch wirklich an dem Kurs teilgenommen hast, kannst du vor Ort bezahlen oder ich sende dir eine Rechnung zu, die du innerhalb von 14 Tagen begleichen musst.</p>
    <?php elseif( $product_cat === "Workshop" ): ?>
        <p><b>Du musst jetzt noch nichts bezahlen!</b> Sobald du auch wirklich an dem Workshop teilgenommen hast, kannst du vor Ort bezahlen.</p>
    <?php elseif( $product_cat === "Geburtstag" ): ?>
        <p><b>Du musst jetzt noch nichts bezahlen!</b> Sobald der Geburtstag auch wirklich stattfindet, kannst du vor Ort bezahlen.</p>
    <?php elseif( $product_cat === "Kunstevent" ): ?>
        <p><b>Du musst jetzt noch nichts bezahlen!</b> Sobald das Kunstevent auch wirklich stattfindet, kannst du vor Ort bezahlen.</p>
    <?php endif; ?>
</div>

<!-- <form id="info__form">
    <p class="input__field">
        <span class="input__label">Kontoverbindung</span>
        <input type="text" name="iban" placeholder="IBAN">
        <span class="input__error"></span>
    </p>
</form> -->

<div>
    <h5>Zahlungsmethoden vor Ort</h5>
    <div class="payments__list">
        <span>Barzahlung</span>
        <span>EC-Karte</span>
        <?php if( $product_cat === "Kurs" ) : ?>
            <span>Rechnung</span>
        <?php endif; ?>
    </div>
</div>