<?php

    $tab = "\t\t\t\t";
    $html = '';
    $lastElement = end($column);
    foreach ($column as $item){
        $html.= $tab;
        $name = $item['name'] ?? '';
        if(isset($item['inputType'])){
            $inputType = $item['inputType'] ?? '';
            $inputFileType = $item['inputFileType'] ?? '';
            $requiredFlag = isset($item['isRequired']) ? 'required' : '';
                if($inputType == 'file'){
                    if($inputFileType == "image"){
                        $html.= "'".strtolower($name)."' => 'mimes:jpeg,jpg,png|$requiredFlag',";
                    }
                    if($inputFileType == "pdf"){
                        $html.= "'".strtolower($name)."' => 'mimes:pdf|$requiredFlag',";
                    }
                    if($inputFileType == "video"){
                        $html.= "'".strtolower($name)."' => 'mimes:mp4|$requiredFlag',";
                    }
                    if($inputFileType == "spreadsheet"){
                        $html.= "'".strtolower($name)."' => 'mimes:doc,csv,xlsx,xls,docx,ppt|$requiredFlag',";
                    }
                    if($inputFileType == "audio"){
                        $html.= "'".strtolower($name)."' => 'mimes:mp3,amr|$requiredFlag',";
                    }
                }
                elseif($item['type'] == 'enum'){
                    $enumValues = $item['enumValues'];
                    $html.= "'".strtolower($name)."' => 'in:$enumValues|$requiredFlag',";
                }
                else{
                    $html.= "'".strtolower($name)."' => '".$requiredFlag."',";
                }
            if($item != $lastElement){
                $html.=PHP_EOL;
            }
        }
    }
    echo $html;
