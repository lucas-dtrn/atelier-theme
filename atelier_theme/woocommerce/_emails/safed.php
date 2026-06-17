<div class="email-starter">
	<img src="https://atelier-delatron.de/assets/img/portrait_120x.jpg">
	<div>
		<h1>Danke <span><?php echo $customer_firstname; ?></span>,</h1>
		<p>dass du einen Kunstkurs im Atelier Kunst & Gestalten gebucht hast! In dieser E-Mail findest du alle relevanten Informationen zu deiner Buchung.</p>
		<p>Anmerkung: <?php echo $customer_note; ?></p>
	</div>
</div>

<h2>Gebuchtes Angebot</h2>
<div class="email-field course-infos <?php echo $course_group; ?>">
	<div class="field-padding">
		<div class="course-header">
			<img src="https://atelier-delatron.de/assets/img/courses/course-images/course_<?php echo $course_image ?>_250x.jpg">
			<div>
				<h3><?php echo $course_name . " " . $course_number_roman; ?></h3>
				<span>für <?php echo $course_group; ?></span>
			</div>
		</div>
		<p>Dein Kurs wird ab dem <b><?php echo date("d.m.y", strtotime($course_date)); ?></b> alle 14 Tage von <b><?php echo $course_session_time ?></b> im Atelier Kunst & Gestalten stattfinden.</p>
		<h4>Bereits geplante Termine</h4>

		<p><?php

			$servername = "db5001988950.hosting-data.io";
			$username = "dbu782740";
			$password = "P6kgZoW8cJckujXLQqKY";
			$dbname = "dbs1623575";
			$mysql = new mysqli($servername, $username, $password, $dbname);
			$sql = "SELECT * FROM termine WHERE date >= '" . $course_date . "' AND course = '" . $course_image . "_" . $course_number . "' ORDER BY 'date' ASC LIMIT " . ($course_session_count - 1) . "";

			$result = $mysql->query($sql);
			if ($result->num_rows > 0) {
				$i = 0;
				while ($row = $result->fetch_assoc()) {

					$time = strtotime($row["date"]);
					$myFormatForView = date("d.m.y", $time);

					if ($i > 0) {
						echo ", ";
					}
					$i++;
					echo $myFormatForView;
				}
				$lasting_date_count = $course_session_count - $i;
				if ($lasting_date_count = 1) {
			?>, plus <?php echo $course_session_count - $i; ?> weitere Termine <?php
																									} else {
																										?>, plus 1 weiterer Termin <?php
																									}
																								} else {
																								}
																?></p>
	</div>
	<div class="email-list">
		<div class="row">
			<span>Anzahl der Sitzungen</span>
			<span><?php echo $course_session_count; ?> Sitzungen</span>
		</div>
		<div class="row">
			<span>Dauer einer Sitzung</span>
			<span><?php echo $course_session_duration; ?> Stunden</span>
		</div>
		<div class="row">
			<span>Uhrzeit</span>
			<span><?php echo $course_session_time; ?></span>
		</div>
		<div class="row">
			<span>Wochentag</span>
			<span><?php echo $course_session_day; ?></span>
		</div>
	</div>
</div>

<h2>Zahlungsinformationen</h2>
<div class="email-field">
	<div class="field-padding">
		<div class="email-invoice">
			<div class="invoice-item">
				<span>Artikel</span>
				<span>Summe</span>
			</div>
			<div class="invoice-item">
				<span>Kurs - <?php echo $course_name; ?> für <?php echo $course_group; ?></span>
				<span><?php echo $course_price; ?>€</span>
			</div>
			<div class="invoice-item">
				<span>Gutschein</span>
				<span>-<?php echo $giftcard; ?>€</span>
			</div>
			<div class="invoive-divide"></div>
			<div class="invoice-item">
				<span>Gesamt</span>
				<span><?php echo $price_to_pay; ?>€</span>
			</div>
		</div>
		<h4>Zahlungsmethoden</h4>
		<p>Du musst jetzt noch nichts Bezahlen! Sobald du auch wirklich an dem Kurs teilgenommen hast, kannst du vor Ort bezahlen oder ich gebe dir die Informationen des Zahlungskontos für eine Überweisung.</p>
		<div class="payment-list">
			<span>Bar</span>
			<span>Rechnung</span>
			<span>Kreditkarte</span>
			<span>EC-Karte</span>
		</div>
	</div>
</div>


<h2>Persönliche Daten</h2>
<div class="email-field">
	<div class="email-list hide-first-border">
		<div class="row">
			<span>Name</span>
			<span><?php echo $customer_firstname . " " . $customer_lastname; ?></span>
		</div>
		<div class="row">
			<span>E-Mail-Adresse</span>
			<span><?php echo $customer_email; ?></span>
		</div>
		<div class="row">
			<span>Telefonnummer</span>
			<span><?php echo $customer_tel; ?></span>
		</div>
	</div>
</div>