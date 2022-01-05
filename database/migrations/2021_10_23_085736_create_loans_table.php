<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Account;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loantype');
            $table->double('loanamount', 15, 8)->default(0.0000);
            $table->double('loaninterestrate', 5, 3)->default(0.00);
            $table->double('amountpaid', 15, 8)->default(0.0000);
            $table->date('loanapprovedate');
            $table->string('loandocument');
            $table->string('loanstatus');
            $table->foreignIdFor(Account::class)->constrained();
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
        Schema::dropIfExists('loans');
    }
}
