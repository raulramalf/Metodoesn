<?php
use PHPUnit\Framework\TestCase;

final class SecurityAndSeoTest extends TestCase
{
    protected function setUp(): void { $_GET = []; $_SESSION = []; $_COOKIE = []; }

    public function testNonceIsStablePerRequestAndUrlSafe(): void
    {
        $this->assertSame(csp_nonce(), csp_nonce());
        $this->assertMatchesRegularExpression('/^[A-Za-z0-9_-]{22}$/', csp_nonce());
    }

    public function testCspHasStrictDirectivesAndAllowsRequiredThirdParties(): void
    {
        $csp = csp_policy();
        $this->assertStringContainsString("default-src 'self'", $csp);
        $this->assertStringContainsString("object-src 'none'", $csp);
        $this->assertStringContainsString("base-uri 'self'", $csp);
        $this->assertStringContainsString("frame-ancestors 'self'", $csp);
        $this->assertStringContainsString("form-action 'self'", $csp);
        $this->assertStringContainsString('nonce-' . csp_nonce(), $csp);
        $this->assertStringContainsString('https://platform.docplanner.com', $csp);
        $this->assertStringContainsString('https://fonts.googleapis.com', $csp);
        $this->assertStringContainsString('https://fonts.gstatic.com', $csp);
        $this->assertStringContainsString('https://maps.google.com', $csp);
        preg_match("/script-src ([^;]+)/", $csp, $m);
        $this->assertStringNotContainsString('unsafe-inline', $m[1]);
        $this->assertStringNotContainsString('unsafe-eval', $m[1]);
    }

    public function testHstsOnlyOverHttps(): void
    {
        unset($_SERVER['HTTPS']);
        $this->assertArrayNotHasKey('Strict-Transport-Security', security_headers());
        $_SERVER['HTTPS'] = 'on';
        $h = security_headers();
        $this->assertStringContainsString('preload', $h['Strict-Transport-Security']);
        $this->assertStringContainsString('includeSubDomains', $h['Strict-Transport-Security']);
        unset($_SERVER['HTTPS']);
    }

    public function testBaselineHeaders(): void
    {
        $h = security_headers();
        $this->assertSame('nosniff', $h['X-Content-Type-Options']);
        $this->assertSame('SAMEORIGIN', $h['X-Frame-Options']);
        $this->assertSame('strict-origin-when-cross-origin', $h['Referrer-Policy']);
        $this->assertStringContainsString('camera=()', $h['Permissions-Policy']);
    }

    public function testSeoUrlsAndHreflang(): void
    {
        $this->assertSame('https://metodoesn.com/', seo_url('index.php', 'es'));
        $this->assertSame('https://metodoesn.com/servicios.php?lang=en', seo_url('servicios.php', 'en'));
        $links = seo_hreflang_links('dudas.php');
        foreach (['es', 'en', 'de', 'x-default'] as $l) $this->assertStringContainsString("hreflang=\"$l\"", $links);
    }

    public function testSeoCurrentScriptIsWhitelisted(): void
    {
        $_SERVER['SCRIPT_NAME'] = '/evil"><script>.php';
        $this->assertSame('index.php', seo_current_script());
        $_SERVER['SCRIPT_NAME'] = '/index.php';
    }

    public function testJsonLdGraphAndSafeSerialisation(): void
    {
        $g = seo_jsonld('dudas.php', 'es', [['¿P?', 'R </script><b>']]);
        $types = array_map(fn($n) => $n['@type'], $g['@graph']);
        $this->assertContains('FAQPage', $types);
        $this->assertContains('Person', $types);
        $tag = seo_jsonld_tag($g);
        $this->assertSame(1, substr_count($tag, '</script>'));          // el payload no puede cerrar el script
        $this->assertJson(preg_replace('/^<script[^>]*>|<\/script>$/', '', $tag));
        $this->assertStringContainsString(SITE_COLLEGIATE_NUMBER, $tag);
    }
}
