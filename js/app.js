$(document).ready(function () {

    var error = $('<p>');

    $.ajax({
        url: 'api/books.php',
        method: 'GET',
        dataType: "json",
        success: function createList(data) {
            var panel;
            panel = $('<div class="panel panel-primary">');
            var panelHeading;
            var panelHeadingTitle;
            var panelBody;
            for (var i = 0; i < data.length; i++) {
                panelHeading = $('<div>');
                panelHeading.addClass('panel-heading infoAboutBook');
                panelHeadingTitle = $('<h3>');
                panelHeadingTitle.addClass('panel-title');
                panelHeadingTitle.text(data[i].title);
                panelHeading.attr('data-id', data[i].id);
                panelHeading.append(panelHeadingTitle);
                panel.append(panelHeading);
                panelBody = $('<div>');
                panelBody.addClass('hideMyElements panel-body');
                var author = $('<p id="author">');
                var description = $('<p id="description">');
                panelBody.append(author);
                panelBody.append(description);
                panel.append(panelBody);
            }
            $('#listBooks').append(panel);
        },
        error: function () {
            error.text('Brak połączenia z serwerem');
            $('#error').append(error);
        }
    });
    $('body').on('click', '.infoAboutBook', function (event) { // dodanie eventu do nowo utworzonego elementu
        var infoAboutBook = $(this).next();
        var isClick = false; // zmienna pomocnicza, która tylko w momencie rozwinięcia info pozwoli połączyć z bazą
        if (infoAboutBook.hasClass('hideMyElements')) {
            infoAboutBook.toggleClass('hideMyElements');
            isClick = true;
        } else {
            infoAboutBook.toggleClass('hideMyElements');
        }
        if (isClick) {
            $.ajax({
                url: 'api/books.php',
                method: 'GET',
                dataType: "json",
                data: {field: 'id', fieldValue: $(this).attr('data-id')},
                success: function (data) {
                    console.log('Strona jest połączona');
                    infoAboutBook.find('#author').text('Autor: ' + data[0].author);
                    infoAboutBook.find('#description').text('Opis: ' + data[0].description);
                },
                error: function () {
                    error.text('Nie znaleziono książki o podanym ID');
                    $('#error').append(error);
                }
            });
        }
    });

    $('#clickForm').click(function () {
        var formhidden = $('#hideForm');
        var isClickOnForm = false;
        if (formhidden.hasClass('hideMyElements')) {
            formhidden.toggleClass('hideMyElements');
            isClickOnForm = true;
        } else {
            formhidden.toggleClass('hideMyElements');
        }
        if (isClickOnForm) {

        }
    });
    // $.ajax({
    //     url: 'api/books.php',
    //     method: 'POST',
    //     dataType: "json",
    //     success: function (data) {
    //         console.log('Strona jest połączona');
    //         console.log(data);
    //     },
    //     error: function () {
    //         console.log('Nie udało się');
    //     }
    // });
});