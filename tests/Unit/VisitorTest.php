<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Visitor;

class VisitorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    // public function testCreateVisitor()
    // {
    //    $data = [
    //                     'name' => "New Product",
    //                     'date' => "2021-03-18 17:11:14",
    //                     'temperature' => 20,
    //                     'contact_number' => 101-23-345
    //                 ];
    //         $user = factory(\App\Visitor::class)->create();
    //         $response = $this->create($user, 'Visitor')->json('POST', '/Visitor/create',$data);
    //         $response->assertStatus(200);
    //        // $response->assertJson(['status' => true]);
    //         $response->assertJson(['message' => "Visitor created successfully"]);
    //         $response->assertJson(['data' => $data]);
    //   }
}
