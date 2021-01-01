<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Person;

class HelloTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function testHello()
    {

        factory(User::class)->create([
            'name' => 'AAA',
            'email' => 'BBB@CCC.com',
            'password' => 'ABCABC',
        ]);
        factory(User::class, 10)->create();

        $this->assertDatabaseHas('users', [
            'name' => 'AAA',
            'email' => 'BBB@CCC.com',
            'password' => 'ABCABC',
        ]);
        // factory(Person::class)->create([
        //     'name' => 'XXX',
        //     'mail' => 'YYY@ZZZZ.com',
        //     'age' => '50',
        // ]);
        // factory(Person::class, 10)->create();

        // $this->assertDatabaseHas('people', [
        //     'name' => 'XXX',
        //     'mail' => 'YYY@ZZZZ.com',
        //     'age' => '50',
        // ]);

        $this->assertTrue(true);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response = $this->get('/hello');
        $response->assertStatus(302);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/hello?page=1&sort=name');
        $response->assertStatus(500);

        $response = $this->get('/no_route');
        $response->assertStatus(404);

        $arr = [];
        $this->assertEmpty($arr);

        $msg = "Hello";
        $this->assertEquals('Hello', $msg);

        $n = random_int(0, 100);
        $this->assertLessThan(100, $n);
    }
}
