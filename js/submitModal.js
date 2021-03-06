var userSubmission;
var projID;

function submitTo(id){

    projID = id;

    var form = document.getElementById('uploadForm');
    var dropZone = document.getElementById('dropZone');

    var startUpload = function(files) {

        var progP = document.querySelector("p.progBar");
        document.getElementById("imageUploadBox").classList.add("hidden");
        document.getElementById("imagePreview").classList.remove("hidden");

        var imageHeader = document.getElementById("imgName")
        imageHeader.innerHTML = truncate(files[0].name);
        var deleteIcon = document.createElement("i");
        deleteIcon.setAttribute("class","fa fa-times pull-xs-right");
        imageHeader.appendChild(deleteIcon);

        setTimeout(function(){ progP.classList.add("loading"); }, 500);

        
        var data = new FormData();
        data.append("SelectedFile", files[0]);

        dataRequest("api/fileUpload.php", data, function(response){

            if (response.code == 0){

                //add file to project files object
               userSubmission = {
                    projectId: id,
                   file: {
                       name: response.fileName,
                       originalName: files[0].name,
                       type: files[0].type,
                       size: files[0].size,
                   },
                    description: "",
                    budget: null
                };

                deleteIcon.addEventListener("click", function(){ deleteImage(response.fileName)});

                setTimeout(function(){
                    progP.classList.add("success");
                }, 2000);

                setTimeout(function(){
                    var thumb = document.querySelector("#imagePreview > img.myThumb");
                    thumb.src = "upload/" + response.fileName;

                },4500);


            }else{
                console.log(response.message);

                //TODO file type not supported
            }
        });

    }

    form.addEventListener('submit', function(e) {
        var uploadFiles = document.getElementById('uploadFiles').files;
        e.preventDefault()

        if (uploadFiles.length > 0 && oneFileBool){
            oneFileBool = false;
            console.log("UPLOAD NOW");
            startUpload(uploadFiles);
        }

    });

    dropZone.ondrop = function(e) {
        e.preventDefault();
        this.className = 'upload-drop-zone';

        startUpload(e.dataTransfer.files)
    }

    dropZone.ondragover = function() {
        this.className = 'upload-drop-zone drop';
        return false;
    }

    dropZone.ondragleave = function() {
        this.className = 'upload-drop-zone';
        return false;
    }

}

function subBtnActivate(){

    oneFileBool = true;
    document.getElementById("uploadSubmit").click();
}

function showBudgetValue(value){

    document.getElementById("budgetVal").innerHTML= "$" + value;

}

function truncate(string){
    if (string.length > 15)
        return string.substring(0,15)+'...';
    else
        return string;
}

function deleteImage(file){

    var data = new FormData();
    data.append("file",file);
    dataRequest("api/deleteUpload.php", data, function(res){

        document.getElementById("imageUploadBox").classList.remove("hidden");
        document.getElementById("imagePreview").classList.add("hidden");

        var thumb = document.querySelector("#imagePreview > img.myThumb");
        thumb.src = "img/imgPlaceHolder.png";

        var progP = document.querySelector("p.progBar");
        progP.className = "progBar";


    });
}

function clearModal(){

    document.getElementById("submissionDesc").value = "";
    document.getElementById("budgetSlider").value = 500;

}

function finalizeSubmit(){

    userSubmission.description = document.getElementById("submissionDesc").value;
    userSubmission.budget = document.getElementById("budgetSlider").value;


    var data = new FormData();
    data.append("projID", projID);
    data.append("file", JSON.stringify(userSubmission.file));
    data.append("desc", userSubmission.description);
    data.append("budget", userSubmission.budget);

    dataRequest("api/submissionUpload.php", data, function(res){

        if  (res.code == 0){
            console.log ("SUCCESS SUB UPLOAD");


            location.reload();


        }else{
            console.log("error :(");
        }
    });

    document.getElementById("submitBtn").setAttribute("data-dismiss","modal");



}
