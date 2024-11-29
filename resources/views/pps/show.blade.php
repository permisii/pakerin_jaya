@php use App\Support\Enums\IntentEnum; @endphp
@extends('layouts.app')

@section('title', "PP $pp->name")

@section('content')
    <form action="{{ route('pps.update', $pp->id) }}" method="post"
          id="update-form-{{$pp->id}}"
          onsubmit="confirmUpdate(event, {{$pp->id}})">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Edit PP</span></h6>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Nama Barang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="item_name"
                                       required value="{{ $pp->item_name }}">
                            </div>
                        </div>

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-sm-2 col-form-label text-right">Sisa Barang</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <input type="number" class="form-control form-control-sm" name="remaining"--}}
                        {{--                                       required value="{{ $pp->remaining }}">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-sm-2 col-form-label text-right">Jumlah Kebutuhan</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <input type="number" class="form-control form-control-sm" name="need"--}}
                        {{--                                       required value="{{ $pp->need }}">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-sm-2 col-form-label text-right">Jumlah Beli</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <input type="number" class="form-control form-control-sm" name="buy"--}}
                        {{--                                       required value="{{ $pp->buy }}">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Satuan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="unit"
                                       required value="{{ $pp->unit }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Tanggal Kebutuhan</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-sm" name="need_date"
                                       required value="{{ $pp->need_date->format('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Deskripsi</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm"
                                       name="description"
                                       required value="{{ $pp->description }}">
                            </div>
                        </div>

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-sm-2 col-form-label text-right">Status</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <select name="status" class="form-control form-control-sm" required>--}}
                        {{--                                    <option value="">Pilih Status</option>--}}
                        {{--                                    @foreach(\App\Support\Enums\PPStatusEnum::cases() as $case)--}}
                        {{--                                        <option value="{{ $case->value }}"--}}
                        {{--                                                @if($pp->status->value === $case->value) selected @endif>{{ $case->name }}</option>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('pps.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Simpan
                            </button>

                            <a class="btn btn-default text-maroon" href="{{ route('pps.index') }}">
                                <i class="fas fa-ban"></i>
                                Batalkan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
