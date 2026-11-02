    <article class="wrap section prose-wide">
        <p class="kicker">Legal information and transparency</p>
        <h1>Cookie Policy</h1>
        <p class="lead">
            At <strong><?= e(SITE_NAME) ?></strong>, owned by <strong>Elena Sánchez Novo</strong> (Licence No. <?= e(SITE_COLLEGIATE_NUMBER) ?>), we respect your privacy and are committed to full transparency about how we handle your data and the technologies we use.
        </p>

        <h2>1. What are cookies?</h2>
        <p>
            A cookie is a small text file that websites store in your browser or device when you visit them. Cookies allow a website, among other things, to work properly, remember your browsing preferences, collect anonymous usage statistics or integrate third-party services and widgets (such as medical booking calendars or maps).
        </p>

        <h2>2. What types of cookies and storage do we use?</h2>
        <p>
            On this website we prioritise respect for your privacy and keep the use of tracking technologies to the bare minimum. We use the following categories:
        </p>

        <div class="legal-table-wrap">
            <table class="legal-table">
                <thead>
                    <tr>
                        <th>Name / Key</th>
                        <th>Provider</th>
                        <th>Purpose</th>
                        <th>Duration</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>esn_cookies_pref</code></td>
                        <td>First party (Método ESN)</td>
                        <td>Stores your cookie consent preference (accepted or necessary only).</td>
                        <td>Persistent (localStorage)</td>
                        <td><strong>Technical (Required)</strong></td>
                    </tr>
                    <tr>
                        <td><code>PHPSESSID</code></td>
                        <td>First party (Método ESN)</td>
                        <td>Server session: protects the contact form against fraudulent submissions (CSRF) and limits repeated submissions.</td>
                        <td>Until the browser is closed</td>
                        <td><strong>Technical (Required)</strong></td>
                    </tr>
                    <tr>
                        <td><code>site_lang</code></td>
                        <td>First party (Método ESN)</td>
                        <td>Remembers the language you chose (ES, EN or DE).</td>
                        <td>30 days</td>
                        <td><strong>Technical (Required)</strong></td>
                    </tr>
                    <tr>
                        <td>Third-party cookies</td>
                        <td>Doctoralia / Google</td>
                        <td>Doctoralia booking, certificate and review widgets, and the Google Maps map. They only load if you click «Accept third parties».</td>
                        <td>Session / Third party</td>
                        <td>Functional / Third party (with consent)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>3. How to manage or change your consent</h2>
        <p>
            When you first visit our website, we show you a notice that lets you accept all cookies or limit use to those strictly necessary. You can change or withdraw your decision at any time by clicking the button below:
        </p>

        <div class="legal-box">
            <p><strong>Your current preference:</strong> Click below if you want the banner to appear again so you can change your choice:</p>
            <button class="btn btn-sm btn-ghost" id="cookie-reset">Configure cookie preferences</button>
        </div>

        <h2>4. How to disable cookies in your browser</h2>
        <p>
            In addition to our control panel, you can allow, block or delete the cookies installed on your device through the settings of the browser you use:
        </p>
        <ul>
            <li><strong>Google Chrome:</strong> Settings → Privacy and security → Cookies and other site data.</li>
            <li><strong>Mozilla Firefox:</strong> Settings → Privacy &amp; Security → Cookies and Site Data.</li>
            <li><strong>Apple Safari:</strong> Preferences → Privacy → Block all cookies.</li>
            <li><strong>Microsoft Edge:</strong> Settings → Cookies and site permissions → Manage and delete cookies and site data.</li>
        </ul>

        <h2>5. Data controller and contact</h2>
        <p>
            For any question about our Cookie Policy or the processing of your personal data, you can contact <strong>Elena Sánchez Novo</strong> directly:
        </p>
        <ul>
            <li><strong>Email:</strong> <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
            <li><strong>Phone:</strong> <a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
            <li><strong>In-person consultation:</strong> Clínica SurgEOM, <?= e(SITE_ADDRESS) ?></li>
        </ul>

        <p class="legal-updated">
            <em>Last updated: October <?= date('Y') ?>.</em>
        </p>
    </article>
