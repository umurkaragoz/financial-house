<?php

namespace Dashboard;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_can_not_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
    }

    public function test_guests_can_not_access_transaction_details(): void
    {
        $response = $this->get('/dashboard/transaction-detail/abc');

        $response->assertStatus(302);
    }

    public function test_guests_can_not_access_client_details(): void
    {
        $response = $this->get('/dashboard/client-detail/abc');

        $response->assertStatus(302);
    }

    public function test_dashboard_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_transaction_details_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard/transaction-detail/abc');

        $response->assertStatus(200);
    }

    public function test_client_details_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard/client-detail/abc');

        $response->assertStatus(200);
    }


}
