<script>
jQuery(document).ready(function($) {
    $('#join-match-button').on('click', function() {
        var matchID = $(this).data('match-id');

        $.ajax({
            url: valorantarenaAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'join_match',
                match_id: matchID
            },
            success: function(response) {
                $('#join-message').html(response.message);
                if (response.success) {
                    $('#join-match-button').hide();
                }
            },
            error: function() {
                $('#join-message').html('Erreur lors de la tentative de rejoindre le match.');
            }
        });
    });
});

</script>
