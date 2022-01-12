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

class FormTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Auth::loginUsingId(1);
    }

    public function testFormText()
    {
        $this->createBreadForForm('text', 'text', json_encode([
            'default' => 'Default Text',
            'null'    => 'NULL',
        ]));
        $this->visitRoute('voyager.categories.create')
        ->see('Default Text')
        ->type('New Text', 'text')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('New Text')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('Edited Text', 'text')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Edited Text')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('NULL', 'text')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->seeInDatabase('categories', [
            'text' => null,
        ]);
    }

    public function testFormTextbox()
    {
        $this->createBreadForForm('text', 'text_area', json_encode([
            'default' => 'Default Text',
        ]));

        $this->visitRoute('voyager.categories.create')
        ->see('Default Text')
        ->type('New Text', 'text_area')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('New Text')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('Edited Text', 'text_area')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Edited Text');
    }

    public function testFormCodeeditor()
    {
        $this->createBreadForForm('text', 'code_editor', json_encode([
            'default' => 'Default Text',
        ]));

        $this->visitRoute('voyager.categories.create')
        ->see('Default Text')
        ->type('New Text', 'code_editor')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('New Text')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('Edited Text', 'code_editor')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Edited Text');
    }

    public function testFormMarkdown()
    {
        $this->createBreadForForm('text', 'markdown_editor');

        $this->visitRoute('voyager.categories.create')
        ->type('# New Text', 'markdown_editor')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('New Text')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('# Edited Text', 'markdown_editor')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Edited Text');
    }

    public function testFormRichtextbox()
    {
        $this->createBreadForForm('text', 'rich_text_box');

        $this->visitRoute('voyager.categories.create')
        ->type('New Text', 'rich_text_box')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('New Text')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('Edited Text', 'rich_text_box')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Edited Text');
    }

    public function testFormHidden()
    {
        $this->createBreadForForm('text', 'hidden', json_encode([
            'default' => 'Default Text',
        ]));

        $this->visitRoute('voyager.categories.create')
        ->see('Default Text')
        ->type('New Text', 'hidden')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('New Text')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('Edited Text', 'hidden')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Edited Text');
    }

    public function testFormPassword()
    {
        $this->createBreadForForm('text', 'password');

        $t = $this->visitRoute('voyager.categories.create')
        ->type('newpassword', 'password')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index');
        $this->assertTrue(Hash::check('newpassword', Category::first()->password));

        $t->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index');
        $this->assertTrue(Hash::check('newpassword', Category::first()->password));
    }

    public function testFormNumber()
    {
        $this->createBreadForForm('integer', 'number', json_encode([
            'default' => 1,
        ]));

        $this->visitRoute('voyager.categories.create')
        ->see('1')
        ->type('2', 'number')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('2')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('3', 'number')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('3');
    }

    public function testFormCheckbox()
    {
        $this->createBreadForForm('boolean', 'checkbox', json_encode([
            'on'  => 'Active',
            'off' => 'Inactive',
        ]));

        $this->visitRoute('voyager.categories.create')
        ->see('Inactive')
        ->check('checkbox')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Active')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->uncheck('checkbox')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Inactive');
    }

    public function testFormTime()
    {
        $this->createBreadForForm('time', 'time');

        $this->visitRoute('voyager.categories.create')
        ->type('12:50', 'time')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('12:50')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('6:25', 'time')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('6:25');
    }

    public function testFormDate()
    {
        $this->createBreadForForm('date', 'date', json_encode([
            'format' => '%Y-%m-%d',
        ]));

        $this->visitRoute('voyager.categories.create')
        ->type('2019-01-01', 'date')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('2019-01-01')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('2018-12-31', 'date')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('2018-12-31');
    }

    public function testFormTimestamp()
    {
        $this->createBreadForForm('timestamp', 'timestamp', json_encode([
            'format' => '%F %T',
        ]));

        $this->visitRoute('voyager.categories.create')
        ->type('2019-01-01 12:00:00', 'timestamp')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('2019-01-01 12:00:00')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('2018-12-31 23:59:59', 'timestamp')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('2018-12-31 23:59:59')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('', 'timestamp')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->seeInDatabase('categories', [
            'timestamp' => null,
        ]);
    }

    public function testFormColor()
    {
        $this->createBreadForForm('text', 'color');

        $this->visitRoute('voyager.categories.create')
        ->type('#FF0000', 'color')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('#FF0000')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->type('#00FF00', 'color')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('#00FF00');
    }

    public function testFormRadiobtn()
    {
        $this->createBreadForForm('text', 'radio_btn', json_encode([
            'default' => 'radio1',
            'options' => [
                'radio1' => 'Foo',
                'radio2' => 'Bar',
            ],
        ]));

        $this->visitRoute('voyager.categories.create')
        ->select('radio1', 'radio_btn')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Foo')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->select('radio2', 'radio_btn')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Bar');
    }

    public function testFormSelectDropdown()
    {
        $this->createBreadForForm('text', 'select_dropdown', json_encode([
            'default' => 'radio1',
            'options' => [
                'option1' => 'Foo',
                'option2' => 'Bar',
            ],
        ]));

        $this->visitRoute('voyager.categories.create')
        ->select('option1', 'select_dropdown')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Foo')
        ->click(__('voyager::generic.edit'))
        ->seeRouteIs('voyager.categories.edit', 1)
        ->select('option2', 'select_dropdown')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->see('Bar');
    }

    public function testFormFile()
    {
        $this->createBreadForForm('text', 'file');
        $file = UploadedFile::fake()->create('test.txt', 1);
        $this->visitRoute('voyager.categories.create')
        ->attach([$file->getPathName()], 'file[]')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->visitRoute('voyager.categories.create')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->seeInDatabase('categories', [
            'file' => '[]',
        ]);
    }

    public function testFormFilePreserve()
    {
        $this->createBreadForForm('text', 'file', json_encode([
            'preserveFileUploadName' => true,
        ]));
        $file = UploadedFile::fake()->create('test.txt', 1);
        $this->visitRoute('voyager.categories.create')
        ->attach([$file->getPathName()], 'file[]')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->visitRoute('voyager.categories.create')
        ->press(__('voyager::generic.save'))
        ->seeRouteIs('voyager.categories.index')
        ->seeInDatabase('categories', [
            'file' => '[]',
        ]);
    }

    private function createBreadForForm($type, $name, $options = '')
    {
        Schema::dropIfExists('categories');
        Schema::create('categories', function ($table) use ($type, $name) {
            $table->bigIncrements('id');
            $table->{$type}($name)->nullable();
            $table->timestamps();
        });

        // Delete old BREAD
        $this->delete(route('voyager.bread.delete', ['id' => DataType::where('name', 'categories')->first()->id]));

        // Create BREAD
        $this->visitRoute('voyager.bread.create', ['table' => 'categories'])
        ->select($name, 'field_input_type_'.$name)
        ->type($options, 'field_details_'.$name)
        ->type('TCG\\Voyager\\Models\\Category', 'model_name')
        ->press(__('voyager::generic.submit'))
        ->seeRouteIs('voyager.bread.index');

        // Attach permissions to role
        Auth::user()->role->permissions()->syncWithoutDetaching(Permission::all()->pluck('id'));
    }
}
