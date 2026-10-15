<?php
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class I18nTest extends TestCase
{
    protected function setUp(): void { $_SESSION = []; $_GET = []; $_COOKIE = []; $_SERVER['REQUEST_URI'] = '/servicios.php?x=1'; }

    public function testSupportedLanguages(): void
    {
        $this->assertSame(['es', 'en', 'de'], array_keys(supported_languages()));
    }

    public function testDefaultsToSpanish(): void
    {
        $this->assertSame('es', current_lang());
    }

    #[DataProvider('validLangs')]
    public function testGetParamSelectsAndPersistsLanguage(string $lang): void
    {
        $_GET['lang'] = $lang;
        $this->assertSame($lang, current_lang());
        $_GET = [];
        $this->assertSame($lang, current_lang());          // persistido en sesión
    }
    public static function validLangs(): array { return [['es'], ['en'], ['de']]; }

    #[DataProvider('invalidLangs')]
    public function testUnsupportedLanguageFallsBackToSpanish(mixed $bad): void
    {
        $_GET['lang'] = $bad;
        $this->assertSame('es', current_lang());
    }
    public static function invalidLangs(): array
    {
        return [['fr'], ['EN'], [''], ['../../etc/passwd'], ['en<script>'], [['en']], ['es ']];
    }

    public function testInvalidParamDoesNotOverrideValidSession(): void
    {
        $_SESSION['site_lang'] = 'de';
        $_GET['lang'] = 'xx';
        $this->assertSame('de', current_lang());
    }

    public function testCookieUsedWhenNoSessionAndTamperedCookieIgnored(): void
    {
        $_COOKIE['site_lang'] = 'en';
        $this->assertSame('en', current_lang());
        $_SESSION = []; $_COOKIE['site_lang'] = 'zz';
        $this->assertSame('es', current_lang());
    }

    public function testTranslationsAndFallbackChain(): void
    {
        $all = translations();
        $this->assertArrayHasKey('nav_home', $all['es']);
        $_GET['lang'] = 'en';
        $this->assertNotSame('', t('nav_home'));
        $this->assertSame('fallback-x', t('clave_inexistente_xyz', 'fallback-x'));
        $this->assertSame('clave_inexistente_xyz', t('clave_inexistente_xyz'));
    }

    public function testUnsupportedLanguageRendersSpanishStrings(): void
    {
        $_GET['lang'] = 'fr';
        $this->assertSame(translations()['es']['nav_home'], t('nav_home'));
    }

    public function testAllLanguagesCoverSpanishKeys(): void
    {
        $all = translations();
        foreach (['en', 'de'] as $l) {
            $missing = array_diff(array_keys($all['es']), array_keys($all[$l]));
            $this->assertSame([], array_values($missing), "Claves sin traducir en $l");
        }
    }

    public function testLangUrlPreservesPathAndQueryAndReplacesLang(): void
    {
        $_SERVER['REQUEST_URI'] = '/dudas.php?x=1&lang=en';
        $this->assertSame('/dudas.php?x=1&lang=de', lang_url('de'));
    }

    public function testPageUrlKeepsLangForNonDefault(): void
    {
        $this->assertSame('/contacto.php', page_url('/contacto.php'));
        $_GET['lang'] = 'de';
        $this->assertSame('/contacto.php?lang=de', page_url('/contacto.php'));
        $this->assertSame('/a.php?b=1&lang=de', page_url('/a.php?b=1'));
    }

    public function testFlagSvgIsAriaHiddenAndEmptyForUnknown(): void
    {
        foreach (['es', 'en', 'de'] as $l) $this->assertStringContainsString('aria-hidden="true"', flag_svg($l));
        $this->assertSame('', flag_svg('xx'));
    }
}
