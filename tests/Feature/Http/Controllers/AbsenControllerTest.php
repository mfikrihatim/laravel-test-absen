<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use App\Models\{Absen, Users};
use Illuminate\Support\Str;
use Tests\TestCase;

class AbsenControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_stores_data()
    {
        $absen = factory(Absen::class)->create();
        $response = $this->actingAs($absen)
            ->post('/api/permits', [
                  // 'id_absen'      => Str::uuid(),
                  // 'fk_id_users'   => 1,
                  'nama_user'     => $this->faker->name,
                  'izin'          => 1,
                  'keterangan'    => 'Izin',
                  'tanggal_izin'  => "[\"2021-09-12\",\"2021-09-11\",\"2021-09-13\"]",
                  'deleted_at'    => 0,
                  'created_at'    => date('Y-m-d H:s:i')
            ]);

        $response->assertStatus(200);
    }

    /**
    * @test
    */
    public function it_get_all()
    {

        $response = $this->call('GET', '/api/permits');
        $response->assertStatus(200);
    }

    /**
    * @test
    */
    public function it_by_id()
    {
        
        $response = $this->call('GET', '/api/permits/{id}');
        $response->assertStatus(200);
    }
}
