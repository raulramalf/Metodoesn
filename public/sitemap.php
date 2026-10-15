<?php
// Sitemap multilingüe con xhtml:link hreflang. Servido como /sitemap.xml (ver .htaccess / nginx.conf).
require_once __DIR__ . '/../src/functions.php';
require_once __DIR__ . '/../src/seo.php';

header('Content-Type: application/xml; charset=UTF-8');
header('Cache-Control: public, max-age=3600');

$langs = array_keys(supported_languages());
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach (seo_pages() as $script => [$prio, $freq, $indexable]):
    if (!$indexable) continue;
    $file = __DIR__ . '/' . $script;
    $lastmod = is_file($file) ? gmdate('Y-m-d', filemtime($file)) : gmdate('Y-m-d');
    foreach ($langs as $l): ?>
  <url>
    <loc><?= htmlspecialchars(seo_url($script, $l), ENT_XML1) ?></loc>
    <lastmod><?= $lastmod ?></lastmod>
    <changefreq><?= $freq ?></changefreq>
    <priority><?= number_format($prio, 1) ?></priority>
<?php foreach ($langs as $alt): ?>
    <xhtml:link rel="alternate" hreflang="<?= $alt ?>" href="<?= htmlspecialchars(seo_url($script, $alt), ENT_XML1) ?>"/>
<?php endforeach; ?>
    <xhtml:link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars(seo_url($script, 'es'), ENT_XML1) ?>"/>
  </url>
<?php endforeach; endforeach; ?>
</urlset>
