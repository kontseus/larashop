<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RolesTableSeeder;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    protected function afterRefreshingDatabase()
    {
        $this->seed(RolesTableSeeder::class);
    }

    public function test_reset_password_link_screen_can_be_rendered()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200);
    }

//    public function test_reset_password_link_can_be_requested()
//    {
//        Notification::fake();
//
//        $user = User::factory()->create();
//
//        $this->post(route('password.update'), ['email' => $user->email]);
//
//        Notification::assertSentTo($user, ResetPasswordNotification::class);
//    }
//
//    public function test_reset_password_screen_can_be_rendered()
//    {
//        Notification::fake();
//
//        $user = User::factory()->create();
//
//        $this->post(route('password.update'), ['email' => $user->email]);
//
//        Notification::assertSentTo($user, ResetPasswordNotification::class, function ($notification) {
//            $response = $this->get(route('password.reset', $notification->token));
//
//            $response->assertStatus(200);
//
//            return true;
//        });
//    }
//
//    public function test_password_can_be_reset_with_valid_token()
//    {
//        Notification::fake();
//
//        $user = User::factory()->create();
//
//        $this->post(route('password.update'), ['email' => $user->email]);
//
//        Notification::assertSentTo($user, ResetPasswordNotification::class, function ($notification) use ($user) {
//            $response = $this->post(route('password.reset', $notification->token), [
//                'email' => $user->email,
//                'password' => 'password',
//                'password_confirmation' => 'password',
//            ]);
//
//            $response->assertSessionHasNoErrors();
//
//            return true;
//        });
//    }
}
