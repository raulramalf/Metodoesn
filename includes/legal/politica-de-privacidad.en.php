    <article class="wrap section prose-wide">
        <p class="kicker">Data protection</p>
        <h1>Privacy Policy</h1>
        <p class="lead">
            In accordance with Regulation (EU) 2016/679 (GDPR) and Spanish Organic Law 3/2018 (LOPDGDD), we inform you clearly and transparently about how your personal data is processed through <strong><?= e(SITE_NAME) ?></strong>.
        </p>

        <h2>1. Data Controller</h2>
        <ul>
            <li><strong>Controller:</strong> Elena Sánchez Novo (Lic. No. <?= e(SITE_COLLEGIATE_NUMBER) ?>)</li>
            <li><strong>Professional address:</strong> Clínica SurgEOM, <?= e(SITE_ADDRESS) ?></li>
            <li><strong>Contact email:</strong> <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
            <li><strong>Phone:</strong> <a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
        </ul>

        <h2>2. Purposes of Processing and Legal Basis</h2>
        <p>The personal data you provide through the website will be processed for the following purposes:</p>
        <ul>
            <li>
                <strong>Handling enquiries and contact:</strong> Answering requests, questions or messages sent through the contact form or directly (email/phone).
                <br><em>Legal basis:</em> Your express consent when submitting the form (Art. 6.1.a GDPR).
            </li>
            <li>
                <strong>Appointment management and booking:</strong> Processing requests for in-person or online consultations and coordinating the medical and nutritional schedule.
                <br><em>Legal basis:</em> Taking pre-contractual steps or performing the care relationship (Art. 6.1.b GDPR).
            </li>
            <li>
                <strong>Compliance with legal healthcare obligations:</strong> Keeping and safeguarding clinical records and healthcare invoicing once a consultation is formalised.
                <br><em>Legal basis:</em> Compliance with legal obligations applicable to healthcare professionals (Law 41/2002 on patient autonomy).
            </li>
        </ul>

        <h2>3. Categories of Data Processed</h2>
        <p>Through the contact form we process your name, your email address and the content of your message. If you call or write directly, also your phone number.</p>
        <p>If you choose to include information about your health, it is a special category of data (Art. 9 GDPR). We use it only to reply to you, and the legal basis is your explicit consent when submitting the form (Art. 9(2)(a) GDPR). We recommend not sending clinical details this way: the full assessment takes place during the consultation.</p>

        <h2>4. Data Retention</h2>
        <ul>
            <li><strong>Form messages:</strong> automatically deleted <?= (int) (CONTACT_RETENTION_DAYS / 30) ?> months after receipt, unless you start a care relationship.</li>
            <li><strong>IP address fingerprint:</strong> each message stores an encrypted, irreversible fingerprint of your IP (never the IP itself) to prevent abuse; it is deleted after <?= IP_RETENTION_DAYS ?> days.</li>
            <li><strong>Clinical records:</strong> if you start a nutrition or training plan, clinical data are kept for the periods required by Spanish health law (at least 5 years from the last visit, Law 41/2002).</li>
        </ul>

        <h2>5. Recipients, Processors and Transfers</h2>
        <p>Your data are not shared with third parties except where required by law or where necessary to provide the health service with your authorisation (for example, a clinical laboratory).</p>
        <p><strong>Data processors.</strong> For the website to work, the following providers process data on behalf of the controller, under a processing agreement in line with Art. 28 GDPR and without being able to use it for their own purposes:</p>
        <ul>
            <li>Web hosting provider, where form messages are stored.</li>
            <li>Email provider, through which each message notification is received and replies are sent.</li>
        </ul>
        <p><strong>Embedded third-party services.</strong> Only if you accept third-party cookies are the Doctoralia calendar and certificate (Docplanner, based in the EU) and the Google Maps map (Google) loaded in your browser. Google may transfer technical browsing data to the United States; this transfer is covered by the EU-US Data Privacy Framework (European Commission adequacy decision of 10 July 2023). If you book through Doctoralia, that platform processes your data under its own privacy policy.</p>

        <h2>6. Your Rights as a User</h2>
        <p>You may exercise your rights at any time:</p>
        <ul>
            <li><strong>Access:</strong> Find out what data of yours we process.</li>
            <li><strong>Rectification:</strong> Request correction of inaccurate or incomplete data.</li>
            <li><strong>Erasure («right to be forgotten»):</strong> Request deletion of your data when it is no longer necessary.</li>
            <li><strong>Restriction of processing and Objection:</strong> Restrict or refuse certain uses.</li>
            <li><strong>Portability:</strong> Receive your data in a structured, commonly used format.</li>
        </ul>
        <p>
            To exercise these rights, simply send a written request to <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a> with «Data Protection» in the subject line, proving your identity. You also have the right to lodge a complaint with the Spanish Data Protection Agency (<a href="https://www.aepd.es" target="_blank" rel="noopener">www.aepd.es</a>) if you believe your rights have been infringed.
        </p>

        <p class="legal-updated">
            <em>Last updated: November 2026.</em>
        </p>
    </article>
