@extends('layouts.masterpage')

@section('title')
    {{ $title }}
@endsection

@section('pageurl')
    {{ url('/'.$pageurl) }}
@endsection

@section('breadcrumb')
    {{ $breadcrumb }}
@endsection

@section('breadcrumbchild')
    {{ $breadcrumbchild }}
@endsection

@section('loginuser')
    {{ $loginuser }}
@endsection

@section('content')
<style type="text/css">
    .panel-body {
        position: relative;
        min-height: 500px;
    }
</style>
<!-- Simple panel -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Dashboard</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">

    </div>
</div>
<!-- /simple panel -->
@endsection