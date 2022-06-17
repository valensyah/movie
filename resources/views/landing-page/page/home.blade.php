@extends('landing-page.app')
@section('content')
<section id="home-slider">
  <!-- Slider main container -->
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      <div class="swiper-slide"></div>
      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>
  
      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
  
      <!-- If we need scrollbar -->
      <div class="swiper-scrollbar"></div>
    </div>
  </div>
</section>

<section id="home-btn-genre">
  <div class="row d-flex justify-content-center mt-4 ms-0 btn-category">
    @foreach ($genre as $g)
      <button class="btn btn-md btn-outline-success text-white btn-genre me-2 mb-2">{{ $g->name }}</button>
    @endforeach
  </div>
</section>

<section id="home-movie-top" class="p-4">
  <h3 class="text-left text-white">
    Top Rated Movie
  </h3>
  <hr>
  <div class="movie-container">
    <div class="movie-list">
      @foreach($movie_top as $m)
        <div class="card card-movie mx-3 p-0 mb-3">
          <img src="{{ $m->poster_path }}" class="card-img-top card-img-poster" alt="{{ $m->title }}">
          <div class="card-body">
            <h5 class="card-title card-movie-title">{{ $m->title }}</h5>
            <div style="display: flex">
              <div class="icon me-2">
                <img src="{{ asset('images/star.png') }}" alt="">
              </div>
              <p class="mb-0" style="margin-top: 2px">{{ $m->vote_average }}</p>
            </div>
            {{-- <p class="card-text" style="text-overflow: ellipsis !important; overflow: hidden; white-space: nowrap;">{{ $m->synopsis }}</p> --}}
          </div>
          <a href="javascript:void(0)" onclick="getMovie({{ $m->id }})" id="btn-modal-movie" class="nav-link" data-bs-toggle="modal" data-bs-target="#movieModal">Read More</a>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section id="home-movie-now" class="p-4">
  <h3 class="text-left text-white">
    Now Playing
  </h3>
  <hr>
  <div class="movie-container">
    <div class="movie-list">
      @foreach($movie_now as $m)
        <div class="card card-movie mx-3 p-0 mb-3">
          <img src="{{ $m->poster_path }}" class="card-img-top card-img-poster" alt="{{ $m->title }}">
          <div class="card-body">
            <h5 class="card-title card-movie-title">{{ $m->title }}</h5>
            <div style="display: flex">
              <div class="icon me-2">
                <img src="{{ asset('images/star.png') }}" alt="">
              </div>
              <p class="mb-0" style="margin-top: 2px">{{ $m->vote_average }}</p>
            </div>
            {{-- <p class="card-text" style="text-overflow: ellipsis !important; overflow: hidden; white-space: nowrap;">{{ $m->synopsis }}</p> --}}
          </div>
          <a href="javascript:void(0)" onclick="getMovie({{ $m->id }})" id="btn-modal-movie" class="nav-link" data-bs-toggle="modal" data-bs-target="#movieModal">Read More</a>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section id="home-movie-up" class="p-4">
  <h3 class="text-left text-white">
    Upcoming
  </h3>
  <hr>
  <div class="movie-container">
    <div class="movie-list">
      @foreach($movie_upcoming as $m)
        <div class="card card-movie mx-3 p-0 mb-3">
          <img src="{{ $m->poster_path }}" class="card-img-top card-img-poster" alt="{{ $m->title }}">
          <div class="card-body">
            <h5 class="card-title card-movie-title">{{ $m->title }}</h5>
            <div style="display: flex">
              <div class="icon me-2">
                <img src="{{ asset('images/star.png') }}" alt="">
              </div>
              <p class="mb-0" style="margin-top: 2px">{{ $m->vote_average }}</p>
            </div>
            {{-- <p class="card-text" style="text-overflow: ellipsis !important; overflow: hidden; white-space: nowrap;">{{ $m->synopsis }}</p> --}}
          </div>
          <a href="javascript:void(0)" onclick="getMovie({{ $m->id }})" id="btn-modal-movie" class="nav-link" data-bs-toggle="modal" data-bs-target="#movieModal">Read More</a>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section id="home-movie-series" class="p-4">
  <h3 class="text-left text-white">
    TV Series
  </h3>
  <hr>
  <div class="movie-container">
    <div class="movie-list">
      @foreach($movie_series as $m)
        <div class="card card-movie mx-3 p-0 mb-3">
          <img src="{{ $m->poster_path }}" class="card-img-top card-img-poster" alt="{{ $m->title }}">
          <div class="card-body">
            <h5 class="card-title card-movie-title">{{ $m->title }}</h5>
            <div style="display: flex">
              <div class="icon me-2">
                <img src="{{ asset('images/star.png') }}" alt="">
              </div>
              <p class="mb-0" style="margin-top: 2px">{{ $m->vote_average }}</p>
            </div>
            {{-- <p class="card-text" style="text-overflow: ellipsis !important; overflow: hidden; white-space: nowrap;">{{ $m->synopsis }}</p> --}}
          </div>
          <a href="javascript:void(0)" onclick="getMovie({{ $m->id }})" id="btn-modal-movie" class="nav-link" data-bs-toggle="modal" data-bs-target="#movieModal">Read More</a>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section id="movie-modal">
  <!-- Modal -->
  <div class="modal fade modal-fullscreen-md-down" id="movieModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-lg-4 text-center movie-modal-img">
              
            </div>
            <div class="col-lg-8">
              <div class="d-flex flex-column">
                <p id="genre"></p>
                <p id="vote-count"></p>
                <p id="vote-average"></p>
                <p id="release-date"></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="movie-modal-synopsis text-left"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section("page-js")
<script>
  // init Swiper:
  const swiper = new Swiper('.swiper', {
      // Optional parameters
      direction: 'horizontal',
      loop: true,

      autoplay: {
          delay: 5000,
      },
  
      // If we need pagination
      pagination: {
      el: '.swiper-pagination',
      },
  
      // Navigation arrows
      navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
      },
  
      // And if we need scrollbar
      // scrollbar: {
      // el: '.swiper-scrollbar',
      // },
  });
</script>
<script>
  const getMovie = (id) => {
    $.ajax({
      url: `{{ url('/get-movie') }}/${id}`,
      type: "get",
      dataType: "json",
      success: function(data) {
        $(".modal-title").text('');
        $(".movie-modal-img").html('');
        $(".movie-modal-synopsis").text('');
        $("#genre").text('');
        $("#vote-count").text('');
        $("#vote-average").text('');
        $("#release-date").text('');

        $(".modal-title").text(`${data['title']}`);
        $(".movie-modal-img").append(`
          <img class="modal-img-poster rounded mb-3" src="${data['poster_path']}">
        `);
        $(".movie-modal-synopsis").text(`${data['synopsis']}`);
        $("#genre").text(`Genre : ${data['genre']}`);
        $("#vote-count").text(`Total Count : ${data['vote_count']}`)
        $("#vote-average").text(`Rating : ${data['vote_average']}`)
        $("#release-date").text(`Release : ${data['release']}`)
      }
    })
  }
</script>
@endsection