<?php

namespace Hashibul\CrudGenerator\Commands;

use Illuminate\Console\Command;

class TemplateAssetPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asset:publish {template}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Template Assets  File Publish';

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
     * @return int
     */
    public function handle()
    {
        $template = $this->argument('template');
        $src = base_path() . '/vendor/hashibul/crud-generator/resources/template/'.$template.'/assets';
        $des = public_path('assets');
        if (!file_exists($des)) {
            mkdir($des, 0777, true);
        }
        $this->copy_directory($src,$des);
    }
    function copy_directory($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
    function recurse_copy($source, $dest)
    {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }
        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }
        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest);
        }
        // Loop through the folder
        $dir = dir($source);
        while (false !== ($entry = $dir->read())) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            // Deep copy directories
            $this->recurse_copy("{$source}/{$entry}", "{$dest}/{$entry}");
        }
        // Clean up
        $dir->close();
        return true;
    }
}
