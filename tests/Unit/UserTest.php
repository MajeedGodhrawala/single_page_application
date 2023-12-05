<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Routing\Route;
use Tests\TestCase;

// use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function setUp() :void
    {
        parent::setUp();

        $this->actingAs(User::first());

    }

    public function test_user_table()
    {
        $response = $this->post(route('users.data_table'));
        $response->assertStatus(200);
    }

    public function test_create_user()
    {
        $data = [
            'id' => '',
            'first_name' => 'First Name Test',
            'last_name' => 'Last Name Test',
            'email' => 'test@gmail.com',
            'phone_number' => '1234567890',
            'password' => '12345678',
            'confirm_password' => '12345678',
            'country' => 'India',
            'state' => 'Ahmedabad',
            'accept_privacy' => 1,
            'isactive'=> 1,
            'profile_img' => '',
        ];

        $response = $this->post(route('create_user'),$data);

        $response->assertStatus(200);

        $this->assertDatabaseCount('users', 4);

        $this->assertDatabaseHas('users', [
            'email' => 'test@gmail.com',
            'phone_number' => '1234567890',
        ]);
    }

    public function test_update_user()
    {
        $data = [
            'id' => 4,
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test1@gmail.com',
            'phone_number' => '1234567895',
            'password' => '12345678',
            'confirm_password' => '12345678',
            'country' => 'India',
            'state' => 'Ahmedabad',
            'accept_privacy' => 1,
            'isactive'=> 1,
            'profile_img' => '',
        ];

        $response = $this->post(route('users.create_or_update',4),$data);

        $response->assertStatus(200);

        $this->assertDatabaseCount('users', 4);

        $this->assertDatabaseHas('users',[
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test1@gmail.com',
            'phone_number' => '1234567895',
            'country' => 'India',
            'state' => 'Ahmedabad',
            'accept_privacy' => 1,
            'isactive'=> 1,
        ]);

        $this->assertDatabaseMissing('users',[
            'first_name' => 'First Name Test',
            'last_name' => 'Last Name Test',
            'email' => 'test@gmail.com',
            'phone_number' => '1234567890',
            'country' => 'India',
            'state' => 'Ahmedabad',
            'accept_privacy' => 1,
            'isactive'=> 1,
        ]);
    }

    public function test_destroy_user(){
        $response = $this->get(route('users.destroy',4));

        $response->assertStatus(200);

        $this->assertDatabaseCount('users',3);

        $this->assertDatabaseMissing('users',[
            'first_name' => 'First Name Test',
            'last_name' => 'Last Name Test',
            'email' => 'test@gmail.com',
            'phone_number' => '1234567890',
            'country' => 'India',
            'state' => 'Ahmedabad',
            'accept_privacy' => 1,
            'isactive'=> 1,
        ]);
    }

    public function test_user_form_validation(){
        $pattern_1 = [
            'id' => '',
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'phone_number' => '',
            'password' => '12345678',
            'confirm_password' => '12345678',
            'country' => '',
            'state' => '',
            'accept_privacy' => 0,
            'isactive'=> 0,
            'profile_img' => '',
        ];

        $response = $this->post(route('create_user'),$pattern_1);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'email',
            'phone_number',
        ]);

        $pattern_2 = [
            'id' => '',
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test',
            'phone_number' => '343434343',
            'password' => '12345678',
            'confirm_password' => '12345678',
            'country' => '',
            'state' => '',
            'accept_privacy' => 1,
            'isactive'=> 1,
            'profile_img' => '',
        ];

        $response = $this->post(route('create_user'),$pattern_2);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email',
            'phone_number',
        ]);

        $pattern_3 = [
            'id' => '',
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test@gmail.com',
            'phone_number' => '3434343434',
            'password' => '1234567',
            'confirm_password' => '1234567890',
            'country' => '',
            'state' => '',
            'accept_privacy' => 1,
            'isactive'=> 1,
            'profile_img' => '',
        ];

        $response = $this->post(route('create_user'),$pattern_3);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'password',
            'confirm_password'
        ]);

        $pattern_4 = [
            'id' => '',
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test@gmail.com',
            'phone_number' => '3434343434',
            'password' => '',
            'confirm_password' => '123456789',
            'country' => '',
            'state' => '',
            'accept_privacy' => 1,
            'isactive'=> 1,
            'profile_img' => '',
        ];

        $response = $this->post(route('create_user'),$pattern_4);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'password',
            'confirm_password'
        ]);

    }

    // public function test_that_true_is_true(): void
    // {
    //     $this->assertTrue(true);
    // }
}
