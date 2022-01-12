<?php

namespace Tests\Unit;

use App\Account;
use App\Admin;
use App\User;
use App\BankUser;
use App\Loan;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;


class webTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function test_index()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_reserve(){
        $response = $this->get('/reservation');
        $response->assertStatus(405);
    }
    public function test_contact(){
        $response = $this->get('/contact');
        $response->assertStatus(405);
    }

    public function test_reservationindex()
    {
        $response = $this->get('reservation');
        $response->assertStatus(405);
    }

    public function test_contactcontrollerindex()
    {
        $response = $this->get('contact');
        $response->assertStatus(405);
    }


}
