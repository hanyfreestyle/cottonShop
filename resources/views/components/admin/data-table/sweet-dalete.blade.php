<script>
    function sweet_dalete($id){
        var formid = $id ;
        Swal.fire({
            title: '{!! __('admin/alertMass.sweet_title') !!}',
            text: "{!! __('admin/alertMass.sweet_text') !!}",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{!! __('admin/alertMass.sweet_confirm_button_text') !!}',
            cancelButtonText: '{!! __('admin/alertMass.sweet_cancel_button_text') !!}'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = formid ;
            }
        });
    }
</script>
