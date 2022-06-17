const getMovie = () => {
    let type = $("#media_type").val();
    let dayTime = $("#day").val();
    let weekTime = $("#week").val();
    let time = "";

    if(dayTime != null || dayTime != "") {
        time = dayTime;
    }
    if(weekTime != null || weekTime != "") {
        time = weekTime;
    }

    $.ajax({
        url: `https://api.themoviedb.org/3/trending/${type}/${time}?api_key=0fbe3dc01cd368614ceb64fe4ba06e32&`,
        type: "get",
        dataType: "json",
        success: function(data) {
            console.log(data);
            for (let i = 0; i < data.results.length; i++) {
                let title = data.results[i].title;
                let release = data.results[i].release_date;

                if (!title) {
                    title = data.results[i].name;
                }
                if (!release) {
                    release = data.results[i].first_air_date;
                }

                $("#table-body").append(`
                    <tr>
                        <td>${i+1}</td>
                        <td>${title}</td>
                        <td>${data.results[i].vote_count}</td>
                        <td>${data.results[i].vote_average}</td>
                        <td>${data.results[i].popularity}</td>
                        <td>${data.results[i].poster_path}</td>
                        <td>${data.results[i].backdrop_path}</td>
                        <td>${release}</td>
                    </tr>
                `);
            }
        }
    })
}

const insertMovie = (token) => {
    let type = $("#media_type").val();
    let dayTime = $("#day").val();
    let weekTime = $("#week").val();
    let time = "";
    let isMovie = 0;

    if (isMovie == "movie") {
        isMovie = 1;
    }

    if(dayTime != null || dayTime != "") {
        time = dayTime;
    }
    if(weekTime != null || weekTime != "") {
        time = weekTime;
    }
    
    for (let i = 1; i < 6; i++) {
        $.ajax({
            url: `https://api.themoviedb.org/3/trending/${type}/${time}?api_key=0fbe3dc01cd368614ceb64fe4ba06e32&page=${i}`,
            type: "get",
            dataType: "json",
            success: function(data) {
                let count = data.results.length;
                console.log(data);
                for (let i = 0; i < data.results.length; i++) {
                    console.log(data.results[i].overview)
                    let title = data.results[i].title;
                    let release = data.results[i].release_date;
                    let genre_id = data.results[i].genre_ids;
                    let gen_ids = genre_id.join();
    
                    if (!title) {
                        title = data.results[i].name;
                    }
                    if (!release) {
                        release = data.results[i].first_air_date;
                    }
    
                    $.ajax({
                        url: `http://localhost:8000/insert-movie`,
                        type: "post",
                        data: {
                            "id": data.results[i].id,
                            "title": title,
                            "vote_count": data.results[i].vote_count,
                            "vote_average": data.results[i].vote_average,
                            "popularity": data.results[i].popularity,
                            "poster_path": data.results[i].poster_path,
                            "backdrop_path": data.results[i].backdrop_path,
                            "genre_ids": gen_ids,
                            "release": release,
                            "synopsis": data.results[i].overview,
                            "is_movie": isMovie,
                            "_token": token
                        },
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
}