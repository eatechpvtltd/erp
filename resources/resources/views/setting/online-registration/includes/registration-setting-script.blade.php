<script>
    $(document).ready(function () {
        $('#add-program-html').click(function () {
            $.ajax({
                type: 'POST',
                url: '{{ route('setting.online-registration.program-html') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    var data = $.parseJSON(response);

                    if (data.error) {
                        //toastr.warning(data.message, "warning");
                    } else {

                        $('#program_wrapper').append(data.html);
                        //toastr.success(data.message, "success");
                        $('#add-program-html').hide();
                    }
                }
            });

        });

        $('.delete-program').click(function () {
            id =$(this).data('id');
            $(this).closest('tr').remove();
            $.ajax({
                type: 'GET',
                url: '{{ route('setting.online-registration.remove-program') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (response) {
                    var data = $.parseJSON(response);

                    if (data.error) {
                        toastr.warning(data.message, "warning");
                    } else {
                        toastr.success(data.message, "success");
                    }
                }
            });

        });



    });

    function loadSemesters($this) {
        $.ajax({
            type: 'POST',
            url: '{{ route('setting.online-registration.find-semester') }}',
            data: {
                _token: '{{ csrf_token() }}',
                faculty_id: $this.value
            },
            success: function (response) {
                var data = $.parseJSON(response);
                if (data.error) {
                    $.notify(data.message, "warning");
                } else {
                    //$(this).closest('tr').remove();
                    //$('.semester_select').empty();
                    $(this).closest('.semester_select').empty();
                    $('.semester_select').html('').append('<option value="0">Select Sem./Sec.</option>');
                    $.each(data.semester, function(key,valueObj){
                        $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'-'+valueObj.slug+'</option>');
                    });
                }
            }
        });


    }
</script>