
@if (!is_null(Session::get('status_error')))
<div class="alert alert-error">
    <a class="close" data-dismiss="alert" href="#">×</a>
    
    @if (is_array(Session::get('status_error')))
        <ul>
        @foreach (Session::get('status_error') as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @else
        {{ Session::get('status_error') }}
    @endif
</div>
@endif
@if (!is_null(Session::get('status_success')))
<div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    
    @if (is_array(Session::get('status_success')))
        <ul>
        @foreach (Session::get('status_success') as $success)
            <li>{{ $success }}</li>
        @endforeach
        </ul>
    @else
        {{ Session::get('status_success') }}
    @endif
</div>
@endif