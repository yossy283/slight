<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('ユーザID');
            $table->unsignedInteger('tweet_id')->comment('ツイートID');
            $table->string('text')->comment('本文');
            $table->softDeletes(); //データを削除するときは、復元可能な削除ソフトデリートだと設定
            $table->timestamps();

            $table->index('id');
            $table->index('user_id');
            $table->index('tweet_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade') //紐づけたデータが削除されたとき、一緒に削除
                ->onUpdate('cascade'); //紐づけたデータが更新されたとき、一緒に更新

            $table->foreign('tweet_id')
                ->references('id')
                ->on('tweets')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
