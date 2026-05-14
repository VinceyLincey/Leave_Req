<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaveRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_fails_if_fields_missing()
    {
        $response = $this->from('/leave_requests')->post('/leave_requests', []);
        $response->assertSessionHasErrors(['name', 'start_date', 'end_date', 'reason']);
    }

    public function test_end_date_cannot_be_before_start_date()
    {
        $response = $this->from('/leave_requests')->post('/leave_requests', [
            'name' => 'Test',
            'start_date' => '2026-05-20',
            'end_date' => '2026-05-18',
            'reason' => 'Test reason',
        ]);
        $response->assertSessionHasErrors('end_date');
    }

    public function test_valid_leave_request_is_stored()
    {
        $response = $this->from('/leave_requests')->post('/leave_requests', [
            'name' => 'Test User',
            'start_date' => '2026-05-20',
            'end_date' => '2026-05-22',
            'reason' => 'Annual leave',
        ]);
        $response->assertRedirect('/leave_requests');
        $this->assertDatabaseHas('leave_requests', ['name' => 'Test User']);
    }
}