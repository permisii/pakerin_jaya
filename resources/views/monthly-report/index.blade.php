@extends('layouts.app')

@section('title', 'Instruksi Kerja')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row my-3">
                    <div class="offset-2 col-sm-6 col-md-8 col-lg-3">
                        <form method="GET" action="{{ route('monthly-report.index') }}" class="d-flex flex-column">
                            <div class="form-group d-flex flex-fill m-0">
                                <div class="d-flex flex-fill flex-column justify-content-end">
                                    <div class="row flex-nowrap px-2">
                                        <div class="d-flex flex-column text-bold">
                                            <div>Tanggal</div>
                                            <div class="mt-4">Pekerja</div>
                                        </div>
                                        <div class="d-flex flex-fill flex-column ml-2">
                                            <input type="text" name="date_range" id="date_range"
                                                   class="form-control form-control-sm"
                                                   placeholder="Select Date Range"
                                                   value="{{ request('date_range') }}">
                                            <select class="form-control form-control-sm mt-2" name="worker_id"
                                                    id="worker_id">
                                                <!-- Options will be populated dynamically -->
                                            </select>

                                            <div class="btn-group btn-block d-flex justify-content-end mt-2">
                                                <div class="btn-group btn-block d-flex justify-content-end mt-2">
                                                    <button type="submit" class="btn btn-default btn-sm">
                                                        <i class="fas fa-fw fa-search"></i>
                                                        Filter
                                                    </button>
                                                    <a href="{{ route('monthly-report.index') }}"
                                                       class="btn btn-default btn-sm">
                                                        <i class="fas fa-undo"></i>
                                                        Reset
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{--                @if(!$todayWorkInstruction)--}}
                {{--                    <div class="alert alert-warning">--}}
                {{--                        No work instruction for today.--}}

                {{--                        <a href="{{ route('work-instructions.create') }}"--}}
                {{--                           class="ml-2 btn btn-primary text-decoration-none">--}}
                {{--                            <i class="fas fa-plus"></i>--}}
                {{--                            Create Work Instruction--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                @endif--}}

                {{$dataTable->table(['class' => 'table table-bordered'])}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{$dataTable->scripts()}}

    <script>
        $(document).ready(function() {
            $('#worker_id').select2({
                placeholder: '-- Select Workers --',
                allowClear: true,
                theme: 'default mt-2',
                ajax: {
                    url: '{{ route('users.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            intent: '{{ \App\Support\Enums\IntentEnum::USER_SELECT2_SEARCH_USERS->value }}',
                            column_filters: {
                                technician: 1,
                            },
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

            $('input[name="date_range"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD',
                },
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });

    </script>
@endsection
