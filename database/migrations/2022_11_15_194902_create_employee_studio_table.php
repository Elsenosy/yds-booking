<?php

use App\Models\Studio;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_studio', function (Blueprint $table) {
            $table->foreignId('employee_id')->constrained((new User)->getTable())->cascadeOnDelete();
            $table->foreignId('studio_id')->constrained((new Studio)->getTable())->cascadeOnDelete();
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
        Schema::dropIfExists('employee_studio');
    }
};
