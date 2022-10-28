$(function(){
    $('#search_box').on('keypress',function(e) {
        if(e.which == 13) {
            window.location = 'app-search?search_key=' + $('#search_box').val()
        }
    });

    $('#txtSearchbox2').on('keypress',function(e) {
        if(e.which == 13) {
            window.location = 'app-search?search_key=' + $('#txtSearchbox2').val()
        }
    });

    
})