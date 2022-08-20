let timerInterval
        Swal.fire({
        icon: 'error',
        html: 'Please provide required fields',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
            const content = Swal.getContent()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
        }).then((result) => {

        })
