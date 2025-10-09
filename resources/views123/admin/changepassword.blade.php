

<div class="modal-header">
    <label class="modal-title text-text-bold-600" id="myModalLabel33">Change Password</label>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="changePasswordForm">

    @csrf
    <div class="modal-body">
    
        <label>New Password </label>
        <div class="form-group">
            <input type="password" name="new_password" class="form-control">
        </div>
        <label>Confirm Password </label>
        <div class="form-group">
            <input type="password" name="confirm_password" class="form-control">
        </div>
        <input type="hidden" name="id" value="{{$user->id}}">
    </div>
    <div id="errorMessage" class="alert alert-danger" style="display: none;">
    <!-- Display validation errors or incorrect old password message here -->
</div>
    <div class="modal-footer">
        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
        <input type="submit" class="btn btn-outline-primary btn-lg" value="Update">
    </div>
</form>




<script>
    $(document).ready(function() {
        $('#changePasswordForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.updatepassword") }}',
                data: $(this).serialize(),
                success: function(response) {
                    // Password changed successfully, hide the modal and show success message
                    $('#passwordmodel').modal('hide');
                    
                    $('#errorMessage').hide(); // Hide any previous error messages
                    iziToast.success({
                    title: 'Success!',
                    message: 'Password Updated Successfully',
                    position: 'topCenter'
                });
                },
                error: function(response) {
                    // Handle validation errors or incorrect old password, show error messages in the modal
                    $('#errorMessage').html('<ul>'); // Clear previous error messages
                    if (response.responseJSON.errors) {
                        // Display validation errors
                        $.each(response.responseJSON.errors, function(key, value) {
                            $('#errorMessage').append('<span>' + value + '</span>');
                        });
                    } else if (response.responseJSON.error) {
                        // Display specific error message
                        $('#errorMessage').append('<span>' + response.responseJSON.error +
                            '</span>');
                    }
                    $('#errorMessage').append('</ul>').show();
                }
            });
        });
    });
</script>