<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPrepaidbalance extends Migration
{
    private $table = 'tbl_prepaidbalance';
    private $prefix = 'pre_';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments($this->prefix.'id');
            $table->integer($this->prefix.'ord_id');
            $table->string($this->prefix.'phone_number');
            $table->integer($this->prefix.'value');
            $table->timestamp($this->prefix.'created_at')->nullable();
            $table->timestamp($this->prefix.'updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
