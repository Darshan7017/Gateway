const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 2500,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('', Swal.stopTimer)
    toast.addEventListener('', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'error',
  title:'Registration Failed'
})