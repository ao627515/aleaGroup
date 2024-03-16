$(function() {
    $('.action-btn').on('click', function() {
        var form = $(this).closest('.form-action');

        $('#confirmUpdate').on('click', function() {
            // Soumettre le formulaire
            form.submit();
        });

        $('#confirmRelaunch').on('click', function() {
            // Soumettre le formulaire
            form.submit();
        });

        $('#confirmDestroy').on('click', function() {
            // Soumettre le formulaire
            form.submit();
        });

        $('#confirmApprouvation').on('click', function() {
            // Soumettre le formulaire
            form.submit();
        });

        $('#confirmDraft').on('click', function() {
            $('input[name="status"]').val(5)

            $('form').submit();
        });

        $('#confirmPublish').on('click', function() {
            $('input[name="status"]').val(1)
            $('form').submit();
        });

        $('#modal-declined').on('show.bs.modal', function(event) {

            $('#confirmRefus').on('click', function() {
                let motif = $('#motifModal').val();

                $('#motifHidden').val(motif);

                $('#declinedForm').submit();
            });
        });
    });
});
