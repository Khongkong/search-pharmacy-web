$(() => {
    updateMasks()
    setInterval(() => {
        // updateMasks()
    }, 15 * 60  * 1000)
})

function updateMasks() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: `/api/pharmacies/updateMasks`,
        dataType: 'json',
        success: (e) => {
            // console.log('updated')
        },
        error: (e) => {
            // console.log("ERROR: ", e);
        },
    });
}