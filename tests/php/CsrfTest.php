<?php
use PHPUnit\Framework\TestCase;

final class CsrfTest extends TestCase
{
    protected function setUp(): void { $_SESSION = []; }

    public function testTokenIs256BitHexAndStable(): void
    {
        $t = csrf_token();
        $this->assertMatchesRegularExpression('/^[0-9a-f]{64}$/', $t);
        $this->assertSame($t, csrf_token());
    }

    public function testValidTokenPasses(): void
    {
        $this->assertTrue(csrf_check(csrf_token()));
    }

    public function testRejectsMissingWrongAndNonStringTokens(): void
    {
        $this->assertFalse(csrf_check(null));            // sin token de sesión
        csrf_token();
        $this->assertFalse(csrf_check(null));
        $this->assertFalse(csrf_check(''));
        $this->assertFalse(csrf_check(str_repeat('a', 64)));
    }

    public function testTokensAreUniquePerSession(): void
    {
        $a = csrf_token(); $_SESSION = []; $b = csrf_token();
        $this->assertNotSame($a, $b);
    }

    public function testRotationInvalidatesOldToken(): void
    {
        $old = csrf_token();
        csrf_rotate();
        $this->assertFalse(csrf_check($old));
        $this->assertNotSame($old, csrf_token());
    }

    public function testExpiredTokenIsRejectedAndRegenerated(): void
    {
        $old = csrf_token();
        $_SESSION['csrf_ts'] = time() - CSRF_TTL - 5;
        $this->assertFalse(csrf_check($old));
        $this->assertNotSame($old, csrf_token());
    }
}
