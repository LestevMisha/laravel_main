<div>
    @include('templates.header')
    <div class="card">
        <div class="card-body">
            {{ $errors?->first('error') }}
        </div>
    </div>
</div>
