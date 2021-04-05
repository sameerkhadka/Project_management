window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

var selDiv = "";
var storedFiles = [];

$(document).ready(function() {
    $("#files").on("change", handleFileSelect);
    
    selDiv = $("#selectedFiles"); 
    $("#myForm").on("submit", handleForm);
    
    $("body").on("click", ".selFile", removeFile);
});
    
function handleFileSelect(e) {
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    filesArr.forEach(function(f) {			

        if(!f.type.match("image.*")) {
            return;
        }
        storedFiles.push(f);
        
        var reader = new FileReader();
        reader.onload = function (e) {
            var html = "<div><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selFile' title='Click to remove'>" + f.name + "<br clear=\"left\"/></div>";
            selDiv.append(html);
            
        }
        reader.readAsDataURL(f); 
    });
    
}
    
function handleForm(e) {
    e.preventDefault();
    var data = new FormData();
    
    for(var i=0, len=storedFiles.length; i<len; i++) {
        data.append('files', storedFiles[i]);	
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'handler.cfm', true);
    
    xhr.onload = function(e) {
        if(this.status == 200) {
            console.log(e.currentTarget.responseText);	
            alert(e.currentTarget.responseText + ' items uploaded.');
        }
    }
    
    xhr.send(data);
}
    
function removeFile(e) {
    var file = $(this).data("file");
    for(var i=0;i<storedFiles.length;i++) {
        if(storedFiles[i].name === file) {
            storedFiles.splice(i,1);
            break;
        }
    }
    $(this).parent().remove();
}


$(window).scroll(function () {
    var sc = $(window).scrollTop()
    if (sc > 1) {
        $("#navbar").addClass("navfix")
    } else {
        $("#navbar").removeClass("navfix")
    }
});

$('#profile-click').click(function (e) {
    e.preventDefault();
    $('.prf-box').toggleClass('show');
    e.stopPropagation();

    $(document).on("click", function(e) {
        if ($(e.target).is(".prf-box") === false) {
            $('.prf-box').removeClass('show');
        }
    });
});

let completeBtn = document.querySelector('.complete');
let btnText = document.querySelector('.complete span')

completeBtn.addEventListener('click', () => {
    completeBtn.classList.toggle('complete-green');


    if(completeBtn.classList.contains('complete-green')) {
        btnText.innerHTML = "Completed";
    }
    
    if(!completeBtn.classList.contains('complete-green')) {
        btnText.innerHTML = "Mark as Complete";
    }

});


$(document).ready(function(){
 
    // Initialize select2
    $("#selUser").select2();
  
    // Read selected option
    $('#but_read').click(function(){
      var username = $('#selUser option:selected').text();
      var userid = $('#selUser').val();
  
      $('#result').html("id : " + userid + ", name : " + username);
  
    });
  });


//   Multiple image upload

