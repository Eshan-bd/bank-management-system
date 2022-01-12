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

class UserTest extends TestCase
{

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

}