@if ($errors->any())
    <div class="alert alert-danger border-left-danger" role="alert">
        <ul class="pl-4 my-2">
            @foreach ($errors->all() as $error)
                <li>{{ str_replace('_',' ', $error) }}</li>
            @endforeach
        </ul>
    </div>
@endif
