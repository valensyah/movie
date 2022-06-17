<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Hello, world!</title>
</head>

<body>
    <div class="loader">
        <img src="{{ asset('images/load-icon.png') }}" width="50" class="loader-img" style="display: none;"/>
    </div>
    <div class="container-fluid">
        <section name="navbar">
            <nav class="px-2 navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </section>

        <section name="banner-search">
            <!-- <form action="" method="POST"> -->
                <div class="banner">
                    <h2 class="text-center">Search Trending Movie</h1>
                    @if (count($data) == 0)
                        <button class="btn btn-md btn-outline-success mb-3" onclick="getGenre()">Generate Genre</button>
                    @else
                        <button class="btn btn-md btn-outline-success mb-3" disabled>Generate Genre</button>
                    @endif
                    <select name="media_type" id="media_type" class="form-control">
                        <option value="">-Select-</option>
                        <option value="movie">Movie</option>
                        <option value="tv">TV</option>
                    </select>
                    <br>
                    <h5>Trending Timeline</h5>
                    <input type="radio" id="day" class="form-check-input" name="timeline" value="day">
                    <label for="day">Day</label><br>
                    <input type="radio" id="week" class="form-check-input" name="timeline" value="week">
                    <label for="week">Week</label>
                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                </div>
    
                <div class="button-sbt d-flex justify-content-center" style="width: 100%;">
                    <button class="btn btn-outline-primary btn-lg me-2" onclick="getMovie()">Submit</button>
                    <button class="btn btn-outline-primary btn-lg" onclick="let token = document.getElementById('token').value; insertMovie(token)">Insert</button>
                </div>
            <!-- </form> -->
        </section>

        <section name="table">
            <div class="table-data container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Vote Count</th>
                            <th>Vote Average</th>
                            <th>Popularity Score</th>
                            <th>Release Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body"></tbody>
                </table>
            </div>
        </section>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        const getGenre = () => {
        let array = [];
        $.ajax({
            url: `https://api.themoviedb.org/3/genre/movie/list?api_key=0fbe3dc01cd368614ceb64fe4ba06e32&language=en-US`,
            type: "get",
            dataType: "json",
            success: function(data) {
                let count = data.genres.length;
                for (let i = 0; i < data.genres.length; i++) {
                    let id = data.genres[i].id;
                    let name = data.genres[i].name;
                    
                    $.ajax({
                        headers: {
                            'Access-Control-Allow-Origin': '*',
                        },
                        url: `http://127.0.0.1:8000/insert-genre/${id}/${name}`,
                        data: {"_token": "{{ csrf_token() }}"},
                        type: "post",
                        dataType: "json",
                        success: function(data) {
                            if (i != count - 1) {
                                document.querySelector(".loader-img").style.display = "";
                            }

                            if (i == count - 1) {
                                document.querySelector(".loader-img").style.display = "none";
                                alert(`${data.message}`);
                                location.reload();
                            }
                        }
                    })

                }
            }
        })
    }
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>