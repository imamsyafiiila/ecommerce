<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProductecom extends Migration
{
    private $table = 'tbl_productecom';
    private $prefix = 'pro_';
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
            $table->text($this->prefix.'product');
            $table->text($this->prefix.'shipping_address');
            $table->integer($this->prefix.'price');
            $table->string($this->prefix.'shipping_code')->nullable();
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
