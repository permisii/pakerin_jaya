<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $params['title'] ?? '' }} @isset($params['subtitle'])
                        <small class="text-gray" style="font-size: 70%">| {{ $params['subtitle'] }}</small>
                    @endisset
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach ($breadcrumbs ?? [] as $name => $url)
                        @if ($url)
                            <li class="breadcrumb-item"><a href="{{ $url }}">{{ $name }}</a></li>
                        @else
                            <li class="breadcrumb-item active">{{ $name }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
