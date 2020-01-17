(function(){
  $(document).on('click', 'a.delete', function(e){
    e.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#4fd69c',
      cancelButtonColor: '#f5365c',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        document.location = $(this).attr('href');
      }
    })
  })
})();