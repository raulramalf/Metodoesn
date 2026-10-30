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
        <p>Über die Website werden grundlegende Identifikations- und Kontaktdaten verarbeitet (Vor- und Nachname, E-Mail-Adresse, Telefonnummer und der allgemeine Grund der Anfrage). Bitte senden Sie keine detaillierten medizinischen oder sensiblen Informationen im offenen Nachrichtenfeld des allgemeinen Formulars; die vollständige Anamnese erfolgt immer im geschützten Rahmen der Sprechstunde oder mit gesonderter medizinischer Einwilligung.</p>

        <h2>4. Speicherdauer</h2>
        <p>
            Daten, die für Anfragen angegeben werden, werden so lange gespeichert, wie es zur Bearbeitung Ihrer Anfrage erforderlich ist. Zu jeder Nachricht des Kontaktformulars wird lediglich ein verschlüsselter, nicht umkehrbarer Fingerabdruck Ihrer IP-Adresse (nicht die IP-Adresse im Klartext) gespeichert, um missbräuchliche Zusendungen zu verhindern; dieser Fingerabdruck wird nach <?= IP_RETENTION_DAYS ?> Tagen automatisch gelöscht. Wird ein Ernährungs- oder Trainingsplan begonnen, werden die klinischen Daten gemäß den gesetzlichen Fristen des spanischen Gesundheitsrechts aufbewahrt (mindestens 5 Jahre ab der letzten Behandlung).
        </p>

        <h2>5. Empfänger und Weitergabe von Daten</h2>
        <p>
            Ihre Daten werden nicht an Dritte weitergegeben, es sei denn, dies ist gesetzlich ausdrücklich vorgeschrieben oder für die Erbringung der Gesundheitsleistung unerlässlich (z. B. Terminverwaltung über die sichere Plattform Doctoralia oder klinische Analyselabore mit Ihrer vorherigen Zustimmung).
        </p>

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
            <em>Letzte Aktualisierung: Oktober <?= date('Y') ?>.</em>
        </p>
    </article>
