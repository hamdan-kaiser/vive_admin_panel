<?php
    $html = '';;
    $tab = "\t\t\t";
    $lastElement = end($column);
    foreach ($column as $item){

        $html.= $tab;
        $prefix ='$table';
        $type = $item['type'];
        $name = $item['name'];
        $default = $item['default'];
        $enumValues = $item['enumValues'];
        $enumValuesArray = explode (",", $enumValues);
        $enumValuesArray = "'" . implode ( "', '", $enumValuesArray ) . "'";
        $finalPrefix = $prefix.'->'.$type."('";


        if($type == 'enum'){
            if(isset($item['nullable']) && $item['nullable'] == '1'){
                $html.= $finalPrefix.strtolower($name)."')".',['.$enumValuesArray.'])->nullable()';
            }else{
                if($item['default'] != null){
                    $html.= $finalPrefix.strtolower($name)."'".',['.$enumValuesArray.'])->default("'.$default.'")';
                }else{
                    $html.= $finalPrefix.strtolower($name)."'".',['.$enumValuesArray.'])';
                }
            }
        }else{
            if(isset($item['nullable']) && $item['nullable'] == '1'){
                $html.= $finalPrefix.strtolower($name)."')".'->nullable()';
            }else{
                if($item['default'] != null){
                    if(isset($item['unique']) && $item['unique'] == '1'){
                        $html.= $finalPrefix.strtolower($name)."')".'->unique()->default("'.$default.'")';
                    }else{
                        $html.= $finalPrefix.strtolower($name)."')".'->default("'.$default.'")';
                    }

                }else{
                    if(isset($item['unique']) && $item['unique'] == '1'){
                        $html.= $finalPrefix.strtolower($name)."')->unique()";
                    }else{
                        $html.= $finalPrefix.strtolower($name)."')";
                    }

                }
            }
        }
        $html.= ';';
        if($item != $lastElement){
            $html.=PHP_EOL;
        }

    }
    echo $html;
