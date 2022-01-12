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

class AdminTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function test_index()
    {
        $this->data = new CategoryController;
        $response = $this->data->index();
        $data = Category::all();
        $this->assertTrue(true);

    }
    public function test_create()
    {
        $this->data = new CategoryController;
        $response = $this->data->create();
        $this->assertEquals($response , view('admin.category.create'));

    }
    public function test_store() {
        $this->data = new CategoryController;
        $request = new Request(['name' => 'Sample name'
        ]);
        $response = $this->data->store($request);
        $this->assertTrue(true);
    }
    public function test_edit() {
        $this->data = new CategoryController;
        $response = $this->data->edit(2);
        $data = Category::find(2);
        $this->assertEquals($response,view('admin.category.edit',compact('data')));
        
    }

    public function test_contactindex()
    {
        $this->data = new ContactController;
        $response = $this->data->index();
        $data = Contact::all();
        $this->assertEquals($response , view('admin.contact.index',compact('data')));
        
    }
    public function test_show()
    {
        $this->data = new ContactController;
        $response = $this->data->show(1);
        $data = Contact::find(1);
        $this->assertEquals($response , view('admin.contact.show',compact('data')));
        
    }
    public function test_sldideredit() {
        $this->data = new SliderController;
        $response = $this->data->edit(1);
        $data = Category::find(1);
        $this->assertEquals($response,view('admin.slider.edit',compact('data')));
        
    }


}
