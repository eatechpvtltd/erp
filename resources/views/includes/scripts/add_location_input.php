
<script src="{{ asset('assets/js/jquery-3.3.1.min.js')  }}"></script>

<script>
    $(document).ready(function() {
        $('input[name="transport"]').on('change', function() {
            if ($('#transport_yes').is(':checked')) {
                $('#locationInput').show();
            } else {
                $('#locationInput').hide();
            }
        });
    });
</script>