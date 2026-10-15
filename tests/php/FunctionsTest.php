<?php
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class FunctionsTest extends TestCase
{
    protected function setUp(): void { $_SESSION = []; $_GET = []; $_SERVER['REMOTE_ADDR'] = '203.0.113.9'; unset($_SERVER['HTTP_X_FORWARDED_FOR']); }

    #[DataProvider('xssPayloads')]
    public function testEscapeNeutralisesXss(string $payload): void
    {
        $out = e($payload);
        $this->assertStringNotContainsString('<', $out);
        $this->assertStringNotContainsString('"', $out);
        $this->assertStringNotContainsString("'", $out);
    }

    public static function xssPayloads(): array
    {
        return [
            ['<script>alert(1)</script>'],
            ['" onmouseover="alert(1)'],
            ["' onfocus='alert(1)"],
            ['<img src=x onerror=alert(1)>'],
            ['</textarea><svg/onload=alert(1)>'],
        ];
    }

    public function testEscapeHandlesNullAndKeepsUnicode(): void
    {
        $this->assertSame('', e(null));
        $this->assertSame('Sánchez &amp; Novo', e('Sánchez & Novo'));
        $this->assertSame('&lt;b&gt;ñ&lt;/b&gt;', e('<b>ñ</b>'));
    }

    public function testEscapeDoesNotDoubleEncodeBrokenUtf8WithoutLeakingMarkup(): void
    {
        $this->assertSame('', e("\xC3\x28<script>")); // UTF-8 inválido => cadena vacía (sin salida peligrosa)
    }

    public function testAssetHelpers(): void
    {
        $this->assertSame('/assets/css/style.css', asset('css/style.css'));
        $this->assertSame('/assets/css/style.css', asset('/css/style.css'));
        $this->assertSame('/assets/img/logo.png', img('logo.png'));
    }

    public function testSanitizeStripsNullBytesAndControlChars(): void
    {
        $this->assertSame('Anaabc', sanitize_text("Ana\0\x07abc"));
        $this->assertSame("a\nb", sanitize_text("a\r\nb\x00", true));
    }

    public function testSanitizeSingleLineCollapsesWhitespace(): void
    {
        $this->assertSame('Ana María', sanitize_text("  Ana \n\t  María  "));
    }

    public function testSanitizeRejectsInvalidUtf8(): void
    {
        $this->assertNull(sanitize_text("\xC3\x28"));
        $this->assertNull(sanitize_text("abc\xFF"));
    }

    public function testSanitizeRemovesBidiAndZeroWidthTricks(): void
    {
        $this->assertSame('admin', sanitize_text("ad\u{200B}min"));
        $this->assertSame('abc', sanitize_text("a\u{202E}b\u{2066}c\u{FEFF}"));
    }

    public function testSanitizeNormalisesFullwidthCompatibilityForms(): void
    {
        if (!class_exists('Normalizer')) $this->markTestSkipped('ext-intl no disponible');
        $this->assertSame('admin@x.es', sanitize_text('ａｄｍｉｎ＠ｘ．ｅｓ'));
    }

    public function testSanitizeKeepsLegitimateAccentsAndEmoji(): void
    {
        $this->assertSame('José Ñandú 🍎', sanitize_text('José Ñandú 🍎'));
    }

    public function testMixedScriptHomoglyphDetection(): void
    {
        $this->assertTrue(has_mixed_script_word("Elena S\u{0430}nchez"));   // 'а' cirílica dentro de palabra latina
        $this->assertTrue(has_mixed_script_word("p\u{03B1}ypal"));          // α griega
        $this->assertFalse(has_mixed_script_word('Elena Sánchez Novo'));
        $this->assertFalse(has_mixed_script_word('Иван Петров'));           // cirílico puro es legítimo
    }

    public function testClientIpIgnoresForwardedHeaderFromUntrustedPeer(): void
    {
        $_SERVER['HTTP_X_FORWARDED_FOR'] = '1.2.3.4';
        $this->assertSame('203.0.113.9', client_ip());
    }

    public function testClientIpFallsBackOnGarbage(): void
    {
        $_SERVER['REMOTE_ADDR'] = 'not-an-ip';
        $this->assertSame('0.0.0.0', client_ip());
    }

    public function testNavClass(): void
    {
        $_SERVER['SCRIPT_NAME'] = '/servicios.php';
        $this->assertSame('is-active', nav_class('servicios.php'));
        $this->assertSame('', nav_class('dudas.php'));
        $_SERVER['SCRIPT_NAME'] = '/index.php';
    }
}
