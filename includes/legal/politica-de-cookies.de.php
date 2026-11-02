    <article class="wrap section prose-wide">
        <p class="kicker">Rechtliche Informationen und Transparenz</p>
        <h1>Cookie-Richtlinie</h1>
        <p class="lead">
            Bei <strong><?= e(SITE_NAME) ?></strong>, betrieben von <strong>Elena Sánchez Novo</strong> (Reg.-Nr. <?= e(SITE_COLLEGIATE_NUMBER) ?>), respektieren wir Ihre Privatsphäre und legen größten Wert auf Transparenz darüber, wie wir Ihre Daten verarbeiten und welche Technologien wir einsetzen.
        </p>

        <h2>1. Was sind Cookies?</h2>
        <p>
            Ein Cookie ist eine kleine Textdatei, die Websites beim Besuch in Ihrem Browser oder auf Ihrem Gerät speichern. Cookies ermöglichen es einer Website unter anderem, ordnungsgemäß zu funktionieren, Ihre Navigationseinstellungen zu speichern, anonyme Nutzungsstatistiken zu erheben oder Dienste und Widgets Dritter (z. B. medizinische Buchungskalender oder Karten) einzubinden.
        </p>

        <h2>2. Welche Arten von Cookies und Speicherung verwenden wir?</h2>
        <p>
            Auf dieser Website legen wir Wert auf den Schutz Ihrer Privatsphäre und beschränken den Einsatz von Tracking-Technologien auf das unbedingt Notwendige. Wir verwenden folgende Kategorien:
        </p>

        <div class="legal-table-wrap">
            <table class="legal-table">
                <thead>
                    <tr>
                        <th>Name / Schlüssel</th>
                        <th>Anbieter</th>
                        <th>Zweck</th>
                        <th>Dauer</th>
                        <th>Art</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>esn_cookies_pref</code></td>
                        <td>Eigener Anbieter (Método ESN)</td>
                        <td>Speichert Ihre Cookie-Einwilligung (akzeptiert oder nur notwendige).</td>
                        <td>Dauerhaft (localStorage)</td>
                        <td><strong>Technisch (erforderlich)</strong></td>
                    </tr>
                    <tr>
                        <td><code>PHPSESSID</code></td>
                        <td>Eigener Anbieter (Método ESN)</td>
                        <td>Server-Sitzung: schützt das Kontaktformular vor betrügerischen Zusendungen (CSRF) und begrenzt wiederholte Zusendungen.</td>
                        <td>Bis zum Schließen des Browsers</td>
                        <td><strong>Technisch (erforderlich)</strong></td>
                    </tr>
                    <tr>
                        <td><code>site_lang</code></td>
                        <td>Eigener Anbieter (Método ESN)</td>
                        <td>Merkt sich die gewählte Sprache (ES, EN oder DE).</td>
                        <td>30 Tage</td>
                        <td><strong>Technisch (erforderlich)</strong></td>
                    </tr>
                    <tr>
                        <td>Cookies von Dritten</td>
                        <td>Doctoralia / Google</td>
                        <td>Buchungs-, Zertifikats- und Bewertungs-Widgets von Doctoralia sowie die Google-Maps-Karte. Sie werden nur geladen, wenn Sie auf «Dritte akzeptieren» klicken.</td>
                        <td>Sitzung / Dritter</td>
                        <td>Funktional / Dritte (mit Einwilligung)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>3. So verwalten oder ändern Sie Ihre Einwilligung</h2>
        <p>
            Beim ersten Besuch unserer Website zeigen wir Ihnen einen Hinweis, mit dem Sie alle Cookies akzeptieren oder die Nutzung auf die unbedingt notwendigen beschränken können. Sie können Ihre Entscheidung jederzeit ändern oder widerrufen, indem Sie auf die folgende Schaltfläche klicken:
        </p>

        <div class="legal-box">
            <p><strong>Ihre aktuelle Einstellung:</strong> Klicken Sie unten, wenn das Banner erneut erscheinen soll, damit Sie Ihre Auswahl ändern können:</p>
            <button class="btn btn-sm btn-ghost" id="cookie-reset">Cookie-Einstellungen ändern</button>
        </div>

        <h2>4. So deaktivieren Sie Cookies in Ihrem Browser</h2>
        <p>
            Zusätzlich zu unserem Einstellungsbereich können Sie die auf Ihrem Gerät gespeicherten Cookies über die Einstellungen Ihres Browsers zulassen, blockieren oder löschen:
        </p>
        <ul>
            <li><strong>Google Chrome:</strong> Einstellungen → Datenschutz und Sicherheit → Cookies und andere Websitedaten.</li>
            <li><strong>Mozilla Firefox:</strong> Einstellungen → Datenschutz &amp; Sicherheit → Cookies und Website-Daten.</li>
            <li><strong>Apple Safari:</strong> Einstellungen → Datenschutz → Alle Cookies blockieren.</li>
            <li><strong>Microsoft Edge:</strong> Einstellungen → Cookies und Websiteberechtigungen → Cookies und Websitedaten verwalten und löschen.</li>
        </ul>

        <h2>5. Verantwortliche Stelle und Kontakt</h2>
        <p>
            Bei Fragen zu unserer Cookie-Richtlinie oder zur Verarbeitung Ihrer personenbezogenen Daten können Sie sich direkt an <strong>Elena Sánchez Novo</strong> wenden:
        </p>
        <ul>
            <li><strong>E-Mail:</strong> <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
            <li><strong>Telefon:</strong> <a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
            <li><strong>Sprechstunde vor Ort:</strong> Clínica SurgEOM, <?= e(SITE_ADDRESS) ?></li>
        </ul>

        <p class="legal-updated">
            <em>Letzte Aktualisierung: Oktober <?= date('Y') ?>.</em>
        </p>
    </article>
