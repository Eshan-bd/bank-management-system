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

class AssetsTest extends TestCase
{
    protected $prefix = '/voyager-assets?path=';

    public function setUp(): void
    {
        parent::setUp();

        Auth::loginUsingId(1);
    }

    public function testCanOpenFileInAssets()
    {
        $url = route('voyager.dashboard').$this->prefix.'css/app.css';

        $response = $this->call('GET', $url);
        $this->assertEquals(200, $response->status(), $url.' did not return a 200');
    }

    public function urlProvider()
    {
        return [
            [
                '../dummy_content/pages/page1.jpg',
                '..../dummy_content/pages/page1.jpg',
                'images/../../dummy_content/pages/page1.jpg',
                '....//dummy_content/pages/page1.jpg',
                '..\dummy_content/pages/page1.jpg',
                '....\dummy_content/pages/page1.jpg',
                'images/..\..\dummy_content/pages/page1.jpg',
                'images/....\\....\\dummy_content/pages/page1.jpg',
            ],
        ];
    }

    /**
     * @dataProvider  urlProvider
     */
    public function testCannotOpenFileOutsideAssets($url)
    {
        $response = $this->call('GET', route('voyager.dashboard').$this->prefix.$url);
        $this->assertEquals(404, $response->status(), $url.' did not return a 404');
    }
}
