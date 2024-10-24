@extends('layouts.app')

@section('content')
    <form action="{{ route('pcs.store') }}" method="post" id="create-form">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>PC Details</span></h6>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Pemakai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="user_name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="name" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Tanggal Penggunaan Awal</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-sm" name="date_of_initial_use"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Index</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="index" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Bagian</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="section" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Monitor</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="monitor" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">VGA</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="vga" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Processor</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="processor" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">RAM</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="ram" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Penyimpanan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="hdd" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Keyboard</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="keyboard" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Mouse</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="mouse" required>
                            </div>
                        </div>
                        <input type="hidden" name="created_by" value="{{auth()->user()->id}}">
                        <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">
                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-sm-2 col-form-label text-right">Created By</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <select class="form-control form-control-sm select2" name="created_by" required>--}}
                        {{--                                    <option value="">-- Select User --</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-sm-2 col-form-label text-right">Updated By</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <select class="form-control form-control-sm select2" name="updated_by" required>--}}
                        {{--                                    <option value="">-- Select User --</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('pcs.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Simpan
                            </button>

                            <a class="btn btn-default text-maroon" href="{{ route('pcs.index') }}">
                                <i class="fas fa-ban"></i>
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: '-- Select User --',
                allowClear: true,
                ajax: {
                    url: '{{ route('users.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            intent: '{{\App\Support\Enums\IntentEnum::USER_SELECT2_SEARCH_USERS->value}}',
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(user) {
                                return {
                                    id: user.id,
                                    text: `${user.nip} - ${user.name}`,
                                };
                            }),
                        };
                    },
                    cache: true,
                },
            });
        });
    </script>
@endsection
