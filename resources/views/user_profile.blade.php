this user profile page {!! Html::link('mylogout','click here to logout')!!}
@if(Auth::check())
  Th user is logged in...
  {{  Auth::id()}}
  	{{  Auth::user()->email}}
@endif
