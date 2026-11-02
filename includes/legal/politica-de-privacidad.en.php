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
        <p>Through the website we process basic identification and contact data (name, surname, email address, phone number and the general reason for your enquiry). Please do not send detailed medical or sensitive information in the open message of the general form; the full clinical history is always taken in the secure setting of the consultation or with specific medical consent.</p>

        <h2>4. Data Retention</h2>
        <p>
            Data provided for enquiries is kept for as long as necessary to resolve your request. With each contact form message we store only an encrypted, irreversible fingerprint of your IP address (not the IP address itself) to prevent abusive submissions; this fingerprint is deleted automatically after <?= IP_RETENTION_DAYS ?> days. If a nutrition or training plan is started, clinical data is kept in accordance with the legal periods set by Spanish healthcare regulations (at least 5 years from the last care provided).
        </p>

        <h2>5. Recipients and Data Sharing</h2>
        <p>
            Your data will not be disclosed to third parties, except where expressly required by law or where indispensable for providing the healthcare service (for example, appointment management through the secure Doctoralia platform or clinical analysis laboratories with your prior authorisation).
        </p>

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
            <em>Last updated: October <?= date('Y') ?>.</em>
        </p>
    </article>
