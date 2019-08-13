<script>
	$(document).on("submit", "form.send-data", function (e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            success: function (response) {
                data = JSON.parse(response);
                console.log(data);
                if(data['result'] == 1) $(".message").addClass('success_message').html(data['message']);
                else $(".message").addClass('false_message').html(data['message']);
                
                setTimeout(
                  function() 
                  {
                    $(".message").removeClass('success_message').html('');
                    $(".message").removeClass('false_message').html('');
                  }, 10000);
                
            },
            error: function () {
                $(".message").addClass('false_message').html(data['message']);
                setTimeout(
                  function() 
                  {
                    $(".message").removeClass('false_message').html('');
                  }, 10000);   
            }
        });
        return false;
    });
</script>