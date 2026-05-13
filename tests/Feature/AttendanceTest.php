<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test attendance index page loads successfully.
     */
    public function test_attendance_index_page_loads(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/attendances');

        $response->assertStatus(200);
        $response->assertViewIs('pages.absensi.index');
    }

    /**
     * Test attendance creation.
     */
    public function test_attendance_can_be_created(): void
    {
        $user = User::factory()->create();

        $attendance = Attendance::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'time_in' => now()->toTimeString(),
            'latlon_in' => '-6.2088,106.8456',
        ]);

        $this->assertDatabaseHas('attendances', [
            'user_id' => $user->id,
            'date' => now()->toDateString(),
        ]);
    }
}