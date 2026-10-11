<?php

namespace Tests\Feature;

use App\Mail\OtpMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OtpMailTest extends TestCase
{
    use RefreshDatabase;

    public function test_otp_email_contains_embedded_logo(): void
    {
        Mail::fake();

        Mail::to('tes@mail.com')->send(new OtpMail('123456'));

        Mail::assertSent(OtpMail::class, function (OtpMail $mail) {
            $raw = $mail->render();

            $this->assertStringContainsString('src="data:image/png;base64,', $raw, 'Email harus memuat logo GoZay sebagai gambar inline');
            $this->assertStringContainsString('alt="GoZay"', $raw, 'Email harus memuat logo GoZay');

            return true;
        });
    }
}