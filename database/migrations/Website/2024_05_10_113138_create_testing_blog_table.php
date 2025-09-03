    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateTestingBlogTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create("testing_blog", function (Blueprint $table) {
                $table->id();
                $table->string('post_id')->nullable();
                $table->text('title')->nullable();
                $table->longtext('content')->nullable();
                $table->text('excerpt')->nullable();
                $table->integer('author')->nullable();
                $table->date('date')->nullable();
                $table->integer('status')->default(1);
                $table->text('slug')->nullable();
                $table->integer('show_new_icon')->default(0);
                $table->text('custom_link')->nullable();
                $table->text('attachment_img')->nullable();
                $table->text('attachment_file')->nullable();
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
            Schema::dropIfExists("testing_blog");
        }
    }


