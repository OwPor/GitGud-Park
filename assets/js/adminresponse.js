$('.approve-btn').click(function() {
    var businessId = $(this).data('id');
    $.ajax({
        url: 'adminresponse.php', // Update with the correct path
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ business_id: businessId, action: 'approve' }),
        success: function(response) {
            console.log(response); // Log the response for debugging
            if (response.success) {
                alert(response.message);
                location.reload(); // Reload the page or update the UI accordingly
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function() {
            alert('Error processing request.');
        }
    });
});

$('.deny-btn').click(function() {
    var businessId = $(this).data('id');
    $.ajax({
        url: 'adminresponse.php', // Update with the correct path
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ business_id: businessId, action: 'deny' }),
        success: function(response) {
            console.log(response); // Log the response for debugging
            if (response.success) {
                alert(response.message);
                location.reload(); // Reload the page or update the UI accordingly
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function() {
            alert('Error processing request.');
        }
    });
});