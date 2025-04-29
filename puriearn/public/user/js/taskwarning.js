$(document).ready(function() {
    // Open the modal when the submit button is clicked
    $('#submit-btn').click(function(e) {
        e.preventDefault();
        $('#popup-modal').show();
    });

    // Close the modal when the close button or outside the modal is clicked
    $('.close, .modal, #cancel-btn').click(function() {
        $('#popup-modal').hide();
    });

    // Prevent the modal from closing when clicking inside the modal content
    $('.modal-content').click(function(e) {
        e.stopPropagation();
    });

    // Submit the form when the confirmation button is clicked
    $('#confirm-btn').click(function() {
        $('#popup-modal').hide();
        $('form').submit();
    });
});
