@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">PC/Gubadi/01</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Processor:</dt>
                            <dd class="col-sm-8">Core i3</dd>
                            <dt class="col-sm-4">RAM:</dt>
                            <dd class="col-sm-8">4GB</dd>
                            <dt class="col-sm-4">HD:</dt>
                            <dd class="col-sm-8">1TB</dd>
                            <dt class="col-sm-4">Monitor:</dt>
                            <dd class="col-sm-8">On board</dd>
                            <dt class="col-sm-4">VGA:</dt>
                            <dd class="col-sm-8">On board</dd>
                            <dt class="col-sm-4">Bagian:</dt>
                            <dd class="col-sm-8">Gubadi</dd>
                            <dt class="col-sm-4">User:</dt>
                            <dd class="col-sm-8">---</dd>
                        </dl>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Uraian</th>
                                <th>Pekerja</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>29-Nov-23</td>
                                <td>Servis (cleaning and cek)</td>
                                <td>Cip</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">PC/Gubadi/02</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Processor:</dt>
                            <dd class="col-sm-8">Core i3</dd>
                            <dt class="col-sm-4">RAM:</dt>
                            <dd class="col-sm-8">4GB</dd>
                            <dt class="col-sm-4">HD:</dt>
                            <dd class="col-sm-8">1TB</dd>
                            <dt class="col-sm-4">Monitor:</dt>
                            <dd class="col-sm-8">On board</dd>
                            <dt class="col-sm-4">VGA:</dt>
                            <dd class="col-sm-8">On board</dd>
                            <dt class="col-sm-4">Bagian:</dt>
                            <dd class="col-sm-8">Gubadi</dd>
                            <dt class="col-sm-4">User:</dt>
                            <dd class="col-sm-8">---</dd>
                        </dl>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Uraian</th>
                                <th>Pekerja</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>29-Nov-23</td>
                                <td>Ganti switch button, fan processor</td>
                                <td>Cip</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
