<div class="input-group mb-3 @if(str_contains($class ?? '', 'is-invalid')) is-invalid @endif">
    <input type="password"
           class="form-control {{$class ?? ''}}"
           placeholder="{{$placeholder ?? ''}}"
           name="{{$name ?? ''}}"
           id="{{$id ?? ''}}"
           value="{{$value ?? ''}}"
           autocomplete="{{$autocomplete ?? 'on'}}"
           @if(!empty($required)) required @endif
           @if(isset($defaultValue)) default-value="{{$defaultValue}}" @endif

    >
    <div class="input-group-append cursor-pointer js-show-hidden">
        <span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
    </div>
</div>
