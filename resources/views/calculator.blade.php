<div  id="app">
    <calculator
        api-base="{!! URL::to('/') !!}/api"
        display-length="8"
        id="{!! Config::get('user.front_email') !!}"
        pw="{!! Config::get('user.front_password') !!}"
    ></calculator>
</div>
