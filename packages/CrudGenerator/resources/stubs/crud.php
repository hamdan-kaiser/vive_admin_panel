<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class crud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What is your model name?');



        $numberOfMigrationColumn = $this->ask('How many column you have in your table?');
        $dbColumns = [];


       for($i=1;$i<=$numberOfMigrationColumn;$i++){
            $enumValues = null;
            $nameColumn = $this->ask('What is your column name (Column : '.$i.')?');
            $typeColumn = $this->choice(
                'What is your column type?',
                ['tinyInteger','string','time' ,'bigInteger','decimal','integer','dateTime','boolean','char','date','double','longText','text','timestamps','enum'],
                'string'
            );
            if($typeColumn == 'enum'){
                $enumValues= $this->ask('Please input ENUM values (Enter each value in a separate field by comma. )?');
            }
           $nullable = $this->choice(
               'Is Nullable?',
               ['Yes','No'],
               'No'
           );
           $default = $this->ask('Default value?');
            $dbColumns [] = [
                'name' => $nameColumn,
                'type' => $typeColumn,
                'nullable' => $nullable,
                'default' => $default,
                'enumValues' => $enumValues,
            ];
        }

        if($this->confirm('Do you wish to continue?', true)) {

            $this->info('The command initiated...');
            $this->view($name,$dbColumns);
             // $this->migrationCreate($name,$dbColumns);
            /*$this->controller($name);
            $this->model($name);
            $this->request($name);
            $this->repository($name);
            $this->service($name);
            $this->view($name,$dbColumns);*/

            // File::append(base_path('routes/api.php'), 'Route::resource(\'' . Str::plural(strtolower($name)) . "', '{$name}Controller');");
            //$this->info('The migration creating.....!');
           // Artisan::call('make:migration create_' . strtolower(Str::plural($name)) . '_table --create=' . strtolower(Str::plural($name)));

            $this->info('successful!');
        }

    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
    protected function controller($name)
    {
        $this->info('The controller creating.....!');
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name, // Place
                strtolower(Str::plural($name)), // places,
                strtolower($name) // place
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $template);
    }
    protected function model($name)
    {
        $this->info('The model creating.....!');
        $template = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/{$name}.php"), $template);
    }
    protected function request($name)
    {
        $this->info('The request creating.....!');
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name, // Place
                strtolower(Str::plural($name)), // places,
                strtolower($name) // place
            ],
            $this->getStub('StoreRequest')
        );

        if(!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}StoreRequest.php"), $template);
    }
    protected function repository($name)
    {
        $this->info('The repository creating.....!');
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameUpperCaseFirst}}',
            ],
            [
                $name, // Place
                strtolower(Str::plural($name)), // places,
                strtolower($name), // place,
                ucfirst($name) // Place
            ],
            $this->getStub('Repository')
        );
        if(!file_exists($path = app_path('/Repositories')))
            mkdir($path, 0777, true);
        file_put_contents(app_path("/Repositories/{$name}Repository.php"), $template);
    }
    protected function service($name)
    {
        $this->info('The service creating.....!');
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameUpperCaseFirst}}',
            ],
            [
                $name, // Place
                strtolower(Str::plural($name)), // places,
                strtolower($name), // place,
                ucfirst($name) // Place
            ],
            $this->getStub('Service')
        );
        if(!file_exists($path = app_path('/Service')))
            mkdir($path, 0777, true);
        file_put_contents(app_path("/Service/{$name}Service.php"), $template);
    }
    protected function migrationCreate($name,$dbColumns)
    {
        $this->info('Preparing migration file.....!');
        $data = $this->generateMigrationData($dbColumns);

        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameUpperCaseFirst}}',
                '{{modelNamePluralUpperCaseFirstCase}}',
                '{{migrationData}}',
            ],
            [
                $name, // Place
                strtolower(Str::plural($name)), // places,
                strtolower($name), // place,
                ucfirst($name), // Place,
                Str::plural($name), // Places,
                $data // Migration Fields,
            ],
            $this->getStub('Migration')
        );
        $migrationFileName = time().'_create_' . strtolower(Str::plural($name)) . '_table --create=' . strtolower(Str::plural($name));
        file_put_contents(base_path("/database/migrations/{$migrationFileName}.php"), $template);
    }
    protected function view($name,$dbColumns)
    {
        $fileFolder = strtolower($name);
        /*Create View*/
        $createForm = $this->generateCreateForm($dbColumns);
        if(!file_exists($path = resource_path("/views/{$fileFolder}")))
            mkdir($path, 0777, true);
        $templateViewCreate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameUpperCaseFirst}}',
                '{{modelNamePluralUpperCaseFirstCase}}',
                '{{formData}}',
            ],
            [
                $name, // Place
                strtolower(Str::plural($name)), // places,
                strtolower($name), // place,
                ucfirst($name), // Place
                ucfirst(Str::plural($name)), // Places,
                $createForm, // Places,

            ],
            $this->getStub('viewCreate')
        );
        file_put_contents(resource_path("/views/{$fileFolder}/create.blade.php"), $templateViewCreate);

        /*Edit View*/
        $editForm = $this->generateEditForm($dbColumns);
        $templateViewEdit = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameUpperCaseFirst}}',
                '{{modelNamePluralUpperCaseFirstCase}}',
                '{{formData}}',
            ],
            [
                $name, // Place
                strtolower(Str::plural($name)), // places,
                strtolower($name), // place,
                ucfirst($name), // Place
                ucfirst(Str::plural($name)), // Places,
                $editForm, // Places,
            ],
            $this->getStub('view_edit')
        );
        file_put_contents(resource_path("/views/{$fileFolder}/edit.blade.php"), $templateViewEdit);

        /*Index View*/
        $indexTable = $this->generateIndexTable($dbColumns);
        $indexTableData = $this->generateIndexTableData($dbColumns);
        $templateViewIndex = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameUpperCaseFirst}}',
                '{{modelNamePluralUpperCaseFirstCase}}',
                '{{indexTable}}',
                '{{indexTableData}}',
            ],
            [
                $name, // Place
                strtolower(Str::plural($name)), // places,
                strtolower($name), // place,
                ucfirst($name), // Place
                ucfirst(Str::plural($name)), // Places,
                $indexTable, // Places,
                $indexTableData // Places,
            ],
            $this->getStub('view_index')
        );
        file_put_contents(resource_path("/views/{$fileFolder}/index.blade.php"), $templateViewIndex);
    }

    private function generateMigrationData($column){
        foreach ($column as $item){
            $prefix ='$table';
            $type = $item['type'];
            $name = $item['name'];
            $default = $item['default'];
            $enumValues = $item['enumValues'];
            $enumValuesArray = explode (",", $enumValues);
            $enumValuesArray = "'" . implode ( "', '", $enumValuesArray ) . "'";

            if($type == 'enum'){
                if($item['nullable'] == 'Yes'){
                    $data[] = "             $prefix->$type('".strtolower($name)."',[$enumValuesArray])->nullable();";
                }else{
                    if($item['default'] != null){
                        $data[] = "             $prefix->$type('".strtolower($name)."',[$enumValuesArray])->default('".$default."');";
                    }else{
                        $data[] = "             $prefix->$type('".strtolower($name)."');";
                    }
                }
            }else{
                if($item['nullable'] == 'Yes'){
                    $data[] = "             $prefix->$type('".strtolower($name)."')->nullable();";
                }else{
                    if($item['default'] != null){
                        $data[] = "             $prefix->$type('".strtolower($name)."')->default('".$default."');";
                    }else{
                        $data[] = "             $prefix->$type('".strtolower($name)."');";
                    }
                }
            }


        }

        return trim(implode(PHP_EOL, $data));
    }
    public function generateCreateForm($column){
        $data = [];
        $errors= '$errors->has';
        $errorFirst= '$errors->first';
        foreach ($column as $item){
            $type = $item['type'];
            $name = $item['name'];
            $label = ucfirst($name);
            if($type == 'enum'){

                $error = "$errors('$name') ? 'has-error':''";
                $nedle = '$key';
                $data[] = "                    <div class='form-group {{{$error}}}'>";
                $data[] = "                        <label for='$name'>$label</label>";
                $data[] = "                            <select name='$name' id='$name' class='form-control select2'>";
                $data[] = "                                 @foreach($$name as $nedle => $$name)";
                $data[] = "                                     <option value='{{$nedle}}' {{ $nedle == old('$name')  ? 'selected' : '' }}>{{ $$name }}</option>";
                $data[] = "                                 @endforeach";
                $data[] = "                            </select>";
                $data[] = "                             @if($errors('$name'))";
                $data[] = "                                    <em class='invalid-feedback'>";
                $data[] = "                                         {{ $errorFirst('$name') }}";
                $data[] = "                                    </em>";
                $data[] = "                             @endif";
                $data[] = "                    </div>";
            }else{
                $error = "$errors('$name') ? 'has-error':''";
                $data[] = "                    <div class='form-group {{{$error}}}'>";
                $data[] = "                        <label for='$name'>$label</label>";
                $data[] = "                            <input type='text' id='$name' name='$name' class='form-control' value='{{ old('$name') }}' required>";
                $data[] = "                             @if($errors('$name'))";
                $data[] = "                                    <em class='invalid-feedback'>";
                $data[] = "                                         {{ $errorFirst('$name') }}";
                $data[] = "                                    </em>";
                $data[] = "                             @endif";
                $data[] = "                    </div>";
            }

        }
        return trim(implode(PHP_EOL, $data));
    }
    public function generateEditForm($column){
        $dataForm = [];
        $errors= '$errors->has';
        $errorFirst= '$errors->first';
        foreach ($column as $item){
            $type = $item['type'];
            $name = $item['name'];
            $key = '$data';
            $label = ucfirst($name);
            if($type == 'enum'){

                $error = "$errors('$name') ? 'has-error':''";
                $nedle = '$key';
                $dataForm[] = "                    <div class='form-group {{{$error}}}'>";
                $dataForm[] = "                        <label for='$name'>$label</label>";
                $dataForm[] = "                            <select name='$name' id='$name' class='form-control select2'>";
                $dataForm[] = "                                 @foreach($$name as $nedle => $$name)";
                $dataForm[] = "                                     <option value='{{$nedle}}' {{  $nedle == $key->$name  ? 'selected' : '' }}>{{ $$name }}</option>";
                $dataForm[] = "                                 @endforeach";
                $dataForm[] = "                            </select>";
                $dataForm[] = "                             @if($errors('$name'))";
                $dataForm[] = "                                    <em class='invalid-feedback'>";
                $dataForm[] = "                                         {{ $errorFirst('$name') }}";
                $dataForm[] = "                                    </em>";
                $dataForm[] = "                             @endif";
                $dataForm[] = "                    </div>";
            }else{
                $error = "$errors('$name') ? 'has-error':''";
                $dataForm[] = "                    <div class='form-group {{{$error}}}'>";
                $dataForm[] = "                        <label for='$name'>$label</label>";
                $dataForm[] = "                            <input type='text' id='$name' name='$name' class='form-control' value='{{ $key->$name  }}' required>";
                $dataForm[] = "                             @if($errors('$name'))";
                $dataForm[] = "                                    <em class='invalid-feedback'>";
                $dataForm[] = "                                         {{ $errorFirst('$name') }}";
                $dataForm[] = "                                    </em>";
                $dataForm[] = "                             @endif";
                $dataForm[] = "                    </div>";
            }

        }
        return trim(implode(PHP_EOL, $dataForm));
    }
    public function generateIndexTable($column){
        $dataForm = [];
        foreach ($column as $item){
            $name = $item['name'];
            $dataForm[] = "                       <th>".ucfirst($name)."</th>";
        }
        return trim(implode(PHP_EOL, $dataForm));
    }
    public function generateIndexTableData($column){
        $dataForm = [];
        foreach ($column as $item){
            $name = $item['name'];
            $dataForm[] = "                          {data: '$name', name: '$name'},";
        }
        return trim(implode(PHP_EOL, $dataForm));
    }
}
