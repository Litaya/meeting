@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 30px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body" style="color:#555">
                        @if(sizeof($projects)==0)
                            您当前未加入任何项目，
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop