$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

  
                  Swal.fire({
                    title: 'Jeste li sigurni?',
                    text: "Želite izbrisati ovu stavku?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Da, izbriši!',
                    cancelButtonText: 'Odustani!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Izbrisano!',
                        'Ova stavka je izbrisana.',
                        'success'
                      )
                    }
                  }) 


    });

});

$(function(){
  $(document).on('click','#approve',function(e){
      e.preventDefault();
      var link = $(this).attr("href");


                Swal.fire({
                  title: 'Jeste li sigurni?',
                  text: "Želite odobriti ovu rezervaciju?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Da, odobri!',
                  cancelButtonText: 'Odustani!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = link
                    Swal.fire(
                      'Odobreno!',
                      'Ovaj zahtjev je odobren.',
                      'success'
                    )
                  }
                }) 


  });

});

$(function(){
  $(document).on('click','#cancel',function(e){
      e.preventDefault();
      var link = $(this).attr("href");

      Swal.fire({
        title: 'Jeste li sigurni?',
        text: "Želite otkazati ovu rezervaciju?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e1a974',
        cancelButtonColor: 'gray',
        confirmButtonText: 'Da, otkaži!',
        cancelButtonText: 'Odustani!',
        cancelButtonColorText: '#e1a974',
        background: '#fff', 
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link
          Swal.fire(
            'Otkazano!',
            'Rezervacija je otkazana.',
            'success'
          )
        }
      }) 
  });
});



