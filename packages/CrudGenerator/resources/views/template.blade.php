
<div class="panel panel-default sortable">
    <div class="panel-heading" role="tab" id="heading{{$column}}">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$column}}" aria-expanded="false" aria-controls="collapse{{$column}}">
                Column  # <span id="columnFlag{{$clone_id}}"></span>
            </a>
            <a class="btn btn-success btn-sm pull-right" id="deleteColumn"> <i class="glyphicon glyphicon-remove"></i></a>
        </h4>

    </div>
    <div id="collapse{{$column}}" class="panel-collapse collapse" aria-expanded="false" role="tabpanel" aria-labelledby="heading{{$column}}">
        <div class="panel-body">
            <div class="row ">

                <div class="col-md-8 block">
                    <h2 class="example-title">Database Table Details</h2>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Column name</label>
                            <input type="text" class="form-control columnNameInput" data-id="{{$clone_id}}"  placeholder="What is your column name" id="columnName_{{$clone_id}}" name="items[{{$column}}][name]">
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Default value</label>
                            <input type="text" class="form-control" placeholder="Default value" id="defaultValue_{{$clone_id}}" name="items[{{$column}}][default]">
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Column Type</label><br>
                            <select class="form-control columnTypeSelector js-example-basic-single" data-id="{{$clone_id}}" id="column_type_{{$clone_id}}" name="items[{{$column}}][type]" required>
                                @foreach($columnTypes as $types)
                                    <option value="{{$types}}">{{ucfirst($types)}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12" id="foreignKeyColumnArea{{$clone_id}}"  style="display: none">
                        <div class="form-group">
                            <label>Foreign key column</label><br>
                            <select  class="form-control js-example-basic-single" data-id="{{$clone_id}}" id="foreign_key_column_{{$clone_id}}" name="items[{{$column}}][foreignKeyColumn]"></select>
                        </div>
                    </div>
                    <div class="col-xs-12" id="columnEnumValueArea_{{$clone_id}}" style="display: none">
                        <div class="form-group">
                            <label>Please input ENUM values (Enter each value in a separate field by  comma)</label>
                            <input type="text" class="form-control" placeholder="Enter each value in a separate field by comma" id="columnEnumValue_{{$clone_id}}" name="items[{{$column}}][enumValues]">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="isNullable_{{$clone_id}}"name="items[{{$column}}][nullable]" value="1">
                                    <span class='checkbox-material'><span class='check'></span></span>
                                </label>
                                Nullable?
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="isUnique_{{$clone_id}}"name="items[{{$column}}][unique]" value="1">
                                    <span class='checkbox-material'><span class='check'></span></span>
                                </label>
                                Unique?
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" data-id="{{$clone_id}}" id="isForeignKey_{{$clone_id}}" name="items[{{$column}}][foreign_key]" value="1" class="columnForeignKeySelector">
                                    <span class='checkbox-material'><span class='check'></span></span>
                                </label>
                                Foreign Key?
                            </div>
                        </div>
                    </div>
                </div>
{{--FORM INPUT AREA--}}
                <div class="col-md-4 block">
                    <h2 class="example-title">Form Input Details</h2>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Form Input Type</label><br>
                            <select   class="form-control columnInputTypeSelector js-example-basic-single" data-id="{{$clone_id}}" id="input_type_{{$clone_id}}" name="items[{{$column}}][inputType]" required>
                                <option value="text">{{ucfirst('text')}}</option>
                                <option value="email">{{ucfirst('email')}}</option>
                                <option value="password">{{ucfirst('password')}}</option>
                                <option value="file">{{ucfirst('file')}}</option>
                                <option value="select">{{ucfirst('select')}}</option>
                                <option value="textarea">{{ucfirst('textarea')}}</option>
                                <option value="date">{{ucfirst('date')}}</option>
                                <option value="datetime">{{ucwords('date time')}}</option>
                                <option value="checkbox">{{ucfirst('checkbox')}}</option>
                                <option value="number">{{ucfirst('number')}}</option>
                                <option value="tel">{{ucfirst('tel')}}</option>
                                <option value="url">{{ucfirst('url')}}</option>
                                <option value="time">{{ucfirst('time')}}</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Input Label</label>
                            <input type="text" class="form-control" placeholder="Input Label" id="input_label_{{$clone_id}}" name="items[{{$column}}][input_label]">
                        </div>
                    </div>
                    <div class="col-xs-12" style="display: none" id="fileType_{{$clone_id}}">
                        <div class="form-group">
                            <label>File Type</label><br>
                            <select data-selecter-options='{"cover":"true"}'  class="selecter_3 js-example-basic-multiple" data-id="{{$clone_id}}" id="input_file_type_{{$clone_id}}" name="items[{{$column}}][inputFileType]" multiple>
                                <option selected>Please select file type</option>
                                <option value="image">{{ucfirst('image')}}</option>
                                <option value="pdf">{{ucfirst('pdf')}}</option>
                                <option value="video">{{ucfirst('video')}}</option>
                                <option value="spreadsheet">{{ucfirst('spreadsheet')}}</option>
                                <option value="audio">{{ucfirst('audio')}}</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="isRequired_{{$clone_id}}" name="items[{{$column}}][isRequired]" value="1">
                                    <span class='checkbox-material'><span class='check'></span></span>
                                </label>
                                Required field?
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input checked type="checkbox"  class="columnIncludeFormSelector" data-id="{{$clone_id}}" id="isIncludeInForm_{{$clone_id}}" name="items[{{$column}}][include_in_form]" value="1" required>
                                    <span class='checkbox-material'><span class='check'></span></span>
                                </label>
                                Include In Form?
                            </div>
                        </div>
                    </div>
                </div>

        </div>

    </div>
</div>

