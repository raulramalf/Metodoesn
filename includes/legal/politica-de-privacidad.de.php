    <article class="wrap section prose-wide">
        <p class="kicker">Datenschutz</p>
        <h1>Datenschutzerklärung</h1>
        <p class="lead">
            Gemäß der Verordnung (EU) 2016/679 (DSGVO) und dem spanischen Organgesetz 3/2018 (LOPDGDD) informieren wir Sie klar und transparent über die Verarbeitung Ihrer personenbezogenen Daten über <strong><?= e(SITE_NAME) ?></strong>.
        </p>

        <h2>1. Verantwortliche Stelle</h2>
        <ul>
            <li><strong>Verantwortliche:</strong> Elena Sánchez Novo (Reg.-Nr. <?= e(SITE_COLLEGIATE_NUMBER) ?>)</li>
            <li><strong>Berufliche Anschrift:</strong> Clínica SurgEOM, <?= e(SITE_ADDRESS) ?></li>
            <li><strong>Kontakt-E-Mail:</strong> <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
            <li><strong>Telefon:</strong> <a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
        </ul>

        <h2>2. Zwecke der Verarbeitung und Rechtsgrundlage</h2>
        <p>Die personenbezogenen Daten, die Sie uns über die Website mitteilen, werden zu folgenden Zwecken verarbeitet:</p>
        <ul>
            <li>
                <strong>Bearbeitung von Anfragen und Kontakt:</strong> Beantwortung von Anfragen, Fragen oder Nachrichten, die über das Kontaktformular oder direkt (E-Mail/Telefon) eingehen.
                <br><em>Rechtsgrundlage:</em> Ihre ausdrückliche Einwilligung beim Absenden des Formulars (Art. 6 Abs. 1 lit. a DSGVO).
            </li>
            <li>
                <strong>Terminverwaltung und Buchung:</strong> Bearbeitung von Anfragen für Termine vor Ort oder online und Koordination des medizinischen und ernährungsbezogenen Terminplans.
                <br><em>Rechtsgrundlage:</em> Durchführung vorvertraglicher Maßnahmen bzw. des Behandlungsverhältnisses (Art. 6 Abs. 1 lit. b DSGVO).
            </li>
            <li>
                <strong>Erfüllung gesetzlicher Pflichten im Gesundheitswesen:</strong> Aufbewahrung und Verwahrung von Patientenakten und Abrechnungen, sobald eine Behandlung vereinbart wird.
                <br><em>Rechtsgrundlage:</em> Erfüllung rechtlicher Pflichten, die für Angehörige der Gesundheitsberufe gelten (Gesetz 41/2002 über die Patientenautonomie).
            </li>
        </ul>

        <h2>3. Kategorien verarbeiteter Daten</h2>
        <p>Über das Kontaktformular verarbeiten wir Ihren Namen, Ihre E-Mail-Adresse und den Inhalt Ihrer Nachricht. Wenn Sie direkt anrufen oder schreiben, auch Ihre Telefonnummer.</p>
        <p>Wenn Sie Angaben zu Ihrer Gesundheit machen, handelt es sich um eine besondere Kategorie personenbezogener Daten (Art. 9 DSGVO). Wir nutzen sie nur zur Beantwortung; Rechtsgrundlage ist Ihre ausdrückliche Einwilligung beim Absenden des Formulars (Art. 9 Abs. 2 lit. a DSGVO). Wir empfehlen, keine klinischen Details auf diesem Weg zu senden: Die vollständige Analyse erfolgt in der Sprechstunde.</p>

        <h2>4. Speicherdauer</h2>
        <ul>
            <li><strong>Formularnachrichten:</strong> werden <?= (int) (CONTACT_RETENTION_DAYS / 30) ?> Monate nach Eingang automatisch gelöscht, sofern keine Behandlung beginnt.</li>
            <li><strong>Fingerabdruck der IP-Adresse:</strong> Zu jeder Nachricht wird ein verschlüsselter, nicht umkehrbarer Fingerabdruck Ihrer IP gespeichert (nie die IP selbst), um Missbrauch zu verhindern; er wird nach <?= IP_RETENTION_DAYS ?> Tagen gelöscht.</li>
            <li><strong>Patientenakte:</strong> Wenn Sie einen Ernährungs- oder Trainingsplan beginnen, werden klinische Daten so lange aufbewahrt, wie es das spanische Gesundheitsrecht vorschreibt (mindestens 5 Jahre nach dem letzten Termin, Gesetz 41/2002).</li>
        </ul>

        <h2>5. Empfänger, Auftragsverarbeiter und Übermittlungen</h2>
        <p>Ihre Daten werden nicht an Dritte weitergegeben, außer bei gesetzlicher Verpflichtung oder wenn dies mit Ihrer Zustimmung für die Gesundheitsleistung nötig ist (z. B. ein Labor).</p>
        <p><strong>Auftragsverarbeiter.</strong> Damit die Website funktioniert, verarbeiten folgende Anbieter Daten im Auftrag der Verantwortlichen, mit Vertrag nach Art. 28 DSGVO und ohne eigene Nutzung:</p>
        <ul>
            <li>Webhosting-Anbieter, bei dem die Formularnachrichten gespeichert werden.</li>
            <li>E-Mail-Anbieter, über den die Benachrichtigung zu jeder Nachricht eingeht und geantwortet wird.</li>
        </ul>
        <p><strong>Eingebundene Drittdienste.</strong> Nur wenn Sie Drittanbieter-Cookies akzeptieren, werden der Kalender und das Zertifikat von Doctoralia (Docplanner, Sitz in der EU) und die Karte von Google Maps (Google) in Ihrem Browser geladen. Google kann technische Nutzungsdaten in die USA übermitteln; diese Übermittlung ist durch das EU-US-Datenschutzrahmenabkommen gedeckt (Angemessenheitsbeschluss der Europäischen Kommission vom 10. Juli 2023). Wenn Sie über Doctoralia buchen, verarbeitet diese Plattform Ihre Daten nach ihrer eigenen Datenschutzerklärung.</p>

        <h2>6. Ihre Rechte als Nutzer</h2>
        <p>Sie können jederzeit folgende Rechte ausüben:</p>
        <ul>
            <li><strong>Auskunft:</strong> Erfahren, welche Ihrer Daten wir verarbeiten.</li>
            <li><strong>Berichtigung:</strong> Korrektur unrichtiger oder unvollständiger Daten verlangen.</li>
            <li><strong>Löschung («Recht auf Vergessenwerden»):</strong> Löschung Ihrer Daten verlangen, wenn sie nicht mehr erforderlich sind.</li>
            <li><strong>Einschränkung der Verarbeitung und Widerspruch:</strong> Bestimmte Verwendungen einschränken oder ablehnen.</li>
            <li><strong>Datenübertragbarkeit:</strong> Ihre Daten in einem strukturierten, gängigen Format erhalten.</li>
        </ul>
        <p>
            Zur Ausübung dieser Rechte genügt eine schriftliche Anfrage an <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a> mit dem Betreff «Datenschutz» und einem Identitätsnachweis. Zudem haben Sie das Recht, bei der spanischen Datenschutzbehörde (<a href="https://www.aepd.es" target="_blank" rel="noopener">www.aepd.es</a>) Beschwerde einzulegen, wenn Sie Ihre Rechte verletzt sehen.
        </p>

        <p class="legal-updated">
            <em>Letzte Aktualisierung: November 2026.</em>
        </p>
    </article>
