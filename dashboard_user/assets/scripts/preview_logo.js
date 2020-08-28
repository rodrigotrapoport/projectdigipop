function previewImage() {
    var file = document.getElementById("file").files;
    if (file.length > 0) {
        var fileReader = new FileReader();

        fileReader.onload = function (event) {
            document.getElementById("preview").setAttribute("src", event.target.result);
        };

        fileReader.readAsDataURL(file[0]);
        
    }
    
}


function previewImageX() {
    var fileX = document.getElementById("fileB").files;
    if (fileX.length > 0) {
        var fileReader = new FileReader();

        fileReader.onload = function (event) {
            document.getElementById("previewB").setAttribute("src", event.target.result);
        };

        fileReader.readAsDataURL(fileX[0]);
        
    }
    
}



function previewImage1() {
    var file = document.getElementById("file1").files;
    if (file.length > 0) {
        var fileReader = new FileReader();

        fileReader.onload = function (event) {
            document.getElementById("preview1").setAttribute("src", event.target.result);
        };

        fileReader.readAsDataURL(file[0]);
    }
}
function previewImage2() {
    var file = document.getElementById("file2").files;
    if (file.length > 0) {
        var fileReader = new FileReader();

        fileReader.onload = function (event) {
            document.getElementById("preview2").setAttribute("src", event.target.result);
        };

        fileReader.readAsDataURL(file[0]);
    }
}
function previewImage3() {
    var file = document.getElementById("file3").files;
    if (file.length > 0) {
        var fileReader = new FileReader();

        fileReader.onload = function (event) {
            document.getElementById("preview3").setAttribute("src", event.target.result);
        };

        fileReader.readAsDataURL(file[0]);
    }
}
function previewImage4() {
    var file = document.getElementById("file4").files;
    if (file.length > 0) {
        var fileReader = new FileReader();

        fileReader.onload = function (event) {
            document.getElementById("preview4").setAttribute("src", event.target.result);
        };

        fileReader.readAsDataURL(file[0]);
    }
}
function previewImage5() {
    var file = document.getElementById("file5").files;
    if (file.length > 0) {
        var fileReader = new FileReader();

        fileReader.onload = function (event) {
            document.getElementById("preview5").setAttribute("src", event.target.result);
        };

        fileReader.readAsDataURL(file[0]);
    }
}