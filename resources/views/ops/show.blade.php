@extends('layouts.app')

@section('title', "Ops $op->name")

@section('content')
    <div class="container mt-5">
        <div class="card p-4">
            <table id="printableTable" style="width: 236.97mm; border-collapse: collapse;">
                <thead>
                <tr>
                    <th colspan="2"
                        style="width: 63.23mm; height: 4.33mm; text-align: center; border: 1px solid black;">COST CENTER
                    </th>
                    <th colspan="5" rowspan="3"
                        style="width: 70.67mm; height: 17.44mm; text-align: center; border: 1px solid black;">ORDER
                        PEMBELIAN
                    </th>

                    <th rowspan="2" style="width: 16.42mm; height: 8.74mm; border: 1px solid black;">NO:</th>
                    <th rowspan="2" style="width: 45.07mm; height: 8.74mm; border: 1px solid black;">{{$op->no}}</th>
                </tr>
                <tr>
                    <th style="width: 16.42mm; height: 6.56mm; border: 1px solid black;">NAMA:</th>
                    <th style="width: 45.07mm; height: 6.56mm; border: 1px solid black;">{{$op->department}}</th>

                </tr>
                <tr>
                    <th style="width: 16.42mm; height: 6.56mm; border: 1px solid black;">KODE:</th>
                    <th style="width: 45.07mm; height: 6.56mm; border: 1px solid black;">{{$op->code}}</th>
                    <th style="width: 16.42mm; height: 8.74mm; border: 1px solid black;">TGL:</th>
                    <th style="width: 45.07mm; height: 8.74mm; border: 1px solid black;">
                        @if($op->isValidDate())
                            {{(new DateTime($op->date_needed))->format('d F Y')}}
                        @else
                            {{$op->date_needed}}
                        @endif
                    </th>
                </tr>
                <tr>
                    <th rowspan="2"
                        style="width: 10.60mm; height: 12.77mm; border: 1px solid black; text-align: center;">NO.
                    </th>
                    <th rowspan="2"
                        style="width: 46.32mm; height: 12.77mm; border: 1px solid black; text-align: center;">NAMA
                        BARANG
                    </th>
                    <th rowspan="2"
                        style="width: 21.81mm; height: 12.77mm; border: 1px solid black; text-align: center;">INDEX
                    </th>
                    <th colspan="3"
                        style="width: 35.75mm; height: 6.67mm; text-align: center; border: 1px solid black;">KWANTUM
                    </th>
                    <th rowspan="2"
                        style="width: 11.33mm; height: 12.77mm; border: 1px solid black; text-align: center;">UNIT
                    </th>
                    <th rowspan="2"
                        style="width: 14.75mm; height: 12.77mm; border: 1px solid black; text-align: center;">TGL. BUTUH
                    </th>
                    <th rowspan="2"
                        style="width: 56.22mm; height: 12.77mm; border: 1px solid black; text-align: center;">KETERANGAN
                    </th>
                </tr>
                <tr>
                    <th style="width: 11.44mm; height: 6.67mm; border: 1px solid black; text-align: center;">SISA</th>
                    <th style="width: 11.44mm; height: 6.67mm; border: 1px solid black; text-align: center;">PERLU</th>
                    <th style="width: 11.44mm; height: 6.67mm; border: 1px solid black; text-align: center;">BELI</th>
                </tr>
                </thead>
                <tbody>
                @foreach($op->pps as $pp)
                    <tr>
                        <td style="width: 10.60mm; height: 5.77mm; border: 1px solid black;">{{$loop->iteration}}</td>
                        <td style="width: 46.32mm; height: 5.77mm; text-align: left; border: 1px solid black;">{{$pp->item_name}}</td>
                        <td style="width: 21.81mm; height: 5.77mm; border: 1px solid black;"></td>
                        <td style="width: 11.44mm; height: 5.77mm; border: 1px solid black;">{{$pp->remaining}}</td>
                        <td style="width: 11.44mm; height: 5.77mm; border: 1px solid black;">{{$pp->need}}</td>
                        <td style="width: 11.44mm; height: 5.77mm; border: 1px solid black;">{{$pp->buy}}</td>
                        <td style="width: 11.33mm; height: 5.77mm; border: 1px solid black;">{{$pp->unit}}</td>
                        <td style="width: 14.75mm; height: 5.77mm; border: 1px solid black;">{{$pp->need_date->format('d-m-y')}}</td>
                        <td style="width: 56.22mm; height: 5.77mm; text-align: left; border: 1px solid black;">{{$pp->description}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2"
                        style="width: 103.07mm; height: 21.78mm; border: 1px solid black; vertical-align: bottom">
                        <p class="m-0 mb-1">{{$op->first_requestor}}</p>
                    </td>
                    <td colspan="2"
                        style="width: 103.07mm; height: 21.78mm; border: 1px solid black; vertical-align: bottom">
                        <p class="m-0 mb-1">{{$op->second_requestor}}</p>
                    </td>
                    <td colspan="3" style="width: 49.61mm; height: 21.78mm; border: 1px solid black;">
                        <div class="d-flex flex-column justify-content-between text-center h-100">
                            <p>DISETUJUI</p>
                            <p class="m-0 mb-1" style="text-underline-offset: 8px"><u>{{$op->approved_by}}</u></p>
                        </div>
                    </td>
                    <td colspan="2" style="width: 44.21mm; height: 21.78mm; border: 1px solid black;">
                        <div class="d-flex flex-column justify-content-between text-center h-100">
                            <p>DIMINTA</p>
                            <p class="m-0 mb-1" style="text-underline-offset: 8px"><u>{{$op->headOfSection->name}}</u>
                            </p>
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
