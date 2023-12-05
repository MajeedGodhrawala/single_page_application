<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Routing\Route;
use Tests\TestCase;

// use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function setUp() :void
    {
        parent::setUp();

        $this->actingAs(User::first());

    }

    public function test_role_table()
    {
        $response = $this->post(route('roles.data_table'));
        $response->assertStatus(200);
    }

    public function test_create_role()
    {
        $data = [
            'id' => '',
            'name' => 'test',
            'display_name' => 'Test',
            'guard_name' => 'api',
        ];

        $response = $this->post(route('roles.create_or_update'),$data);

        $response->assertStatus(200);

        $this->assertDatabaseCount('roles', 3);

        $this->assertDatabaseHas('roles', [
            'name' => 'test',
            'display_name' => 'Test',
        ]);
    }

    public function test_update_role()
    {
        $data = [
            'id' => 3,
            'name' => 'test1',
            'display_name' => 'Test1',
            'guard_name' => 'api',
        ];

        $response = $this->post(route('roles.create_or_update',3),$data);

        $response->assertStatus(200);

        $this->assertDatabaseCount('roles', 3);

        $this->assertDatabaseHas('roles',[
            'name' => 'test1',
            'display_name' => 'Test1',
        ]);

        $this->assertDatabaseMissing('roles',[
            'name' => 'test',
            'display_name' => 'Test',
            'guard_name' => 'api',
        ]);
    }

    public function test_destroy_role(){
        $response = $this->get(route('roles.destroy',3));

        $response->assertStatus(200);

        $this->assertDatabaseCount('roles',2);

        $this->assertDatabaseMissing('roles',[
            'name' => 'test',
            'display_name' => 'Test',
            'guard_name' => 'api',
        ]);
    }

    public function test_role_form_validation(){
        $pattern_1 = [
            'name' => '',
            'display_name' => '',
            'guard_name' => '',
        ];

        $response = $this->post(route('roles.create_or_update'),$pattern_1);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name',
        ]);

        $pattern_2 = [
            'name' => 'admin',
            'display_name' => 'Admin',
            'guard_name' => 'api',
        ];

        $response = $this->post(route('roles.create_or_update'),$pattern_2);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name',
        ]);
    }
}
