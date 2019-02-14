$(function(){
    
    //$("#id-popup-recommondations").modal("show");
    
    $("#comp-jehb26e6submit").on("click",function(event){
        event.preventDefault();
        var hash=this.hash;
        console.log(hash);
        $("body, html").animate({scrollTop: $(hash).offset().top} ,900, function(){window.location.hash=hash;});
    });
    $('#comp-jehb26e6form-wrapper').submit(function(e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#comp-jehb26e6form-wrapper').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                 
                if(json.isSuccess) 
                {
                    $('#comp-jehb26e6form-wrapper')[0].reset();
                    $("#id-popup-recommondations").modal("show");
                }

            }
        });
    });

    
});