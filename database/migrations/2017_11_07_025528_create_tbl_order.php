<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblOrder extends Migration
{
    private $table = 'tbl_order';
    private $prefix = 'ord_';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table){
            $table->increments($this->prefix.'id');
            $table->string($this->prefix.'order_number');
            $table->string($this->prefix.'description');
            $table->integer($this->prefix.'amount');
            $table->integer($this->prefix.'status');
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
