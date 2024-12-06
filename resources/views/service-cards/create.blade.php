@extends('layouts.app')

@section('content')
    <form action="{{ route('service-cards.store') }}" method="post" id="create-form">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Service Card Details</span></h6>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">No. PK</label>
                            <div class="col-sm-4">
                                <input class="form-control form-control-sm" name="assignment_number" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Tanggal</label>
                            <div class="col-sm-4">
                                <input id="date" type="date" class="form-control form-control-sm" name="date" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Pekerja</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2" name="worker_ids[]" id="worker_ids"
                                        multiple required>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Deskripsi</label>
                            <div class="col-sm-4">
                                {{--                                <textarea class="form-control form-control-sm" name="description" required></textarea>--}}
                                <div id="editor">
                                    <p>Tell your story!</p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="description" id="description">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Tipe Device</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2 disabled" name="device_type"
                                        id="device_type"
                                        required readonly>
                                    <option value="">-- Select Device Type --</option>
                                    <option value="App\Models\PC">PC</option>
                                    <option value="App\Models\Printer">Printer</option>
                                </select>
                            </div>
                        </div>

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-sm-2 col-form-label text-right">Device ID</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <select class="form-control form-control-sm select2" name="fake_device_id" id="device_id"--}}
                        {{--                                    required readonly>--}}
                        {{--                                    <option value="">-- Select Device ID --</option>--}}
                        {{--                                    <!-- Dynamically populate based on device type -->--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <input type="hidden" name="device_id" value="{{ request()->query('device_id') }}">
                        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="updated_by" value="{{ auth()->user()->id }}">

                    </div>

                    <div class="card-footer">
                        <a id="button-back"
                           href="{{ request()->query('device_type') == 'App\Models\PC' ? route('pcs.index') : route('printers.index') }}"
                           class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Back
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Save
                            </button>

                            <a class="btn btn-default text-maroon" href="{{ route('service-cards.index') }}">
                                <i class="fas fa-ban"></i>
                                Cancel
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
            const quill = new window.Quill('#editor', {
                theme: 'snow',
            });

            $('#create-form').on('submit', function() {
                $('#description').val(quill.root.innerHTML);
            });

            document.getElementById('date').valueAsDate = new Date();

            $('#worker_ids').select2({
                placeholder: '-- Select Workers --',
                allowClear: true,
                ajax: {
                    url: '{{ route('users.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            intent: '{{ \App\Support\Enums\IntentEnum::USER_SELECT2_SEARCH_USERS->value }}',
                            // column_filters: {
                            //     technician: 1
                            // }
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

            $('#device_type').change(function() {
                var deviceType = $(this).val();
                $('#device_id').empty().trigger('change');

                if (deviceType) {
                    var url = deviceType === 'App\\Models\\PC' ? '{{ route('pcs.index') }}' : '{{ route('printers.index') }}';
                    $.ajax({
                        url: url,
                        data: {
                            intent: deviceType === 'App\\Models\\PC' ? '{{ \App\Support\Enums\IntentEnum::PC_SELECT2_SEARCH_PCS->value }}' : '{{ \App\Support\Enums\IntentEnum::PRINTER_SELECT2_SEARCH_PRINTERS->value }}',
                        },
                        success: function(data) {
                            var options = data.data.map(function(device) {
                                if (deviceType === 'App\\Models\\PC') {
                                    return {
                                        id: device.id,
                                        text: `${device.name} - ${device.date_of_initial_use}`,
                                    };
                                } else {
                                    return {
                                        id: device.id,
                                        text: `${device.brand} - ${device.date_of_initial_use}`,
                                    };
                                }
                            });
                            $('#device_id').select2({
                                data: options,
                                placeholder: '-- Select Device ID --',
                                allowClear: true,
                            });
                        },
                    });
                }
            });

            // TODO: experimental - might be buggy
            var urlParams = new URLSearchParams(window.location.search);
            var deviceType = urlParams.get('device_type');
            var deviceNameOrBrand = urlParams.get(deviceType === 'App\\Models\\PC' ? 'device_name' : 'device_brand');
            var deviceIdField = $('#device_id');

            if (deviceType) {
                $('#device_type').val(deviceType).trigger('change');

                var url = deviceType === 'App\\Models\\PC' ? '{{ route('pcs.index') }}' : '{{ route('printers.index') }}';
                $.ajax({
                    url: url,
                    data: {
                        search: deviceNameOrBrand,
                        intent: deviceType === 'App\\Models\\PC' ? '{{ \App\Support\Enums\IntentEnum::PC_SELECT2_SEARCH_PCS->value }}' : '{{ \App\Support\Enums\IntentEnum::PRINTER_SELECT2_SEARCH_PRINTERS->value }}',
                    },
                    success: function(data) {
                        var options = data.data.map(function(device) {
                            return {
                                id: device.id,
                                text: deviceType === 'App\\Models\\PC' ? device.name : device.brand,
                            };
                        });
                        deviceIdField.select2({
                            data: options,
                            placeholder: '-- Select Device ID --',
                            allowClear: true,
                        });

                        if (options.length > 0) {
                            deviceIdField.val(options[0].id).trigger('change');
                        }
                    },
                });
            }

            $('#device_type').change(function() {
                var deviceType = $(this).val();
                deviceIdField.empty().trigger('change');

                if (deviceType) {
                    var url = deviceType === 'App\\Models\\PC' ? '{{ route('pcs.index') }}' : '{{ route('printers.index') }}';
                    $.ajax({
                        url: url,
                        data: {
                            intent: deviceType === 'App\\Models\\PC' ? '{{ \App\Support\Enums\IntentEnum::PC_SELECT2_SEARCH_PCS->value }}' : '{{ \App\Support\Enums\IntentEnum::PRINTER_SELECT2_SEARCH_PRINTERS->value }}',
                        },
                        success: function(data) {
                            var options = data.data.map(function(device) {
                                return {
                                    id: device.id,
                                    text: deviceType === 'App\\Models\\PC' ? device.name : device.brand,
                                };
                            });
                            deviceIdField.select2({
                                data: options,
                                placeholder: '-- Select Device ID --',
                                allowClear: true,
                            });
                        },
                    });
                }
            });
        });
    </script>
@endsection
