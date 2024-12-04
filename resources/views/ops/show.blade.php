@extends('layouts.app')

@section('title', "Ops $op->name")

@section('content')
    <div class="container mt-5">
        <div class="card p-4">
            {{--            TODO: Hybrid styling header(flex) items(table) --}}
            <div class="flex-container" id="printableArea"
                 style="display: flex; flex-direction: column; width: 195.39mm; font-size: 12px; border: 1px solid black">

                <div class="header-row" style="display: flex">
                    <div class="d-flex flex-column" style="width: 63.23mm; height: 17.44mm;">
                        <p class="m-0"
                           style="height: 4.33mm; text-align: center; border-right: 1px solid black; border-bottom: 1px solid black">
                            COST
                            CENTER</p>
                        <div class="d-flex"
                             style="height: 6.56mm;border-right: 1px solid black; border-bottom: 1px solid black">
                            <p class="m-0 d-flex align-items-center"
                               style="width: 16.42mm">NAMA :</p>
                            <p class="m-0 ml-2 d-flex align-items-center"
                               style="width: 45.07mm;">{{$op->department}}</p>
                        </div>
                        <div class="d-flex"
                             style="height: 6.56mm;border-right: 1px solid black; border-bottom: 1px solid black">
                            <p class="m-0 d-flex align-items-center"
                               style="width: 16.42mm">KODE :</p>
                            <p class="m-0 ml-2 d-flex align-items-center"
                               style="width: 45.07mm;">{{$op->code}}</p>
                        </div>
                    </div>
                    <p style="display: flex; align-items: center; justify-content: center; width: 70.67mm; text-align: center; padding: 0;margin: 0; border-bottom: 1px solid black">
                        ORDER
                        PEMBELIAN
                    </p>
                    <div class="d-flex flex-column" style="width: 61.49mm; height: 17.44mm;">
                        <div class="d-flex" style="height: 8.74mm;">
                            <p class="m-0 d-flex align-items-center"
                               style="width: 16.42mm; border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black">
                                NO.
                                :</p>
                            <p class="m-0 d-flex align-items-center"
                               style="width: 45.07mm; border-bottom: 1px solid black; ">{{$op->no}}</p>
                        </div>
                        <div class="d-flex" style="height: 8.74mm;">
                            <p class="m-0 d-flex align-items-center"
                               style="width: 16.42mm; border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; ">
                                TGL. :</p>
                            <p class="m-0 d-flex align-items-center"
                               style="width: 45.07mm; border-bottom: 1px solid black; ">
                                @if($op->isValidDate())
                                    {{(new DateTime($op->date_needed))->format('d F Y')}}
                                @else
                                    {{$op->date_needed}}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="header-row"
                     style="display: flex; border-top: 1px solid black; border-bottom: 1px solid black; height: 12.77mm; margin-top: 2px;">
                    <div class="d-flex align-items-center justify-content-center"
                         style="width: 10.60mm; border-right: 1px solid black; text-align: center;">NO.
                    </div>
                    <div class="d-flex align-items-center justify-content-center"
                         style="width: 46.32mm; border-right: 1px solid black; text-align: center;">NAMA BARANG
                    </div>
                    <div class="d-flex align-items-center justify-content-center"
                         style="width: 21.81mm; border-right: 1px solid black; text-align: center;">INDEX
                    </div>
                    <div class="d-flex" style="width: 35.75mm; text-align: center; border-right: 1px solid black;">
                        <div class="d-flex flex-fill flex-column">
                            <p class="m-0 " style="border-bottom: 1px solid black;">KWANTUM</p>
                            <div class="d-flex justify-content-between flex-fill w-100 h-100">
                                <div
                                    class="d-flex align-items-center justify-content-center"
                                    style="height: 100%; width: 11.44mm; border-right: 1px solid black; text-align: center">
                                    SISA
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center"
                                    style="height: 100%; width: 11.44mm; border-right: 1px solid black; text-align: center">
                                    PERLU
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-center"
                                    style="height: 100%; width: 11.44mm; text-align: center">
                                    BELI
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center"
                         style="width: 11.13mm; border-right: 1px solid black; text-align: center;">UNIT
                    </div>
                    <div class="d-flex align-items-center justify-content-center"
                         style="width: 14.75mm; border-right: 1px solid black; text-align: center;">TGL. BUTUH
                    </div>
                    <div class="d-flex align-items-center justify-content-center"
                         style="width: 56.22mm; text-align: center;">KETERANGAN
                    </div>
                    <div style="flex: 1;"></div>
                </div>

                @php
                    $totalRows = 16;
                    $existingRows = $op->pps->count();
                    $remainingRows = $totalRows - $existingRows;
                @endphp

                @foreach($op->pps as $pp)
                    {{--                    remove the height so the value can adapt, but who knows --}}

                    <div class="data-row"
                         style="display: flex; height: 5.77mm; border-bottom: 1px solid black;">
                        {{--                        If height is removed, feel free to remove overflow --}}
                        <div
                            style="width: 10.60mm; border-right: 1px solid black; overflow: hidden; text-align: center">{{$loop->iteration}}</div>
                        <div
                            style="width: 46.32mm; text-align: left; border-right: 1px solid black; overflow: hidden">{{$pp->item_name}}</div>
                        <div style="width: 21.81mm; border-right: 1px solid black; overflow: hidden"></div>
                        <div
                            style="width: 11.44mm; border-right: 1px solid black; overflow: hidden">{{$pp->remaining}}</div>
                        <div style="width: 11.44mm; border-right: 1px solid black; overflow: hidden">{{$pp->need}}</div>
                        <div style="width: 11.44mm; border-right: 1px solid black; overflow: hidden">{{$pp->buy}}</div>
                        <div style="width: 11.13mm; border-right: 1px solid black; overflow: hidden">{{$pp->unit}}</div>
                        <div
                            style="width: 14.75mm; border-right: 1px solid black; overflow: hidden">{{$pp->need_date->format('d-m-y')}}</div>
                        <div
                            style="width: 56.22mm; text-align: left; overflow: hidden">{{$pp->description}}</div>
                        <div style="flex: 1;"></div>
                    </div>
                @endforeach

                @for ($i = 0; $i < $remainingRows; $i++)
                    <div class="data-row" style="display: flex; height: 5.77mm; border-bottom: 1px solid black;">
                        <div style="width: 10.60mm; border-right: 1px solid black;"></div>
                        <div style="width: 46.32mm; border-right: 1px solid black;"></div>
                        <div style="width: 21.81mm; border-right: 1px solid black;"></div>
                        <div style="width: 11.44mm; border-right: 1px solid black;"></div>
                        <div style="width: 11.44mm; border-right: 1px solid black;"></div>
                        <div style="width: 11.44mm; border-right: 1px solid black;"></div>
                        <div style="width: 11.13mm; border-right: 1px solid black;"></div>
                        <div style="width: 14.75mm; border-right: 1px solid black;"></div>
                        <div style="width: 56.22mm;"></div>
                        <div style="flex: 1;"></div>
                    </div>
                @endfor

                <div class="footer-row" style="display: flex; height: 21.78mm">
                    <div
                        style="width: 103.07mm; border-right: 1px solid black; vertical-align: bottom; display: flex; flex: 1; justify-content: space-between; align-items: end; padding: 0 15px">
                        <p class="m-0 mb-1">{{$op->first_requestor}}</p>
                        <p class="m-0 mb-1">{{$op->second_requestor}}</p>
                    </div>
                    <div style="width: 49.61mm; border-right: 1px solid black;">
                        <div class="d-flex flex-column justify-content-between text-center h-100">
                            <p>DISETUJUI</p>
                            <p class="m-0 mb-1" style="text-underline-offset: 8px"><u>{{$op->approved_by}}</u></p>
                        </div>
                    </div>
                    <div style="width: 44.21mm;">
                        <div class="d-flex flex-column justify-content-between text-center h-100">
                            <p>DIMINTA</p>
                            <p class="m-0 mb-1" style="text-underline-offset: 8px"><u>{{$op->headOfSection->name}}</u>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <a href="{{route('ops.index')}}" class="btn btn-default" style="width: fit-content;">Kembali</a>

                <button class="btn btn-primary ml-auto" onclick="printArea()" style="width: fit-content;">
                    <i class="fa fa-print"></i>
                    Print
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function printArea() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload();
        }
    </script>
@endsection
