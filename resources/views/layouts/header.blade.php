
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Domain Leads</a>
    </div>
    <ul class="nav navbar-nav">
      <li @if (Request::path() == '/') class="active" @endif><a href="{{ URL::to('/') }}">Home</a></li>
      <li @if (Request::path() == 'importExport') class="active" @endif><a href="{{ URL::to('importExport') }}"> Import CSV</a></li>
      <li @if (Request::path() == 'postSearchData') class="active" @endif><a href="{{ URL::to('postSearchData') }}"> Search Domain</a></li>
      <li> <a href="{{ URL::to('logout') }}">Logout</a></li>
    </ul>
  </div>
</nav>