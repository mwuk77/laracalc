
<div class="calculator">
    <input class="display" type="text">
    <div class="buttons">
        @foreach ($buttons as $button)<button data-key='{{ $button }}'>{{ $button }}</button>@endforeach
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/components/calculator.js')}}"></script>
<script type='text/javascript'>
    setKeys({!! json_encode($buttons) !!});
    
    setApiBase("{!! URL::to('/') !!}/api");
    
    /*
     * Laravel auth guard uses plain password to check against the hash.
     * I'm uncomfortable sending it like this, but with SSL the connection 
     * should be private.
     */
    setCreds("{!! Config::get('user.front_email') !!}", 
        "{!! Config::get('user.front_password') !!}");

    bindKeys(keyboardJS);
    
    getToken();
    
    updateDisplay('');
</script>