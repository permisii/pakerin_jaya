@extends('layouts.app')

@section('content')
    <form action="{{route('ops.store')}}" method="post" id="create-form">
        {{--    <form action="{{route('ops.store')}}" method="post" id="create-form" onsubmit="confirmCreate(event)">--}}
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">

                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Identity</span></h6>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Department</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm" name="department">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Kode</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm" name="code">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Nomor</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm" name="no">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Tanggal</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control form-control-sm" name="date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Peminta 1</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm"
                                       name="first_requestor">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Peminta 2</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm"
                                       name="second_requestor">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Disetujui Oleh</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm" name="approved_by">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Kepala Seksi</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2" name="head_of_section_id"
                                        id="head_of_section_id" required>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                        </div>

                        {{$dataTable->table()}}

                        <input type="hidden" name="created_by" value="{{auth()->user()->id }}">
                        <input type="hidden" name="updated_by" value="{{auth()->user()->id }}">
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('ops.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Simpan
                            </button>

                            <a class="btn btn-default text-maroon" href="{{route('ops.index')}}">
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

@section('scripts')
    {{$dataTable->scripts()}}
    <script>
        $(document).ready(function() {
            let selectedPPs = [];
            
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

            // Store selected checkboxes
            $('#pps-table').on('change', 'input[name="pp_id[]"]', function() {
                const ppId = $(this).val();
                if ($(this).is(':checked')) {
                    selectedPPs.push(ppId);
                } else {
                    selectedPPs = selectedPPs.filter(id => id !== ppId);
                }
            });

            // Restore selected checkboxes when navigating between pages
            $('#pps-table').on('draw.dt', function() {
                $('input[name="pp_id[]"]').each(function() {
                    if (selectedPPs.includes($(this).val())) {
                        $(this).prop('checked', true);
                    }
                });
            });

            // Select/Deselect all checkboxes
            $('#checkAll').on('change', function() {
                const isChecked = $(this).is(':checked');
                $('input[name="pp_id[]"]').each(function() {
                    $(this).prop('checked', isChecked).trigger('change');
                });
            });

            initializeValidation('#create-form', {
                name: {
                    required: true,
                    minlength: 3,
                },
                op_code: {
                    required: true,
                    minlength: 3,
                },
            }, {
                name: {
                    required: 'Masukkan Nama',
                    minlength: 'minimal 3 karakter',
                },
                op_code: {
                    required: 'Masukkan Kode Op',
                    minlength: 'minimal 3 karakter ',
                },
            });
        });
    </script>
@endsection
