@php use App\Support\Enums\IntentEnum; @endphp
@extends('layouts.app')

@section('content')
    <form action="{{route('work-instructions.store')}}" method="post" id="create-form" onsubmit="confirmCreate(event)">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">

                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Work Instructions</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Worker</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2" name="user_id">
                                    <option value="">-- Pilih Worker --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control form-control-sm" id="work_date"
                                       name="work_date">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('work-instructions.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali Ke Daftar WorkInstruction
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Simpan
                            </button>

                            <a class="btn btn-default text-maroon" href="{{route('work-instructions.index')}}">
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
    <script>
        $(document).ready(function() {
            // Set default current date
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('work_date').value = today;

            $('.select2').select2({
                placeholder: '-- Pilih Worker --',
                allowClear: true,
                ajax: {
                    url: '{{ route('users.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            intent: '{{ IntentEnum::USER_SEARCH_USERS->value }}', // intent parameter
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(user) {
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
