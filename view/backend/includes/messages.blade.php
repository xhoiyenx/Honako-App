@if ( $errors->count() > 0 )
<div class="alert alert-danger">
  @foreach ($errors->all() as $error)
    {{ $error }}<br>        
  @endforeach
</div>
@endif
@if(session()->has('info'))
<div class="alert alert-info">
  {{session()->get('info')}}
</div>
@endif