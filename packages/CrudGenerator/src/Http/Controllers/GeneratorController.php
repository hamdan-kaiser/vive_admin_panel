<?php


namespace Hashibul\CrudGenerator\Http\Controllers;

use Hashibul\CrudGenerator\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
class GeneratorController extends Controller
{
    use Helper;
    const STUBS = '/hashibul/crud-generator/resources/stubs/';
    const STUBS_TEMPLATE = '/hashibul/crud-generator/resources/stub-templates/';


    private $message = [
        'start' => 'Initialize generating process',
        'controller' => 'Generating controller',
        'model' => 'Generating model',
        'request' => 'Generating request',
        'repository' => 'Generating repository',
        'service' => 'Generating service',
        'migration' => 'Generating migration',
        'view' => 'Generating view',
        'callingMigration' => 'Migration Process on going',
        'assetGenerate' => 'Publishing template asset files',
        'end' => 'Process finished',
    ];

    public function index()
    {
        $view = 'crud-generator::generator';
        return view($view);
    }
    public function loadTempalte($columns,$cloneId = null)
    {
        $view = 'crud-generator::template';
        $columnTypes = ['string','text','tinyInteger','time' ,'integer','dateTime','boolean','char','date','bigInteger','decimal','double','longText','timestamps','enum'];
        $cloneId = $cloneId == null ? uniqid() : $cloneId;
        return view($view,['column' => $columns,'columnTypes' => $columnTypes,'clone_id' => $cloneId,]);
    }
    public function generateAsset(Request $request){

        try {
            echo '<p>'.$this->message['start'].'</p>';
            $viewFolderName = $request->view_folder_name;//What is your view folder name?
            $template = $request->layout_item;

            echo $this->message['assetGenerate'];
            $viewFolderName = strtolower($viewFolderName);

            \Artisan::call('layout:publish '.$viewFolderName.' '.$template.'');
            \Artisan::call('asset:publish '.$template.'');
            echo '<p>'.$this->message['end'].'</p>';
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    public function generateCrud(Request $request){

        try {
            echo $this->message['start'];
            $name = $request->model_name;//What is your model name?

            $viewFolderName = $request->view_folder_name;//What is your view folder name?
            $routePrefix = $request->route_prefix;//What is your route prefix?
            $columnDetails = $request->items;
            $template = $request->layout_item;
            $modelFolder = $request->model_folder;

            $this->controller($name,$viewFolderName,$routePrefix);
            $this->model($name,$modelFolder);
            $this->request($name,$columnDetails);
            $this->repository($name,$modelFolder);
            $this->service($name,$routePrefix);
            $this->migration($name,$columnDetails);
            $this->view($name,$columnDetails,$viewFolderName,$routePrefix);
            $this->callMigration();
            $this->generateWebRouteData($name,$routePrefix,$viewFolderName);
            echo $this->message['end'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    private static function getStubPath()
    {
        return self::STUBS;
    }
    private static function getStub($type)
    {
        return file_get_contents(base_path('vendor') . self::getStubPath().$type.'.stub');
    }
    private function callMigration()
    {
        echo $this->message['callingMigration'];
        \Artisan::call('migrate');
    }
    public function generateWebRouteData($name,$routePrefix,$viewFolderName){
        $exist = TRUE;
        $routePath = base_path("/routes/web.php");
        $file=fopen($routePath,"r+") or exit("Unable to open file!");
        while (!feof($file)) {
            $line=fgets($file);
            if (str_contains($line, "Route::prefix('administrative')")!==false) {
                $exist = TRUE;
                break;
            } else {
                $exist = FALSE;
            }
        }

        if($exist){
            $this->generateAppendWebRouteGroup($name,$routePrefix,$viewFolderName,$routePath);
        }else{
            $this->generateInitialWebRouteGroup($name,$routePrefix,$viewFolderName,$routePath);
        }

        return true;
    }
    private function generateInitialWebRouteGroup($name,$routePrefix,$viewFolderName,$routePath)
    {
        $template = str_replace(
            [
                '{{routePrefix}}',
                '{{viewDirectoryName}}',
            ],
            [
                $this->convertRoutePrefixName($routePrefix), // Migration Table Name,
                $this->convertViewDirectoryName($viewFolderName), // ClassName
            ],
            $this->getStub('WebRouteGroupBlock')
        );
        file_put_contents($routePath, $template,FILE_APPEND);
        $this->generateAppendWebRouteGroup($name,$routePrefix,$viewFolderName,$routePath);
    }
    private function generateAppendWebRouteGroup($name,$routePrefix,$viewFolderName,$routePath)
    {
        //generate route from stub
        $template = str_replace(
            [
                '{{routeName}}',
                '{{className}}',
            ],
            [
                $this->convertRouteName($name), // Migration Table Name,
                $this->convertClassName($name), // ClassName
            ],
            $this->getStub('WebRoute')
        );
        $config = $routePath;
        $file=fopen($config,"r+") or exit("Unable to open file!");
        $newline = '';
        $insertPos = 0;
        while (!feof($file)) {
            $line=fgets($file);
            if (strpos($line, "Route::prefix('administrative')")!==false) {
                $insertPos = ftell($file);
                $newline =  $template;
            } else {
                $newline.=$line;   // append existing data with new data of user
            }
        }

        fseek($file,$insertPos);   // move pointer to the file position where we saved above
        fwrite($file, $newline);

        fclose($file);

    }

    protected function webRoute($modelFolder)
    {
        echo $this->message['migration'];
        $path = app_path() . "/".$modelFolder;
        $data = $this->generateWebRouteData();
    }
    protected function controller($name,$viewFolderName,$routePrefix)
    {

        echo $this->message['controller'];

        $template = str_replace(
            [
                '{{className}}',
                '{{modelName}}',
                '{{modelNameLowerCaseFirst}}',
                '{{fileDirectoryName}}',
                '{{routePrefix}}',
                '{{viewDirectoryName}}',
                '{{routeName}}',
                '{{title}}',
            ],
            [
                $this->convertClassName($name), // ClassName
                $this->convertModelName($name), // ModelName,
                $this->convertLowerCaseFirst($name), // modelName,
                $this->convertFileDirectoryName($name), // model-name,
                $this->convertRoutePrefixName($routePrefix), // model-name,
                $this->convertViewDirectoryName($viewFolderName), // model-name
                $this->convertRouteName($name), // model-name
                $this->convertTitle($name), // model-name
            ],
            $this->getStub('Controller')
        );
        $path = app_path('Http/Controllers/'.$viewFolderName);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("/Http/Controllers/{$viewFolderName}/{$this->convertClassName($name)}Controller.php"), $template);
    }
    protected function model($name,$modelFolder)
    {
        echo $this->message['model'];
        $template = str_replace(
            ['{{modelName}}','{{modelNamespace}}'],
            [$this->convertModelName($name),$this->convertModelNameSpace($modelFolder)],
            $this->getStub('Model')
        );

        if($modelFolder == 'App'){
            file_put_contents(app_path("/{$this->convertModelName($name)}.php"), $template);
        }else{
            file_put_contents(app_path("/Models/{$this->convertModelName($name)}.php"), $template);
        }

    }
    protected function request($name,$dbColumns)
    {
        echo $this->message['request'];
        $data = $this->generateRequestData($dbColumns);
        $template = str_replace(
            [
                '{{validationData}}',
                '{{className}}'
            ],
            [
                $data ,// validationData
                $this->convertClassName($name)
            ],
            $this->getStub('StoreRequest')
        );

        if (!file_exists(app_path('Http/Requests'))) {
            mkdir(app_path('Http/Requests'), 0777, true);
        }
        file_put_contents(app_path("/Http/Requests/{$this->convertClassName($name)}StoreRequest.php"), $template);
    }
    protected function repository($name,$modelFolder)
    {
        echo $this->message['repository'];
        $template = str_replace(
            [
                '{{modelName}}',
                '{{className}}',
                '{{modelNamespace}}'
            ],
            [
                $this->convertClassName($name), // ClassName
                $this->convertModelName($name), // ModelName
                $this->convertModelNameSpace($modelFolder)
            ],
            $this->getStub('Repository')
        );
        if(!file_exists($path = app_path('/Repositories')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Repositories/{$this->convertClassName($name)}Repository.php"), $template);
    }
    protected function service($name,$routePrefix)
    {
        echo $this->message['service'];

        $template = str_replace(
            [
                '{{className}}',
                '{{routePrefix}}',
                '{{routeName}}',
                '{{modelNameLowerCaseFirst}}',
            ],
            [
                $this->convertClassName($name), // ClassName
                $this->convertRoutePrefixName($routePrefix), // model-name,
                $this->convertRouteName($name), // model-name
                $this->convertLowerCaseFirst($name), // modelName,
            ],
            $this->getStub('Service')
        );
        if(!file_exists($path = app_path('/Service'))){
            mkdir($path, 0777, true);
        }


        file_put_contents(app_path("/Service/{$this->convertClassName($name)}Service.php"), $template);
    }
    protected function migration($name,$dbColumns)
    {
        echo $this->message['migration'];
        $data = $this->generateMigrationData($dbColumns);
        $template = str_replace(
            [
                '{{migrationData}}',
                '{{tableName}}',
                '{{className}}',
            ],
            [
                $data, // Migration Fields,
                $this->convertTableName($name), // Migration Table Name,
                $this->convertMigrationClassName($name), // ClassName
            ],
            $this->getStub('Migration')
        );
        file_put_contents(base_path("/database/migrations/{$this->convertMigrationName($name)}.php"), $template);
    }
    protected function view($name,$dbColumns,$viewFolderName,$routePrefix)
    {
        echo $this->message['view'];
        $pathFolder = resource_path('views/'.strtolower($viewFolderName));
        $pathFileFolder = $pathFolder.'/'.$this->convertFileDirectoryName($name);
        if (!file_exists($pathFolder)) {
            mkdir($pathFolder, 0777, true);
        }
        /*Create View*/
        $this->createView($name,$dbColumns,$viewFolderName,$routePrefix,$pathFileFolder);
        /*Edit View*/
        $this->updateView($name,$dbColumns,$viewFolderName,$routePrefix,$pathFileFolder);
        /*Index View*/
        $this->indexView($name,$dbColumns,$viewFolderName,$routePrefix,$pathFileFolder);

    }
    private function createView($name,$dbColumns,$viewFolderName,$routePrefix,$pathFileFolder)
    {

        $createForm = $this->generateCreateForm($dbColumns);
        $templateViewCreate = str_replace(
            [
                '{{modelNameLowerCaseFirst}}',
                '{{routePrefix}}',
                '{{viewDirectoryName}}',
                '{{routeName}}',
                '{{title}}',
                '{{formData}}',
            ],
            [
                $this->convertLowerCaseFirst($name), // modelName,
                $this->convertRoutePrefixName($routePrefix), // model-name,
                $this->convertViewDirectoryName($viewFolderName), // model-name
                $this->convertRouteName($name), // model-name
                $this->convertTitle($name), // model-name
                $createForm

            ],
            $this->getStub('ViewCreate')
        );
        if (!file_exists($pathFileFolder)) {
            mkdir($pathFileFolder, 0777, true);
        }
        file_put_contents("{$pathFileFolder}/create.blade.php", $templateViewCreate);
    }
    private function updateView($name,$dbColumns,$viewFolderName,$routePrefix,$pathFileFolder)
    {
        $editForm = $this->generateEditForm($dbColumns);
        $templateViewEdit = str_replace(
            [
                '{{modelNameLowerCaseFirst}}',
                '{{routePrefix}}',
                '{{viewDirectoryName}}',
                '{{routeName}}',
                '{{title}}',
                '{{formData}}',
            ],
            [
                $this->convertLowerCaseFirst($name), // modelName,
                $this->convertRoutePrefixName($routePrefix), // model-name,
                $this->convertViewDirectoryName($viewFolderName), // model-name
                $this->convertRouteName($name), // model-name
                $this->convertTitle($name), // model-name
                $editForm

            ],
            $this->getStub('ViewEdit')
        );
        if (!file_exists($pathFileFolder)) {
            mkdir($pathFileFolder, 0777, true);
        }
        file_put_contents("{$pathFileFolder}/edit.blade.php", $templateViewEdit);
    }
    private function indexView($name,$dbColumns,$viewFolderName,$routePrefix,$pathFileFolder)
    {
        $indexTable = $this->generateIndexTable($dbColumns);
        $indexTableData = $this->generateIndexTableData($dbColumns);
        $templateViewIndex = str_replace(
            [
                '{{modelNameLowerCaseFirst}}',
                '{{routePrefix}}',
                '{{viewDirectoryName}}',
                '{{routeName}}',
                '{{title}}',
                '{{indexTable}}',
                '{{indexTableData}}',

            ],
            [
                $this->convertLowerCaseFirst($name), // modelName,
                $this->convertRoutePrefixName($routePrefix), // model-name,
                $this->convertViewDirectoryName($viewFolderName), // model-name
                $this->convertRouteName($name), // model-name
                $this->convertTitle($name), // model-name
                $indexTable,
                $indexTableData,
            ],
            $this->getStub('ViewIndex')
        );
        if (!file_exists($pathFileFolder)) {
            mkdir($pathFileFolder, 0777, true);
        }
        file_put_contents("{$pathFileFolder}/index.blade.php", $templateViewIndex);
    }

}

