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
                            <label class="col-sm-2 col-form-label text-right">OP Preset</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2" id="op_preset_id"
                                        name="op_preset_id">
                                    <option value="">-- Pilih OP Preset --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Department</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm" name="department">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Kode Kasi</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm" name="code">
                            </div>
                        </div>

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-sm-2 col-form-label text-right">Nomor</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <input type="text" class="form-control form-control form-control-sm" name="no">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Date Needed</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm" id="date-needed-select"
                                        name="date_needed_select">
                                    <option value="2_bulan">2 Bulan</option>
                                    {{-- Urgent by default selected to handle both date not triggered --}}
                                    <option value="urgent" selected>Urgent</option>
                                    <option value="custom_date">Custom Date</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="custom-date-group" style="display: none;">
                            <label class="col-sm-2 col-form-label text-right">Custom Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-sm" name="custom_date"
                                       id="custom-date-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Divisi Head</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm"
                                       name="first_requestor">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Plan Manager</label>
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

            // Initialize select2 for head of section
            $('#head_of_section_id').select2({
                placeholder: '-- Pilih Kepala Seksi --',
                allowClear: true,
                ajax: {
                    url: '{{ route('users.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            intent: '{{ \App\Support\Enums\IntentEnum::USER_SELECT2_SEARCH_HEAD_OF_UNITS->value }}',
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(user) {
                                return {
                                    id: user.id,
                                    text: `${user.name} - ${user.unit?.name}`,
                                };
                            }),
                        };
                    },
                    cache: true,
                },
            });

            // Initialize select2 for OP Preset
            $('#op_preset_id').select2({
                placeholder: '-- Pilih Preset --',
                allowClear: true,
                ajax: {
                    url: '{{ route('op-presets.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            intent: '{{ \App\Support\Enums\IntentEnum::OP_PRESET_SELECT2_SEARCH_OP_PRESETS->value }}',
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(opPreset) {
                                return {
                                    id: opPreset.id,
                                    text: opPreset.name,
                                    data: opPreset, // Store the entire object for later use
                                };
                            }),
                        };
                    },
                    cache: true,
                },
            }).on('select2:select', function(e) {
                var data = e.params.data.data;
                updateFormFields(data);
            });

            function updateFormFields(data) {
                console.log(data);
                $('input[name="department"]').val(data.department);
                $('input[name="code"]').val(data.code);
                $('input[name="no"]').val(data.no);
                // $('input[name="date"]').val(data.date.split('T')[0]); // Format date
                $('input[name="first_requestor"]').val(data.first_requestor);
                $('input[name="second_requestor"]').val(data.second_requestor);
                $('input[name="approved_by"]').val(data.approved_by);
                // search for the head of section and trigger the change event to update the select2
                $('#head_of_section_id').select2('open');
                $('input.select2-search__field').eq(0).val(data.head_of_section.name).trigger('input');

                $('#head_of_section_id').val(data.head_of_section_id).trigger('change');
            }

            // Store selected checkboxes
            $('#pps-table').on('change', 'input[name="pp_ids[]"]', function() {
                const ppId = $(this).val();
                if ($(this).is(':checked')) {
                    selectedPPs.push(ppId);
                } else {
                    selectedPPs = selectedPPs.filter(id => id !== ppId);
                }
            });

            // Restore selected checkboxes when navigating between pages
            $('#pps-table').on('draw.dt', function() {
                $('input[name="pp_ids[]"]').each(function() {
                    if (selectedPPs.includes($(this).val())) {
                        $(this).prop('checked', true);
                    }
                });
            });

            // Select/Deselect all checkboxes
            $('#checkAll').on('change', function() {
                const isChecked = $(this).is(':checked');
                $('input[name="pp_ids[]"]').each(function() {
                    $(this).prop('checked', isChecked).trigger('change');
                });
            });

            const dateNeededSelect = document.getElementById('date-needed-select');
            const customDateGroup = document.getElementById('custom-date-group');
            const customDateInput = document.getElementById('custom-date-input');

            dateNeededSelect.addEventListener('change', function() {
                if (this.value === 'custom_date') {
                    // Show the custom date field
                    customDateGroup.style.display = 'flex';
                    customDateInput.removeAttribute('min');
                    customDateInput.removeAttribute('max');
                } else if (this.value === '2_bulan') {
                    // Show the custom date field with restricted range
                    customDateGroup.style.display = 'flex';

                    const currentDate = new Date();
                    const twoMonthsLater = new Date(currentDate);
                    twoMonthsLater.setMonth(currentDate.getMonth() + 2);

                    // Format the dates as YYYY-MM-DD for the input[type="date"]
                    const minDate = currentDate.toISOString().split('T')[0];
                    const maxDate = twoMonthsLater.toISOString().split('T')[0];

                    // Set the min and max attributes for the custom date input
                    customDateInput.setAttribute('min', minDate);
                    customDateInput.setAttribute('max', maxDate);
                    customDateInput.value = ''; // Clear any previous value to enforce range
                } else {
                    // Hide the custom date field for other options
                    customDateGroup.style.display = 'none';
                    customDateInput.removeAttribute('min');
                    customDateInput.removeAttribute('max');
                }
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
