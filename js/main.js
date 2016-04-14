"use strict";

//function to handle all server side data requests
function dataRequest(url, params, callback){
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);


    xhr.addEventListener("load", function(){
        // console.log(xhr.responseText);

       callback(JSON.parse(xhr.responseText));
    });


    xhr.send(params);
}


function retrieveOne(contest){
    localStorage.setItem('contestId', contest.contest);
    location.assign("http://localhost:8888/newRaumJS/designer-contest.php");
}

function getHomeOwner(homeowner){
    console.log(homeowner);

    //TODO this needs some though

    localStorage.setItem('homeownerId', homeowner.user);
    
    if(localStorage.getItem('ut') == '1' ){

        location.assign("http://localhost:8888/newRaumJS/homeowner-view-designerProfile.php");
        
    } else {

        location.assign("http://localhost:8888/newRaumJS/designer-view-homeownerProfile.php");
        
    }
    
    

}

function retrieveOneHoCont(contest){
    localStorage.setItem('contestId', contest.contest);
    location.assign("http://localhost:8888/newRaumJS/homeowner-contest.php");
}

function sortActive(){

    let sortBy = event.target.innerHTML;
    let data = new FormData();
    data.append("sortActive", sortBy);
    //calls the data request function passing in desired url, parameters, and the function to fire upon callback
    dataRequest("api/sort.php", data, showSortedActiveContests);

}

function sortCompleted(){

    let sortBy = event.target.innerHTML;
    let data = new FormData();
    data.append("sortComplete", sortBy);
    //calls the data request function passing in desired url, parameters, and the function to fire upon callback
    dataRequest("api/sort.php", data, showSortedCompletedContests);
    
}

function showSortedActiveContests(data){

    document.getElementById("activerow").innerHTML = "";

    console.log( data[0].rooms[0].files[0].filename);

    if (data.length != 0) {

        for (let i=0; i < data.length; i++){

            data[i].closing_date = data[i].closing_date.split(/[- :]/);
            data[i].closing_date = new Date(data[i].closing_date[0], data[i].closing_date[1]-1, data[i].closing_date[2], data[i].closing_date[3], data[i].closing_date[4], data[i].closing_date[5]);
            console.log(data[i].closing_date);

            var s = "";
            s += "<div onclick='retrieveOne( this.dataset );' class='col-md-6' data-contest='" + data[i].project_id +"' >" +
                "<div class='card'>" +

                //TODO get the link to work
                "<a >" +
                "<div class='card-block'>" +
                "<h5 class='card-title'>" + data[i].project_title +"</h5>" +
                "<h6 class='card-subtitle text-muted'>"+ data[i].rooms[0].room_type +"</h6>" +
                "</div>" +

                "<div class='submittedBadge hidden'>" +
                "<span>Submitted</span>" +
                "</div>" +

                "<img class='card-img' src='upload/" + data[i].rooms[0].files[0].filename.slice(0, - 2) + "."+ data[i].rooms[0].files[0].filetype.substring(6) + " ' alt='Card image'>" +

                "<div class='card-block card-block-footer'>" +
                "<div class='row'>" +
                "<div class='col-xs-8'>"+
                "<span>Days Remaining</span>" + "<br>" +
                "<span class='prize'>"+ countdown(data[i].closing_date , null, countdown.DAYS) +"</span>" +
                "</div>" +
                "<div class='col-xs-4 text-xs-right'>"+
                "<span>Prize</span>" + "<br>" +
                "<span class='prize'>$"+ data[i].prize +"</span>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</a>"+
                "</div>"+
                "</div>";

            document.getElementById("activerow").innerHTML +=s;
        }
    }else {

        document.getElementById("active").innerHTML = "";
        document.getElementById("active").classList.add('cnt-center');


        var s = "";
        s +=
            "<p>You have no active contests.</p>"+
            "<p>Browse contests <a href='designer-browse.html'>here</a></p>";


        document.getElementById("active").innerHTML += s;


    }

}

function showSortedCompletedContests(data){

    console.log(data);

    document.getElementById("row").innerHTML = "";

    if (data.length != 0) {

        for (let i=0; i < data.length; i++){

            data[i].closing_date = data[i].closing_date.split(/[- :]/);
            data[i].closing_date = new Date(data[i].closing_date[0], data[i].closing_date[1]-1, data[i].closing_date[2], data[i].closing_date[3], data[i].closing_date[4], data[i].closing_date[5]);
            console.log(data[i].closing_date);

            var s = "";
            s += "<div onclick='retrieveOne( this.dataset );' class='col-md-6' data-contest='" + data[i].project_id +"' >" +
                "<div class='card'>" +

                //TODO get the link to work
                "<a >" +
                "<div class='card-block'>" +
                "<h5 class='card-title'>" + data[i].project_title +"</h5>" +
                "<h6 class='card-subtitle text-muted'>"+ data[i].rooms[0].room_type +"</h6>" +
                "</div>" +

                "<div class='submittedBadge hidden'>" +
                "<span>Submitted</span>" +
                "</div>" +

                "<img class='card-img' src='upload/" + data[i].rooms[0].filename + " ' alt='Card image'>" +

                "<div class='card-block card-block-footer'>" +
                "<div class='row'>" +
                "<div class='col-xs-8'>"+
                "<span>Days Remaining</span>" + "<br>" +
                "<span class='prize'>"+ countdown(data[i].closing_date , null, countdown.DAYS) +"</span>" +
                "</div>" +
                "<div class='col-xs-4 text-xs-right'>"+
                "<span>Prize</span>" + "<br>" +
                "<span class='prize'>$"+ data[i].prize +"</span>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</a>"+
                "</div>"+
                "</div>";



            document.getElementById("row").innerHTML +=s;
        }
    }else {
        document.getElementById("dashOutput").innerHTML = "";


        var s = "";
        s +=
            "<div id='completed' class='tab-pane fade in active cnt-center empty'>"+
            "<p>You have no completed contests.</p>"+
            "<p>Browse contests <a href='designer-browse.php'>here</a></p>"+
            "</div>"
        ;



        document.getElementById("dashOutput").innerHTML += s;
    }
}
