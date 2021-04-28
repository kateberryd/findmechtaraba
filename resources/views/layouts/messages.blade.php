
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    <div class="alert-body">
      {{ Session::get('message') }}
    </div>
</div>
@elseif(Session::has('error'))
<div class="alert alert-danger" role="alert">
    <div class="alert-body">
    {{ Session::get('message') }}
    </div>
</div>
@endif
