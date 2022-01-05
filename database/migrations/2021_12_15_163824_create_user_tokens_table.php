<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BankUser;

class CreateUserTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BankUser::class)->constrained();
            $table->string('userkey', 64);
            $table->dateTime('created_at');
            $table->dateTime('expired_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tokens');
    }
}
