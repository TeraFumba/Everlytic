<?php

namespace Tests\Unit;

use Faker\Factory as Faker;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    /**
     * test store function
     *
     * @return void
     */
    public function test_employee_store()
    {
        $faker = Faker::create();

        $response = $this->call('POST', '/employee/create', [
            'first_name'    =>  'John',
            'last_name'     =>  'Doe',
            'position'      =>  'PHP Developer',
            'email'         =>  $faker->email,
        ]);

        $response->assertStatus($response->getStatusCode(), 200);
    }

    /**
     * list all data
     * @return void
     */
    public function test_employee_list()
    {
        $response = $this->get('/');
        $response->assertStatus( 200);
    }

    /**
     * delete created data
     * @return void
     */
    public function test_employee_delete()
    {
        $response = $this->call('DELETE', '/employee/delete/1', ['_token' => csrf_token()]);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
