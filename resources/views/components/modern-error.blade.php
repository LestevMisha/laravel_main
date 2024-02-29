@if ($errors->any())
    @foreach ($errors->getMessages() as $key => $message)
        <span class="text-error more mt-1">
            {!! $message[0] !!}
        </span>
    @endforeach
@endif
