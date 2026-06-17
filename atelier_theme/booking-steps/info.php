<div>
    <!-- <h5>Persönliche Angaben</h5> -->
    <form id="info__form">


        <!-- Kurse & Workshop - Schritt 2 -->
        <?php if( $product_cat === "Kurs" || $product_cat === "Workshop" || $product_cat === "Ferienprogramm" ) : ?>

            <?php if( $product_group === "Kinder" ) : ?>
                <p class="input__field">
                    <span class="input__label">Name des Kindes*</span>
                    <input type="text" name="childname" autocomplete="off">
                    <span class="input__error"></span>
                </p>
                <p class="input__field">
                    <span class="input__label">Alter des Kindes*</span>
                    <input type="text" name="childage" autocomplete="off">
                    <span class="input__error"></span>
                </p>
            <?php endif; ?>

            <p class="input__field">
                <span class="input__label">Anmerkungen</span>
                <textarea id="" cols="30" rows="10" name="message" placeholder="Du hast einen Gutscheincode? Gib ihn einfach hier mit an ... Der Rabatt wird nach der Buchung von mir berücksichtigt."></textarea>
                <span class="input__error"></span>
            </p>
            
            <h5>Persönliche Angaben</h5>

            <p class="input__field --half">
                <span class="input__label">Vorname*</span>
                <input type="text" name="firstname" autocomplete="given-name">
                <span class="input__error"></span>
            </p>

            <p class="input__field --half">
                <span class="input__label">Nachname*</span>
                <input type="text" name="lastname" autocomplete="family-name">
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">E-Mail-Adresse*</span>
                <input type="text" name="email" autocomplete="email">
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">Telefonnummer</span>
                <input type="text" name="phone" autocomplete="tel">
                <span class="input__error"></span>
            </p>

        <?php endif; ?>






        <!-- Geburtstage - Schritt 1 -->
        <?php if( $product_cat === "Geburtstag" ) : ?>

            <p class="input__field">
                <span class="input__label">Anzahl der Teilnehmer (ungefähr)*</span>
                <select name="peoplecount">
                    <option value="">Auswählen...</option>
                    <option value="3">3 Teilnehmer</option>
                    <option value="4">4 Teilnehmer</option>
                    <option value="5">5 Teilnehmer</option>
                    <option value="6">6 Teilnehmer</option>
                    <option value="7">7 Teilnehmer</option>
                    <option value="8">8 Teilnehmer</option>
                    <option value="9">9 Teilnehmer</option>
                    <option value="10">10 Teilnehmer</option>
                </select>
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">Name des Geburtstagskindes*</span>
                <input type="text" name="childname" autocomplete="off">
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">Alter des Kindes*</span>
                <input type="text" name="childage" autocomplete="off">
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">Anmerkungen</span>
                <textarea id="" cols="30" rows="10" name="message" placeholder="Du hast einen Gutscheincode? Gib ihn einfach hier mit an ... Der Rabatt wird nach der Buchung von mir berücksichtigt."></textarea>
                <span class="input__error"></span>
            </p>


            <h5>Persönliche Angaben</h5>

            <p class="input__field --half">
                <span class="input__label">Vorname*</span>
                <input type="text" name="firstname" autocomplete="given-name">
                <span class="input__error"></span>
            </p>

            <p class="input__field --half">
                <span class="input__label">Nachname*</span>
                <input type="text" name="lastname" autocomplete="family-name">
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">E-Mail-Adresse*</span>
                <input type="text" name="email" autocomplete="email">
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">Telefonnummer</span>
                <input type="text" name="phone" autocomplete="tel">
                <span class="input__error"></span>
            </p>

            <!-- <p class="input__field">
                <span class="input__label">Anzahl der Teilnehmer (ungefähr)*</span>
                <input type="number" name="peoplecount" min="0">
                <span class="input__error"></span>
            </p> -->

        <?php endif; ?>




        <!-- Kunstevents - Schritt 1 -->
        <?php if( $product_cat === "Kunstevent" ) : ?>

            <p class="input__field">
                <span class="input__label">Mit wem planst du dein Event?*</span>
                <select name="eventtype">
                    <option value="">Auswählen...</option>
                    <option value="Freunde">Freunde</option>
                    <option value="Familie">Familie</option>
                    <option value="Junggesellinnenabschied">Junggesellinnenabschied</option>
                    <option value="Firma">Firma</option>
                    <option value="Sonstige">Sonstige</option>
                </select>
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">Gewünschte Eventdauer*</span>
                <select name="duration">
                    <option value="">Auswählen...</option>
                    <?php // $min_duration = get_field("duration", $product_id); ?>
                    <?php // for( $i=$min_duration; $i<=5; $i++ ) : ?>
                        <!-- <option value="<?= $i ?>"><?= $i ?> Stunden</option> -->
                        <option value="3.5">3,5 Stunden</option>
                        <option value="4.5">4,5 Stunden</option>
                    <?php //endfor; ?>
                </select>
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">Anzahl der Teilnehmer (ungefähr)*</span>
                <select name="peoplecount">
                    <option value="">Dauer wählen...</option>
                </select>
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">Anmerkungen</span>
                <textarea id="" cols="30" rows="10" name="message" placeholder="Du hast einen Gutscheincode? Gib ihn einfach hier mit an ... Der Rabatt wird nach der Buchung von mir berücksichtigt."></textarea>
                <span class="input__error"></span>
            </p>

            <h5>Persönliche Angaben</h5>

            <p class="input__field --half">
                <span class="input__label">Vorname*</span>
                <input type="text" name="firstname" autocomplete="given-name">
                <span class="input__error"></span>
            </p>

            <p class="input__field --half">
                <span class="input__label">Nachname*</span>
                <input type="text" name="lastname" autocomplete="family-name">
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">E-Mail-Adresse*</span>
                <input type="text" name="email" autocomplete="email">
                <span class="input__error"></span>
            </p>

            <p class="input__field">
                <span class="input__label">Telefonnummer</span>
                <input type="text" name="phone" autocomplete="tel">
                <span class="input__error"></span>
            </p>

            <!-- <p class="input__field">
                <span class="input__label">Anzahl der Teilnehmer (ungefähr)*</span>
                <input type="number" name="peoplecount" min="0">
                <span class="input__error"></span>
            </p> -->

        <?php endif; ?>

    </form>
</div>