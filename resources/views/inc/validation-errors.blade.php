@if(count($errors) > 0)
    <div class="validation-errors alert alert-danger">
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
    </div>
@endif 

@if(isset($customErrors))
<div class="validation-errors alert alert-danger">
    @foreach($customErrors as $k => $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif