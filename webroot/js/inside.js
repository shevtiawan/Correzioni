$(document).ready(function() {

    $('a').click(function() {

        var toLoad = $(this).attr('href');

        $('#mainContent').slideUp('normal', loadContent);

        $('#load').remove();

        $('#wrapper').append('<span id="load">loading...</span>');

        $('#load').fadeIn('normal');
        
        function loadContent() {

            $('#mainContent').load(toLoad, '', showNewContent())

        }
            
        function showNewContent() {

            $('#mainContent').delay(500).slideDown('normal', hideLoader());
            
        }

        function hideLoader() {
            
            $('#load').fadeOut('normal');

        }

        return false;

    });
    
});