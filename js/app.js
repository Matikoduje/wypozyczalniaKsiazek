$(document).ready(function () {
    $.ajax({
        url: 'api/books.php',
        method: 'GET',
        dataType: "json",
        success: function (data) {
            console.log('Strona jest połączona');
            console.log(data);
        },
        error: function () {
            console.log('Nie udało się');
        }
    });
    // $.ajax({
    //     url: 'api/books.php',
    //     method: 'GET',
    //     dataType: "json",
    //     data: {id: 1},
    //     success: function (data) {
    //         console.log('Strona jest połączona');
    //         console.log(data);
    //     },
    //     error: function () {
    //         console.log('Nie udało się');
    //     }
    // });
});