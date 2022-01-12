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

class HomeTest extends TestCase
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
    public function sendMessage() {
        $this->data = new ContactController;
        $request = new Request(['name' => 'bleh',
                    'email' => 'm@gmail.com', 'subj' => 'hbn',
                    'mess' => 'baduhsd',]);
        $d = Contact::where('usertype', '0')->inRandomOrder()->limit(1)->get();
        $response = $this->data->sendMessage($request, $d[0]->id);
        $this->assertTrue(true);
    }
    public function index()
    {
        $this->data = new HomeController;
        $sliders = Slider::all();
        $categories = Category::all();
        $items = Item::all();
        $response = $this->data->index();
        $this->assertEquals($response ,view('welcome',compact('sliders','categories','items')));
    }

}
