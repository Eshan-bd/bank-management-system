<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Account;

class CreateLoanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->string('loantype');
            $table->double('loanamount', 15, 8)->default(0.0000);
            $table->string('loandocument');
            $table->string('loanrequeststatus');
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
        Schema::dropIfExists('loan_requests');
    }
}
