@extends('layouts.app')

@section('content')
    <form action="{{ route('service-cards.update', $serviceCard->id) }}" method="post" id="edit-form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Service Card Details</span></h6>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Assignment</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2" id="assignment_id"
                                        name="assignment_id" required>
                                    <option value="">-- Select Assignment --</option>
                                    <!-- Populate with assignments -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Date</label>
                            <div class="col-sm-4">
                                <input id="date" type="date" class="form-control form-control-sm" name="date" value="{{ $serviceCard->date }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Worker</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2" id="worker_id" name="worker_id"
                                        required>
                                    <option value="">-- Select Worker --</option>
                                    <!-- Populate with users -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Description</label>
                            <div class="col-sm-4">
                                <textarea class="form-control form-control-sm" name="description" required>{{ $serviceCard->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Device Type</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2" name="device_type" id="device_type"
                                        required>
                                    <option value="">-- Select Device Type --</option>
                                    <option value="App\Models\PC" {{ $serviceCard->device_type == 'App\Models\PC' ? 'selected' : '' }}>PC</option>
                                    <option value="App\Models\Printer" {{ $serviceCard->device_type == 'App\Models\Printer' ? 'selected' : '' }}>Printer</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Device ID</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2" name="device_id" id="device_id"
                                        required>
                                    <option value="">-- Select Device ID --</option>
                                    <!-- Dynamically populate based on device type -->
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">

                    </div>

                    <div class="card-footer">
                        <a href="{{ route('service-cards.index') }}" class="btn btn-default">
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

    {{$serviceCard->device_type}}
@endsection

@section('scripts')
    <script>

        // TODO: experimental - might be buggy
        $(document).ready(function() {
            document.getElementById('date').valueAsDate = new Date('{{ $serviceCard->date }}');
            function fetchAndSetSelect2Value(selector, url, value, text, intent) {
                $.ajax({
                    url: url,
                    data: {
                        id: value,
                        intent: intent
                    },
                    success: function(data) {
                        var option = new Option(text, value, true, true);
                        $(selector).append(option).trigger('change');
                    }
                });
            }

            $('#assignment_id').select2({
                placeholder: '-- Select --',
                allowClear: true,
                ajax: {
                    url: '{{ route('assignments.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            intent: '{{ \App\Support\Enums\IntentEnum::ASSIGNMENT_SELECT2_SEARCH_ASSIGNMENTS->value }}',
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(assignment) {
                                return {
                                    id: assignment.id,
                                    text: `${assignment.assignment_number} - ${assignment.problem}`,
                                };
                            }),
                        };
                    },
                    cache: true,
                },
            });

            $('#worker_id').select2({
                placeholder: '-- Select --',
                allowClear: true,
                ajax: {
                    url: '{{ route('users.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            intent: '{{ \App\Support\Enums\IntentEnum::USER_SELECT2_SEARCH_USERS->value }}',
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
                            var options = data.map(function(device) {
                                return {
                                    id: device.id,
                                    text: deviceType === 'App\\Models\\PC' ? device.name : device.brand,
                                };
                            });
                            $('#device_id').select2({
                                data: options,
                                placeholder: '-- Select Device ID --',
                                allowClear: true,
                            });

                            // Set the initial value for device_id
                            $('#device_id').val('{{ $serviceCard->device_id }}').trigger('change');
                        },
                    });
                }
            });

            // Set initial values for select2 fields
            fetchAndSetSelect2Value('#assignment_id', '{{ route('assignments.index') }}', '{{ $serviceCard->assignment_id }}', '{{ $serviceCard->assignment->assignment_number }} - {{ $serviceCard->assignment->problem }}', '{{ \App\Support\Enums\IntentEnum::ASSIGNMENT_SELECT2_SEARCH_ASSIGNMENTS->value }}');
            fetchAndSetSelect2Value('#worker_id', '{{ route('users.index') }}', '{{ $serviceCard->worker_id }}', '{{ $serviceCard->worker->nip }} - {{ $serviceCard->worker->name }}', '{{ \App\Support\Enums\IntentEnum::USER_SELECT2_SEARCH_USERS->value }}');
            $('#device_type').val('{{ addslashes($serviceCard->device_type) }}').trigger('change');
        });
    </script>
@endsection
