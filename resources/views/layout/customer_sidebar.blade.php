<div class="col-2 pt-3 left-side shadow" style="padding: 0">
  <nav class="navbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#"
          >offer Pakage
          <i class="bi bi-arrow-right"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href=""
          >Your Favorite Products
          <i class="bi bi-arrow-right"></i>
        </a>
      </li>
    </ul>
  </nav>

  <div class="left-bottom-div bg-light">
    <div class="navbar left-bottom-nav bg-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a
            class="nav-link categorybutton" href="{{route('customer-profile',Session::get('userId'))}}"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Profile Update
          </a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Order List
          </a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Wishlist
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
@push('scripts')
<script>
  $('.categorybutton').each(function(e){
          $(this).addClass("show");
          $(this).next('ul').addClass("show");
  })

  $('.categorybutton').click(function(){
      window.location=$(this).attr('href');
  })
</script>

@endpush
