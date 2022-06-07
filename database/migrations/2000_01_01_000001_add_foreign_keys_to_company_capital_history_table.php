<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCompanyCapitalHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_capital_history', function (Blueprint $table) {
            $table->foreign(['company_id'], 'company_capital_history_ibfk_1')->references(['id'])->on('companies')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'company_capital_history_ibfk_2')->references(['id'])->on('loan_histories')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['loan_history_id'], 'company_capital_history_ibfk_3')->references(['id'])->on('loan_histories')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'company_capital_history_ibfk_4')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_capital_history', function (Blueprint $table) {
            $table->dropForeign('company_capital_history_ibfk_1');
            $table->dropForeign('company_capital_history_ibfk_2');
            $table->dropForeign('company_capital_history_ibfk_3');
            $table->dropForeign('company_capital_history_ibfk_4');
        });
    }
}