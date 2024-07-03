<?php
namespace Hashibul\CrudGenerator\Traits;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait Helper
{

    function convertModelNameSpace($input){
        if($input == 'App'){
            $convert = 'App';
        }else{
            $convert = 'App\Models';
        }
        return $convert;
    }
    function convertClassName($input){
        $convert = ucwords($input);
        return str_replace(' ', '', $convert);
    }
    function convertModelName($input){
        $convert = ucwords($input);
        return str_replace(' ', '', $convert);
    }
    function convertLowerCaseFirst($input){
        $convert = lcfirst($input);
        return str_replace(' ', '', $convert);
    }
    function convertFileDirectoryName($input){
        $convert = strtolower($input);
        return str_replace(' ', '-', $convert);
    }
    function convertRoutePrefixName($input){
        $convert = strtolower($input);
        return str_replace(' ', '', $convert);
    }
    function convertViewDirectoryName($input){
        $convert = strtolower($input);
        return str_replace(' ', '', $convert);
    }
    function convertRouteName($input){
        $convert = strtolower($input);
        return str_replace(' ', '-', $convert);
    }
    function convertMigrationName($input){
        $convert = strtolower($input);
        $convert = str_replace(' ', '_', $convert);
        $migrationFileName = date('Y').'_'.date('m').'_'.date('d').'_'.time().'_create_' . strtolower(Str::plural($convert)) . '_table';

        return $migrationFileName;
    }
    function convertMigrationClassName($input){
        $convert = ucwords($input);
        return Str::plural(str_replace(' ', '', $convert));
    }
    function convertTitle($input){
        $convert = ucfirst($input);
        return $convert;
    }
    function from_camel_case($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
    function from_camel_case_space($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode(' ', $ret);
    }
    function convertTableName($input){
        $convert = Str::plural(self::from_camel_case($input));
        return $convert;
    }
    function customCopy($src, $dst) {

        // open the source directory
        $src = 'vendor'.$src;

        $dir = opendir($src);
        dd($dir);
        // Make the destination directory if not exist
        @mkdir($dst);

        // Loop through the files in source directory
        while( $file = readdir($dir) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) )
                {
                    // Recursively calling custom copy function
                    // for sub directory
                    custom_copy($src . '/' . $file, $dst . '/' . $file);

                }
                else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }

        closedir($dir);
    }
    function generateRequestData($column){
        $template = 'stub-templates::request';
        return view($template, compact('column'))->render();
    }
    function generateMigrationData($column){
        $template = 'stub-templates::migration';
        return view($template, compact('column'))->render();
    }
    function generateCreateForm($column){
        $template = 'stub-templates::create-page';
        return view($template, compact('column'))->render();
    }
    function generateEditForm($column){
        $template = 'stub-templates::edit-page';
        return view($template, compact('column'))->render();
    }
    function generateIndexTable($column){
        $template = 'stub-templates::index-table';
        return view($template, compact('column'))->render();
    }
    function generateIndexTableData($column){
        $template = 'stub-templates::index-table-details';
        return view($template, compact('column'))->render();
    }
    function foreignKeyDetails($table){
        $table = Str::plural($table);
        $columns = Schema::getColumnListing($table);
        $delVal = [
            "deleted_at",
            "created_at",
            "updated_at"
        ];
        foreach ($delVal as $item){
            if (($key = array_search($item, $columns)) !== false) {
                unset($columns[$key]);
            }
        }
        return response()->json($columns);
    }

}
