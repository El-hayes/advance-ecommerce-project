// <!-- sweet alert -->

$(function(){
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });
    })
})

// <!-- End sweet alert -->

// Confirm pending orders
$(function(){
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure?",
            text: "Once Confirm, You will not be able to pending again!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Confirm it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire({
                    title: "Confirmed!",
                    text: "Confirm Changes.",
                    icon: "success"
                });
            }
        });
    })
})
// End Confirm pending orders


// processing


$(function(){
    $(document).on('click','#processing',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to Processing?',
            text: "Once Processing, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Processing!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Processing!',
                    'Processing Changes',
                    'success'
                )
            }
        })


    });

});
// End Processing


//picked


$(function(){
    $(document).on('click','#picked',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to Picked?',
            text: "Once Picked, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Picked!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Picked!',
                    'Picked Changes',
                    'success'
                )
            }
        })


    });

});

// shipped


$(function(){
    $(document).on('click','#shipped',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to shipped?',
            text: "Once shipped, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, shipped!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'shipped!',
                    'shipped Changes',
                    'success'
                )
            }
        })


    });

});

//delivered



$(function(){
    $(document).on('click','#delivered',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to delivered?',
            text: "Once delivered, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delivered!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'delivered!',
                    'delivered Changes',
                    'success'
                )
            }
        })


    });

});

//Cancel order



$(function(){
    $(document).on('click','#cancel',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to cancel order?',
            text: "Once Cancel, You will not be able to Edit order again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Canceled!',
                    'Canceled Changes',
                    'success'
                )
            }
        })


    });

});

