@extends('layouts.app')

@section('title', '仪表盘')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Dashboard</div>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <tr>
                        <td>
                            You are logged in!
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
