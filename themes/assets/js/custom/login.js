$(document).ready(function(){
    $('.login_btn').click(function(){
        var password = $('.password').val();
        var sha256_pass = sha256(password);
        $('.password').val(sha256_pass);
    });
});