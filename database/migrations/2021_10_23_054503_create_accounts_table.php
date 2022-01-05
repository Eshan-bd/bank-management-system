<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BankUser;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('accountname', 30)->unique();
            $table->string('accounttype', 20);
            $table->string('password');
            $table->double('accountbalance', 15, 8)->default(0.0000);
            $table->double('accountinterestrate', 5, 3)->default(0.0000);
            $table->string('accountdocument')->nullable();
            $table->string('accountstate');
            $table->foreignIdFor(BankUser::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
