<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bettings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->bigInteger('betting_id');
            $table->text('ref_no');
            $table->string('site');
            $table->string('product');
            $table->string('member');
            $table->string('gameid');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('match_time');
            $table->longText('bet_detail');
            $table->double('turnover', 10, 2);
            $table->double('bet', 10, 2);
            $table->double('payout', 10, 2);
            $table->double('commission', 10, 2);
            $table->double('p_share', 10, 2);
            $table->double('p_win', 10, 2);
            $table->enum('status', ['1', '0', '-1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bettings');
    }
};
