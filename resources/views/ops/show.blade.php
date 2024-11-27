@extends('layouts.app')

@section('title', "Ops $op->name")

@section('content')
    <div class="container mt-5">
        <div class="card p-4">
            <table id="printableTable" class="table table-bordered text-center">
                <thead>
                <tr>
                    <th colspan="2" class="text-center">COST CENTER</th>
                    <th colspan="5" rowspan="3" class="text-center align-middle">ORDER PEMBELIAN</th>
                    <th colspan="2"></th>
                    {{--                    <th colspan="1" class="text-left">NO</th>--}}
                    {{--                    <th colspan="2" class="text-left">{{$op->no}}</th>--}}
                </tr>
                <tr>
                    <th colspan="1" class="text-left">NAMA:</th>
                    <th colspan="1" class="text-left">{{$op->department}}</th>
                    <th colspan="1" class="text-left">TGL:</th>
                    <th colspan="1" class="text-left">
                        @if($op->isValidDate())
                            {{(new DateTime($op->date_needed))->format('d/m/Y')}}
                        @else
                            {{$op->date_needed}}
                        @endif
                    </th>
                </tr>
                <tr>
                    <th colspan="1" class="text-left">KODE:</th>
                    <th colspan="1" class="text-left">{{$op->code}}</th>
                    <th colspan="1" class="text-left">NO:</th>
                    <th colspan="1" class="text-left">{{$op->no}}</th>

                </tr>
                <tr>
                    <th rowspan="2" class=" align-middle">NO.</th>
                    <th rowspan="2" class=" align-middle">NAMA BARANG</th>
                    <th rowspan="2" class=" align-middle">INDEX</th>
                    <th colspan="3" class=" align-middle">KWANTUM</th>
                    <th rowspan="2" colspan="1" class=" align-middle">UNIT</th>
                    <th rowspan="2" class=" align-middle">TGL. BUTUH</th>
                    <th rowspan="2" class=" align-middle">KETERANGAN</th>
                </tr>
                <tr>
                    <th colspan="1">SISA</th>
                    <th colspan="1">PERLU</th>
                    <th colspan="1">BELI</th>
                </tr>
                </thead>
                <tbody>
                @foreach($op->pps as $pp)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-left">{{$pp->item_name}}</td>
                        <td class="text-left"></td>
                        <td>{{$pp->remaining}}</td>
                        <td>{{$pp->need}}</td>
                        <td>{{$pp->buy}}</td>
                        <td>{{$pp->unit}}</td>
                        <td>{{$pp->need_date->format('d-m-Y')}}</td>
                        <td class="text-left">{{$pp->description}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2" class="border-0 align-bottom" style="height: 200px; width: 300px">
                        <p>{{$op->first_requestor}}</p>
                    </td>
                    <td colspan="2" class="border-0 align-bottom" style="height: 200px; width: 300px">
                        <p>{{$op->second_requestor}}</p>
                    </td>
                    <td colspan="2" class="border-0"></td>
                    <td colspan="2" style="height: 200px; width: 300px">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <p>DISETUJUI</p>
                            <p style="text-underline-offset: 8px"><u>{{$op->approved_by}}</u></p>
                        </div>
                    </td>
                    <td colspan="2" class="border-0 d-flex flex-column justify-content-between"
                        style="height: 200px; width: 300px">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <p>DIMINTA</p>
                            <p style="text-underline-offset: 8px"><u>{{$op->headOfSection->name}}</u></p>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>

            <div class="d-flex">
                <a href="{{route('ops.index')}}" class="btn btn-default" style="width: fit-content;">Kembali</a>

                <button class="btn btn-primary ml-auto" onclick="printTable()" style="width: fit-content;">
                    <i class="fa fa-print"></i>
                    Print Table
                </button>
            </div>
        </div>
    </div>

    {{--    <form action="{{ route('ops.update', $op->id) }}" method="post" id="update-form-{{$op->id}}"--}}
    {{--          onsubmit="confirmUpdate(event, {{$op->id}})">--}}
    {{--        @csrf--}}
    {{--        @method('PUT')--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-12">--}}
    {{--                <div class="card card-info card-outline card-outline-tabs">--}}

    {{--                    <div class="card-body">--}}
    {{--                        <h6 class="text-divider mb-4"><span>Data</span></h6>--}}
    {{--                        <div class="form-group row">--}}
    {{--                            <label class="col-sm-2 col-form-label text-right">Nama</label>--}}
    {{--                            <div class="col-sm-4">--}}
    {{--                                <input type="text" class="form-control form-control-sm" name="name"--}}
    {{--                                       value="{{ $op->name }}">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label class="col-sm-2 col-form-label text-right">Kode</label>--}}
    {{--                            <div class="col-sm-4">--}}
    {{--                                <input type="text" class="form-control form-control-sm" name="op_code"--}}
    {{--                                       value="{{ $op->op_code }}">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                    <div class="card-footer">--}}
    {{--                        <a href="{{ route('ops.index') }}" class="btn btn-default">--}}
    {{--                            <i class="fa fa-fw fa-arrow-left"></i>--}}
    {{--                            Kembali--}}
    {{--                        </a>--}}

    {{--                        <div class="btn-group float-right">--}}
    {{--                            <button class="btn btn-default text-blue">--}}
    {{--                                <i class="fa fa-fw fa-save"></i>--}}
    {{--                                Ubah--}}
    {{--                            </button>--}}

    {{--                            <a class="btn btn-default text-maroon" href="{{route('ops.index')}}">--}}
    {{--                                <i class="fas fa-ban"></i>--}}
    {{--                                Batalkan--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </form>--}}
@endsection

@section('scripts')
    <script>
        function printTable() {
            var printContents = document.getElementById('printableTable').outerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload();
        }
    </script>
@endsection
