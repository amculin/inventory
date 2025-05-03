$('div.grid-view a.text-danger, a.delete-dialog').click(function(event) {
    event.preventDefault();
    
    let url = $(this).attr('href');

    Swal.fire({
        title: 'Delete Data',
        text: 'Are you sure you want to delete this data?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: 'Yes, Delete Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                type : 'POST',
                success : function(data) {
                    location.reload();
                }
            });
        }
    })
});