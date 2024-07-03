<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Easy Laravel Admin Generator</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- SmartAddon.com Verification -->
    <meta name="smartaddon-verification" content="936e8d43184bc47ef34e25e426c508fe" />
    <meta name="keywords" content="Flat UI Design, UI design, UI, user interface, web interface design, user interface design, Flat web design, Bootstrap, Bootflat, Flat UI colors, colors">
    <meta name="description" content="The complete style of the Bootflat Framework.">
    <link rel="shortcut icon" href="favicon_16.ico"/>
    <link rel="bookmark" href="favicon_16.ico"/>
    <!-- site css -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="{{asset('crud-generator/css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('crud-generator/css/site.min.css')}}" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="{{asset('crud-generator/js/html5shiv.js')}}"></script>
    <script src="{{asset('crud-generator/js/respond.min.js')}}"></script>

    <![endif]-->

</head>
<body style="background-color: #f1f2f6;">
<div class="docs-header">

    <!--header-->
    <div class="topic">
        <div class="container">
            <div class="col-md-8">
                <h3>Easy Laravel Admin Generator</h3>
                <h4>Easy life, easy development</h4>
            </div>

        </div>

    </div>
</div>
<!--documents-->
<div class="container documents">
    <div class="example">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Template Asset Generator</h3>
                    </div>
                    <div class="panel-body">
                        <form id="generatorAssetForm" action="{{route('generator.asset.post')}}" method="post" class="justify-content-center">
                            @csrf
                            <div id="responseAssetAreaBlock">
                                <div class="alert alert-info alert-dismissable" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div id="responseAssetArea"></div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="form-group">
                                    <label>What is your view folder name?</label>
                                    <input id="view_folder_name" name="view_folder_name" value="Administrative" required type="text" class="form-control">
                                </div>

                            </div>
                            <div class="form-group text-center">
                                <label >Please select templates</label>
                                <select name="layout_item" class="selecter_3"  data-selecter-options='{"cover":"true"}'>
                                    <option value="adminlte2" selected> AdminLTE 2 </option>
                                    <option value="adminlte3"> AdminLTE 3 </option>
                                    <option value="coreui"> Core UI </option>
                                    <option value="nobleui"> Noble UI </option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-success">Generate</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Configuration</a>
                        <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Model Details</a>
                        <a class="nav-item nav-link" id="nav-final-tab" data-toggle="tab" href="#nav-final" role="tab" aria-controls="nav-final" aria-selected="false">Finalize</a>
                    </div>
                </nav>
                <form action="{{route('generator.crud.post')}}" method="post"  id="generatorCrudForm" class="">
                    @csrf
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active  in" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-center"> Let's start with the basic details.</h4>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>What is your view folder name?</label>
                                        <input id="view_folder_name" name="view_folder_name" value="Administrative" required type="text" class="form-control">
                                    </div>

                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>What is your route prefix?</label>
                                        <input  type="text" class="form-control" id="route_prefix" name="route_prefix" value="administrative" required>
                                    </div>

                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>What is your model name?</label>
                                        <input id="model_name" name="model_name"   required type="text" class="form-control">
                                    </div>

                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Please select your model folder</label>
                                        <select name="model_folder" class="selecter_3"  data-selecter-options='{"cover":"true"}'>
                                            <option value="App\Models" selected> App\Models </option>
                                            <option value="App"> App </option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Please select templates</label>
                                    <select name="layout_item" class="selecter_3"  data-selecter-options='{"cover":"true"}'>
                                        <option value="adminlte2" selected> AdminLTE 2 </option>
                                        <option value="adminlte3"> AdminLTE 3 </option>
                                        <option value="coreui"> Core UI </option>
                                        <option value="nobleui"> Noble UI </option>
                                    </select>
                                </div>

                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-center"> Let's provide your database table details.
                                    <span class="btn btn-success btn-sm pull-right" id="addColumn">Add New Column</span>
                                </h4>
                            </div>
                            <div class="col-sm-12">
                                <div id="appendArea"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-final" role="tabpanel" aria-labelledby="nav-final-tab">
                        <div class="row">
                            <div class="col text-center">
                                <button class="btn btn-success text-center" type="submit">Generate</button>
                            </div>
                        </div>
                        <div id="responseAreaBlock">
                            <div class="alert alert-info alert-dismissable" >
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <div id="responseArea"></div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!--   Core JS Files   -->
<script src="{{asset('crud-generator/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('crud-generator/js/site.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="{{asset('crud-generator/js/main.js')}}"></script>

<script>
    // global app configuration object
    var column = 0;
    let config = {
        routes: {
            template: "{{route('column.details.template',[':columns'])}}",
            foreginKeyRoute: "{{ route("generator.foreign.key.details", ":id") }}"
        }
    };
</script>
</body>
</html>
