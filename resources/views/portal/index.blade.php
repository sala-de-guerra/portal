@extends('adminlte::page')

@section('title', 'Esteira Comex')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Principal
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/index"> Home</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Callouts
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="callout callout-danger">
                <h5>I am a danger callout!</h5>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                    soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="callout callout-info">
                <h5>I am an info callout!</h5>

                <p>Follow the steps to continue to payment.</p>
                </div>
                <div class="callout callout-warning">
                <h5>I am a warning callout!</h5>

                <p>This is a yellow callout.</p>
                </div>
                <div class="callout callout-success">
                <h5>I am a success callout!</h5>

                <p>This is a green callout.</p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Callouts
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="callout callout-danger">
                <h5>I am a danger callout!</h5>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                    soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="callout callout-info">
                <h5>I am an info callout!</h5>

                <p>Follow the steps to continue to payment.</p>
                </div>
                <div class="callout callout-warning">
                <h5>I am a warning callout!</h5>

                <p>This is a yellow callout.</p>
                </div>
                <div class="callout callout-success">
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
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/contratacao/cadastro.css') }}" rel="stylesheet"> -->
@stop


@section('js')

@stop