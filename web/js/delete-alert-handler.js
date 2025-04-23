$('div.grid-view a.text-danger, a.delete-dialog').click(function(event) {
    event.preventDefault();
    
    let url = $(this).attr('href');

    Swal.fire({
        title: 'Hapus Data',
        text: 'Apakah anda yakin ingin menghapus data?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: 'Ya, Hapus Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                type : 'POST',
                success : function(data){
                    let title = 'Sukses!';
                    let message = 'Data Berhasil Dihapus.';
                    let icon = 'success';

                    if (data.code != 200) {
                        title = 'Gagal!';
                        message = 'Data Gagal Dihapus.';
                        icon = 'error';
                    }

                    Swal.fire(
                        title,
                        message,
                        icon
                    ).then((result) => {
                        location.reload();
                    });
                }
            });
        }
    })
});