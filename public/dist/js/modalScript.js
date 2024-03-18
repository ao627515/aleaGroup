$(function() {
    $('.action-btn').on('click', function() {
        var form = $(this).closest('.form-action');

        $('#confirmUpdate').on('click', function() {
            // Soumettre le formulaire
            form.submit();
        });

        $('.confirmDelete').on('click', function() {
            // Soumettre le formulaire
            form.submit();
        });
    });
});
