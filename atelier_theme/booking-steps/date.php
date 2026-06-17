<?php
// Kurse - Schritt 1
// Zeigt alle Termine des ausgewählten Kurses an

if ($product_cat === "Kurs") :

    $sql = "SELECT `kurs_tag`, `kurs_zeit` FROM `kurse` WHERE `kurs_name` = :kurs_name AND `kurs_nummer` = :kurs_nummer";
    $resultsQuery = $db->query($sql, [
        'kurs_name' => $_GET["sql_id"],
        'kurs_nummer' => $_GET["course_num"],
    ]);
    
    if($resultsQuery->count() === 0) {
        throw new Exception('Es wurde kein passender Kurs in der Datenbank gefunden');
    }

    $result = $resultsQuery->first();
    ?>
            
    <div class="selected__course">
        <div>
            <h6><?= $result['kurs_tag'] ?></h6>
            <h5><?= $result['kurs_zeit'] ?></h5>
        </div>
        <span>Starttermin wählen...</span>
    </div>

    <div>
        <h5>Wähle deinen Starttermin</h5>
        <form class="pick__date --small">
            <?php
            $kurs_nummer = $row["kurs_nummer"];
            $sql = "SELECT `datum` FROM `termine_kurse` WHERE `datum` >= NOW() AND `kurs_name` = :kurs_name AND `kurs_nummer` = :kurs_nummer ORDER BY datum ASC LIMIT 10";
            $resultsQuery = $db->query($sql, [
                'kurs_name' => $_GET["sql_id"],
                'kurs_nummer' => $_GET["course_num"],
            ]);

            if ($resultsQuery->count() > 0) {
                $i = 0;
                foreach ($resultsQuery->results() as $result) {

                    $datum = strtotime($result["datum"]);
                    $date_output = date("Y-m-d", $datum);
                    $date_readable = date("d. F Y", $datum);
                    $date_readable = translateReadableDateToGerman( $date_readable );
                    $i++;
                    ?>
                        <input type="radio" name="tools" id="date-<?= $i ?>" value="<?= $date_output ?>">
                        <label for="date-<?= $i ?>"><?= $date_readable ?></label>
                    <?php
                }
            } else {
                echo "Es wurden keine Termine gefunden.";
            }
            ?>
        </form>
        <p id="date__error" class="--hidden">Wähle einen Termin aus...</p>
    </div>

    <p>Ab dem ausgewählten Datum wirst du an allen folgenden Kursterminen teilnehmen. Solltest du einmal nicht teilnehmen können, verfällt der Termin nicht und wird am Ende deines Kurses angehängt.</p>

<?php endif; ?>




<!-- Workshops - Schritt 1 -->
<!-- Zeigt alle Termine des ausgewählten Workshops an -->
<?php if( $product_cat === "Workshop" || $product_cat === "Ferienprogramm" ) : ?>

    <div>
        <h5>Wähle einen Termin</h5>
        <form class="pick__date --big">
            <?php
            if( $product_cat === "Workshop" ) $sql = "SELECT * FROM `termine_workshops` WHERE `datum` >= NOW() AND `workshop` = :sql_id ORDER BY `datum` ASC LIMIT 10";
            if( $product_cat === "Ferienprogramm" ) $sql = "SELECT * FROM `termine_ferienprogramm` WHERE `datum` >= NOW() AND `ferienprogramm` = :sql_id ORDER BY `datum` ASC LIMIT 10";
            $resultsQuery = $db->query($sql, [
                'sql_id' => $_GET["sql_id"]
            ]);
            if ($resultsQuery->count() > 0) :
                $i = 0;
                foreach ($resultsQuery->results() as $row) :
                    $i++;
                    ?>

                    <?php if ( $row["datum_2"] === "0000-00-00" ) :

                        $date = strtotime($row["datum"]);
                        $date_output = date("Y-m-d", $date);
                        $date_readable = date("d. F Y", $date);
                        $date_readable = translateReadableDateToGerman( $date_readable );
                        $date_day = date("l", $date);
                        $date_day = translateReadableDateToGerman( $date_day );

                        $_SESSION['double_date'] = "false";
                        // localStorage.setItem('double_date', false);
                        ?>

                        <input type="radio" name="tools" id="date-<?= $i ?>" value="<?= $date_output ?>" data-time="<?= $row["zeit"] ?>">
                        <label for="date-<?= $i ?>" >
                            <div>
                                <h5><?= $date_readable ?></h5>
                                <h6><?= $date_day ?></h6>
                            </div>
                            <span><?= $row["zeit"] ?></span>
                        </label>

                    <?php else :
                
                        $date = strtotime($row["datum"]);
                        $date_2 = strtotime($row["datum_2"]);
                        $date_output = date("Y-m-d", $date);
                        $date_2_output = date("Y-m-d", $date_2);
                        $date_readable = date("d.", $date) . " + " . date("d. F Y", $date_2);
                        $date_readable = translateReadableDateToGerman( $date_readable );
                        $date_day = date("l", $date) . " + " . date("l", $date_2);
                        $date_day = translateReadableDateToGerman( $date_day );
                        $date_double = true;

                        $_SESSION['double_date'] = "true";
                        // localStorage.setItem('double_date', true);
                        $date_2_readable = date("d. F Y", $date_2);
                        $_SESSION['date_two'] = $date_2_readable;
                        $date_2_readable = translateReadableDateToGerman( $date_2_readable );
                        ?>

                        <input type="radio" name="tools" id="date-<?= $i ?>" value="<?= $date_output ?>" data-date-two="<?= $date_2_output ?>" data-time="<?= $row["zeit"] ?>" data-time-two="<?= $row["zeit_2"] ?>">
                        <label for="date-<?= $i ?>" >
                            <div>
                                <h5><?= $date_readable ?></h5>
                                <h6><?= $date_day ?></h6>
                            </div>
                            <div>
                                <span><?= $row["zeit"] ?></span>
                                <span><?= $row["zeit_2"] ?></span>
                            </div>
                        </label>

                    <?php endif; ?>

                    <?php
                endforeach;
            else :
                echo "Es wurden keine Termine gefunden.";
            endif;
            ?>
        </form>
        <p id="date__error" class="--hidden">Wähle einen Termin aus...</p>
    </div>

<?php endif; ?>




<!-- Geburtstage - Schritt 1 -->
<!-- Zeigt die nächsten 12 Samstage & Sonntage an -->
<?php if( $product_cat === "Geburtstag" ) : ?>

    <div>
        <h5>Wähle deinen Wunschtermin</h5>
        <form class="pick__date --small">
            <?php 
            $saturday = new DateTime();
            $sunday = new DateTime();
            // Modify the date it contains
            $saturday = $saturday->modify('next saturday');
            $sunday = $sunday->modify('next sunday');
            ?>
            <?php for ($i = 0; $i < 14; $i=$i+2) :
                $saturday = $saturday->modify('+7 day');
                $sunday = $sunday->modify('+7 day');
                // Backend Output
                $saturday_output = $saturday->format('Y-m-d'); strtotime('next saturday');
                $sunday_output = $sunday->format('Y-m-d'); strtotime('next sunday');
                // Sichtbarer Output
                $saturday_readable = $saturday->format('d. F Y'); strtotime('next saturday');
                $sunday_readable = $sunday->format('d. F Y'); strtotime('next sunday');

                // Übersetzung
                $saturday_readable = translateReadableDateToGerman($saturday_readable);
                $sunday_readable = translateReadableDateToGerman($sunday_readable);
                ?>

                <input type="radio" name="tools" id="date-<?= $i ?>" value="<?= $saturday_output ?>">
                <label for="date-<?= $i ?>"><?= $saturday_readable ?></label>

                <input type="radio" name="tools" id="date-<?= $i+1 ?>" value="<?= $sunday_output ?>">
                <label for="date-<?= $i+1 ?>"><?= $sunday_readable ?></label>

            <?php endfor; ?>
        </form>
        <p id="date__error" class="--hidden">Wähle einen Termin aus...</p>
    </div>

    <div>
        <div class="info__badge">
            <div></div>
            <p>Kindergeburtstage finden nur an Samstagen & Sonntagen statt.</p>
        </div>
    </div>

<?php endif; ?>




<!-- Kunstevents - Schritt 1 -->
<!-- Lässt dich 3 verschiedene Wunschtermine auswählen -->
<?php if( $product_cat === "Kunstevent" ) : ?>

    <div>
        <h5>Wähle deinen Wunschtermin</h5>
        <form class="">
            <p class="input__field">
                <span class="input__label">Wunschtermin*</span>
                <!-- <input type="date" name="date" placeholder="TT.MM.JJJJ"> -->
                <input id="date__picker" type="text" />
                <span class="input__error"></span>
            </p>
        </form>
        <p id="date__error" class="--hidden">Wähle einen Termin aus...</p>
    </div>

<?php endif; ?>