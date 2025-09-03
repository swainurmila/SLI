<?php

namespace App\Traits;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use ReflectionClass;
use Illuminate\Support\Facades\Route;
use App\Models\Website\Post;
use Illuminate\Support\Facades\Storage;

trait PostTrait
{
    public function createModel($modelName,$id)
    {
        //dd($id);

        $postSlug = Post::where('id',$id)->first();
        $postSlug = $postSlug->post_slug;

        $routeName = $modelName;
        $routeName = explode('-', $modelName);
        $routeName = implode('-', array_map('strtolower', $routeName));
        $routeName = str_replace(' ', '-', $routeName);
        // dd($routeName);




        $tableName = strtolower($modelName);
        $tableName = str_replace(' ', '_', $tableName);
        //dd($tableName);

        //$tableName = lcfirst($modelName);
        //$modelName = ucfirst($modelName);
        $modelName = ucwords($modelName);
        $modelName = str_replace(' ', '', $modelName);




        // Artisan::call('make:migration', [
        //     'name' => "create_{$tableName}_table",
        //     '--create' => $tableName,
        // ]);





        //dd(1);

        Artisan::call('make:model', [
            'name' => $modelName,
        ]);

        $modelFilePath = app_path("Models/Website/$modelName.php");


        $appendedCode =
            <<<EOT
<?php

 namespace App\Models\Website;
 use Spatie\Sluggable\HasSlug;
 use Spatie\Sluggable\SlugOptions;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Spatie\Translatable\HasTranslations;

 class $modelName extends Model
  {

        use HasFactory,HasTranslations,HasSlug;
        protected \$table="$tableName";

        public \$translatable  = ['title', 'content','excerpt'];

        protected \$fillable = [
            'post_id',
            'title',
            'content',
            'excerpt',
            'author',
            'date',
            'status',
            'slug',
            'show_new_icon',
            'custom_link',
            'attachment_img',
            'attachment_file'
        ];
        public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public function setPostTypeTitleAttribute(\$value)
    {
        \$this->attributes['title'] = json_encode(\$value, JSON_UNESCAPED_UNICODE);
    }
    public function setPostTypeContentAttribute(\$value)
    {
        \$this->attributes['content'] = json_encode(\$value, JSON_UNESCAPED_UNICODE);

    }
    public function setPostTypeExcerptAttribute(\$value)
    {
        \$this->attributes['excerpt'] = json_encode(\$value, JSON_UNESCAPED_UNICODE);

    }

  }



EOT;


        File::put($modelFilePath, $appendedCode);

        // ============ End Model ============

        $command = 'make:migration';
        $options = [
            'name' => "create_{$tableName}_table",
            '--create' => $tableName,
        ];
        Artisan::call($command, $options);

        // Get the migration file name
        //$output = Artisan::output();
        //dd($output);

        $migrationFiles = File::glob(database_path('migrations/*_*.php'));
        $latestMigration = end($migrationFiles);
        $migrationFileName = pathinfo($latestMigration, PATHINFO_FILENAME);
        //dd($migrationFileName);


        $migrateFilePath = database_path("migrations/Website/$migrationFileName.php");
        $createTable = 'Create' . $modelName . 'Table';
        //dd($dds);

        $migratedCode =
            <<<EOT
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class $createTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create("$tableName", function (Blueprint \$table) {
                \$table->id();
                \$table->string('post_id')->nullable();
                \$table->text('title')->nullable();
                \$table->longtext('content')->nullable();
                \$table->text('excerpt')->nullable();
                \$table->integer('author')->nullable();
                \$table->date('date')->nullable();
                \$table->integer('status')->default(1);
                \$table->text('slug')->nullable();
                \$table->integer('show_new_icon')->default(0);
                \$table->text('custom_link')->nullable();
                \$table->text('attachment_img')->nullable();
                \$table->text('attachment_file')->nullable();
                \$table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists("$tableName");
        }
    }



EOT;




        File::put($migrateFilePath, $migratedCode);



        $basePath = base_path();

        // Remove the base path from the absolute path to get the relative path
        $relativePath = str_replace($basePath, '', $migrateFilePath);

        // Normalize the directory separator to use forward slashes
        $relativePath = str_replace('\\', '/', $relativePath);

        //echo $relativePath;

        $command1 = 'migrate';
        $options1 = [
            '--path' => $relativePath,

        ];
        if (Schema::hasTable($tableName)) {
        } else {
            Artisan::call($command1, $options1);
        }


        $path = 'views/admin/post_types' . '/' . $tableName;
        //dd($path);

        $folderPath = resource_path($path);

        // Check if the folder was created successfully
        if (File::exists($folderPath)) {
        } else {
            File::makeDirectory($folderPath, 0777, true, true);
        }

        $sourceFolder = 'views/admin/post_types/backup';

        // Get the list of files in the source folder
        $files = File::files(resource_path($sourceFolder));

        foreach ($files as $file) {
            $fileName = $file->getFilename();

            // Check if the file was copied successfully
            if (File::exists($folderPath . '/' . $fileName)) {
                //echo "File '{$fileName}' copied successfully!" . PHP_EOL;
                // dd($fileName.'copied successfully');
            } else {
                //echo "Failed to copy file '{$fileName}'!" . PHP_EOL;
                //dd($fileName.'Failed to copy file');
                File::copy($file->getPathname(), $folderPath . '/' . $fileName);
            }
        }


        //======= Make controller
        $controllerName = $modelName . 'Controller';
        //dd($controllerName);
        Artisan::call("make:controller $controllerName");

        $controllerName = $controllerName . '.php';
        // dd($controllerName);
        $controllerPath = 'Http/Controllers/Website/' . $controllerName;
        //dd($controllerPath);

        $controllerPath  = app_path("$controllerPath");
        $controllerName = $modelName . 'Controller';
        $controllerCode =
            <<<EOT
        <?php
        namespace App\Http\Controllers\Website;
        use App\Models\\Website\\$modelName;
        use App\Models\Language;
        use App\Models\Website\Post;
        use Carbon\Carbon;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\File;
        class $controllerName extends Controller
        {
            public function index(Request \$request, \$postTypeName,\$id)
            {
                \$postType = $modelName::all();
                \$routeName = \$postTypeName;
                //return view('admin.post_types.$tableName.index',compact('postType','routeName'));
                return view('admin.post_types.postType',compact('postType','routeName','id'));
            }
            public function create(\$postTypeName,\$id)
            {
                //return 1;
                \$lang = Language::all();
                \$routeName = \$postTypeName;
                return view('admin.post_types.$tableName.addPage',compact('lang','routeName','id'));
            }
            public function store(Request \$request)
            {
                \$userId = Auth::id();
                \$currentDateTime = Carbon::now();
                \$translations_title = ['en' => \$request->en_title, 'or' => \$request->or_title];
                \$translations_content = ['en' => \$request->en_content, 'or' => \$request->or_content];
                \$translations_excerpt = ['en' => \$request->en_excerpt, 'or' => \$request->or_excerpt];
                \$PostType = new $modelName();
                \$PostType->setPostTypeTitleAttribute(\$translations_title);
                \$PostType->setPostTypeContentAttribute(\$translations_content);
                \$PostType->setPostTypeExcerptAttribute(\$translations_excerpt);
                \$PostType->post_id = \$request->post_id;
                \$PostType->date = \$currentDateTime;
                \$PostType->author = \$userId;
                \$PostType->attachment_img = \$request->post_attachment;
                \$PostType->attachment_file = \$request->post_attachment2;
                \$PostType->custom_link = \$request->custom_link;
                \$PostType->show_new_icon = \$request->show_icon == '' ? 0 : '1';
                \$PostType->save();
                return redirect()->route('$postSlug.index',[\$request->post_type,\$request->post_id]);
            }
            public function edit(Request \$request,\$postTypeName,\$id)
            {
                \$lang = Language::all();
                \$postType = $modelName::find(\$id);
                return view("admin.post_types.$tableName.edit",compact('lang','postType','id','postTypeName'));
            }
            public function update(Request \$request,\$postTypeName,\$id)
            {
                \$PostType = $modelName::find(\$id);
                \$translations_title = ['en' => \$request->en_title, 'or' => \$request->or_title];
                \$translations_content = ['en' => \$request->en_content, 'or' => \$request->or_content];
                \$translations_excerpt = ['en' => \$request->en_excerpt, 'or' => \$request->or_excerpt];
                \$PostType->setPostTypeTitleAttribute(\$translations_title);
                \$PostType->setPostTypeContentAttribute(\$translations_content);
                \$PostType->setPostTypeExcerptAttribute(\$translations_excerpt);
                \$PostType->attachment_img = \$request->post_attachment;
                \$PostType->attachment_file = \$request->post_attachment2;
                \$PostType->custom_link = \$request->custom_link;
                \$PostType->show_new_icon = \$request->show_icon == '' ? 0 : '1';
                \$PostType->save();
                return redirect()->back();
            }
            public function delete(Request \$request, \$postTypeName,\$id)
            {
                \$postType = $modelName::find(\$id);
                \$postId = Post::where('post_slug',\$postTypeName)->value('id');
                \$postType->delete();
                return redirect()->route("\$postTypeName.index",[\$postTypeName,\$postId]);
            }
        }

        EOT;

        File::put($controllerPath, $controllerCode);


        $filePath = base_path('routes/website_routes.php');
        $searchStatement = "use App\Http\Controllers\Website\GalleryController;";
        $newLine = "\nuse App\Http\Controllers\\Website\\$controllerName;";

        // Read the contents of the file
        $fileContents = file_get_contents($filePath);

        // Find the position of the search statement
        $searchPosition = strpos($fileContents, $searchStatement);
        $searchNewline = strpos($fileContents, $newLine);

        if ($searchNewline == false) {

            if ($searchPosition !== false) {
                // Insert the new line after the search statement
                $newFileContents = substr_replace($fileContents, $newLine, $searchPosition + strlen($searchStatement), 0);

                // Write the modified contents back to the file
                file_put_contents($filePath, $newFileContents);
            }
        }



        // ============End Controller ===





    }

    public static function customRoutes()
    {

        //dd('111');
        $excludedValues = ['page', 'slider', 'gallery'];
        $postType = Post::whereNotIn('post_type', $excludedValues)->get();
        //dd($postType);
        $countPost = $postType->count();
        //dd($postType);
        $routes = [];
        if ($postType->isNotEmpty()) {
            foreach ($postType as $key => $value) {
                // $controller = explode('-', $value->post_slug);

                // $controller = implode('-', array_map('ucfirst', $controller));

                // $controller =  str_replace('-', '', $controller);
                $controller = explode(' ', $value->post_title);

                $controller = implode(' ', array_map('ucfirst', $controller));
                $controller =  str_replace(' ', '', $controller);




                //dd($controller);

                //$route = implode('-', array_map('lcfirst', explode('-', $value->post_slug)));
                //$route =  str_replace('-', '_', $route);
                //$route =  lcfirst($route);

                //dd($controller);
                //dd($value);

                $fas = $controller . 'Controller@index';
                //dd($fas);

                //$fas = 'PostTypeController@postTypeIndex';
                $index = "App\\Http\\Controllers\\Website\\" . $fas;
                $create = "App\\Http\\Controllers\\Website\\" . $controller . 'Controller@create';
                $store = "App\\Http\\Controllers\\Website\\" . $controller . 'Controller@store';
                $edit = "App\\Http\\Controllers\\Website\\" . $controller . 'Controller@edit';
                $update = "App\\Http\\Controllers\\Website\\" . $controller . 'Controller@update';
                $delete = "App\\Http\\Controllers\\Website\\" . $controller . 'Controller@delete';
                // $urll = [];
                // for ($i=1; $i <= $countPost ; $i++) {
                //     # code...
                //    $urll[] = Route::get("post-types-listing$i/{postTypeName}/{PostId}", $index)->name("$value->post_slug.index");
                // }

                // return $urll;

                Route::get("post-$value->post_slug-listing/{postTypeName}/{PostId}", $index)->name("$value->post_slug.index");
                Route::get("create-post-$value->post_slug/{postTypeName}/{id}", $create)->name("$value->post_slug.create");
                Route::post("store-post-$value->post_slug/{postTypeName}", $store)->name("$value->post_slug.store");
                Route::get("edit-post-$value->post_slug/{postTypeName}/{id}", $edit)->name("$value->post_slug.edit");
                Route::post("update-post-$value->post_slug/{postTypeName}/{id}", $update)->name("$value->post_slug.update");
                Route::get("delete-post-$value->post_slug/{postTypeName}/{id}", $delete)->name("$value->post_slug.delete");

            }
        }

    }

    public function deleteModel($id)
    {
        //dd($id);
        $post = Post::find($id);

        $post_title = $post->post_title;

        $post_slug = $post->post_slug;
        //$post = $post->post_slug;
        // $modelName = explode('-', $post);
        // $modelName = implode('-', array_map('ucfirst', $modelName));
        // $modelName = str_replace('-', '', $modelName);
        $modelName = ucwords($post_title);
        $modelName = str_replace(' ', '', $modelName);
        //dd($modelName);

        $modelPath = app_path("Models/$modelName.php");
        $controllerPath = $modelName . 'Controller.php';
        $controllerPath = app_path("Http/Controllers/$controllerPath");
        //dd($controllerPath);
        // Check if the file exists
        if (File::exists($modelPath)) {

            File::delete($modelPath);
            //dd('delete');

        }
        if (File::exists($controllerPath)) {
            // dd('delete controller');
            File::delete($controllerPath);
        }


        $word = explode(' ', $post_title);
        $word = implode(' ', array_map('strtolower', $word));
        $word = str_replace(' ', '_', $word);

        //dd($word);



         $files = File::glob(database_path('migrations/*_*.php'));
         //dd($files);
         $matchingFileNames = [];

        foreach ($files as $file) {
            //dd($file);
            $filename = pathinfo($file, PATHINFO_FILENAME);

            // Check if the filename contains the specified word
            if (strpos($filename, $word) !== false) {
                $matchingFileNames[] = $filename;
            }
        }
        //dd($matchingFileNames[0]);
        $migrationFilePath = $matchingFileNames[0];
        $migrationFilePath = 'migrations/'.$migrationFilePath .'.php';
        //dd($migrationFilePath);
        $migrationFilePath = database_path($migrationFilePath);
        if (File::exists($migrationFilePath)) {
             //dd('delete migration');
            File::delete($migrationFilePath);
        }

        $resourcePath = 'views/admin/post_types/'.$word;
        $resourcePath = resource_path($resourcePath);
        if (File::exists($resourcePath)) {
            //dd('delete resourcePath');
            File::deleteDirectory($resourcePath);

       }
        //dd($resourcePath);
        if (Schema::hasTable($word)) {
            // Drop the table
            Schema::dropIfExists($word);

        }


        //$post->delete();

    }
}
