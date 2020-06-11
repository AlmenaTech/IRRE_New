
$(document).ready(function(){
    $('#work_doc').change(function(evt){
        var files = evt.target.files; // FileList object

        // use the 1st file from the list
        f = files[0];
        if(f)
        {
            $('.file-no-text').html("(1 file has been choosen)");
        }
        else
        {
            $('.file-no-text').html("(No file has been choosen)");
        }
    });
});
