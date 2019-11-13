@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Alteração de Equipes
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/"> Alteração de Equipes</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


    <div id="" class="ui-widget-content">
        <p>Drag me around</p>
    </div>



<br>

<div class="row">
    <div class="col-md-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"> Célula João Marcel</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                    <ul id="sortable1" class="connectedSortable">
                            <li class="ui-state-default">Item 1</li>
                            <li class="ui-state-default">Item 2</li>
                            <li class="ui-state-default">Item 3</li>
                            <li class="ui-state-default">Item 4</li>
                            <li class="ui-state-default">Item 5</li>
                          </ul>
                           
                          <ul id="sortable2" class="connectedSortable">
                            <li class="ui-state-highlight">Item 1</li>
                            <li class="ui-state-highlight">Item 2</li>
                            <li class="ui-state-highlight">Item 3</li>
                            <li class="ui-state-highlight">Item 4</li>
                            <li class="ui-state-highlight">Item 5</li>
                          </ul>

                <div class="callout callout-danger ui-widget-content draggable">
                <h5>I am a danger callout!</h5>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                    soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="callout callout-info ui-widget-content draggable">
                <h5>I am an info callout!</h5>

                <p>Follow the steps to continue to payment.</p>
                </div>
                <div class="callout callout-warning ui-widget-content draggable">
                <h5>I am a warning callout!</h5>

                <p>This is a yellow callout.</p>
                </div>
                <div class="callout callout-success ui-widget-content draggable">
                <h5>I am a success callout!</h5>

                <p>This is a green callout.</p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"> Célula Marcelo Barboza</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    <div class="callout callout-danger ui-widget-content draggable">
                    <h5>I am a danger callout!</h5>

                    <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                        soul,
                        like these sweet mornings of spring which I enjoy with my whole heart.</p>
                    </div>
                    <div class="callout callout-info ui-widget-content draggable">
                    <h5>I am an info callout!</h5>

                    <p>Follow the steps to continue to payment.</p>
                    </div>
                    <div class="callout callout-warning ui-widget-content draggable">
                    <h5>I am a warning callout!</h5>

                    <p>This is a yellow callout.</p>
                    </div>
                    <div class="callout callout-success ui-widget-content draggable">
                    <h5>I am a success callout!</h5>

                    <p>This is a green callout.</p>
                    </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    

</div> <!-- /.row -->

@section('footer')

<b>Copyright © 2009 - 2019 - GILIE/SP - Gerência de Alienação de Bens Móveis e Imóveis</b>

@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
@section('js')
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

    <script>
        $( function() {
            $( ".draggable" ).draggable(
                { 
                cursor: "move", 
                cursorAt: { top: 56, left: 56 },

                }
            );
            
        } );

        $( function() {
            $( "#sortable1, #sortable2" ).sortable({
            connectWith: ".connectedSortable"
            }).disableSelection();
        } );
    </script>

@stop
@stop