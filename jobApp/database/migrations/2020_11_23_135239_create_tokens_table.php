<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->bigIncrements('tokenID')->index();
            $table->string('token')->nullable();
            $table->string('signature')->nullable();            
            $table->string('verify_token')->nullable();
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('UserID')->on('users')->onDelete('cascade');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. 1a713378be7badbbc1aa921bfdfd99a11855a7a33720f3fc88896924469e3d66a42c3f8257a663acdf58340482c6cdc9
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}
