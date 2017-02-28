$(document).ready(function () {

    function validateForms(title, author, description) {

        if (title.length > 80) {
            error.text('Zbyt długi tytuł');
            $('#error').append(error);
            return false;
        }

        if (author.length > 30) {
            error.text('Zbyt długie nazwisko autora');
            $('#error').append(error);
            return false;
        }

        if (description.length > 255) {
            error.text('Zbyt długi opis książki');
            $('#error').append(error);
            return false;
        }

        if (author == '' || title == '' || description == '') {
            error.text('Proszę uzupełnić wszystkie pola');
            $('#error').append(error);
            return false;
        }

        return true;
    };

    function getAllBooks() {
        $.ajax({
            url: 'api/books.php',
            method: 'GET',
            cache: false,
            dataType: "json",
            success: function createList(data) {
                var panel;
                panel = $('<div class="panel panel-primary">');
                var panelHeading;
                var panelHeadingTitle;
                var panelHeadingDelete;
                var panelBody;
                for (var i = 0; i < data.length; i++) {
                    panelHeading = $('<div>');
                    panelHeading.addClass('panel-heading infoAboutBook');
                    panelHeadingTitle = $('<h3>');
                    panelHeadingTitle.addClass('panel-title');
                    panelHeadingTitle.text(data[i].title);
                    panelHeadingDelete = $('<button>');
                    panelHeadingDelete.addClass('deleteBook btn btn-danger btn-xs pull-right');
                    panelHeadingDelete.text('Usuń');
                    panelHeading.attr('data-id', data[i].id);
                    panelHeadingTitle.append(panelHeadingDelete);
                    panelHeading.append(panelHeadingTitle);
                    panel.append(panelHeading);
                    panelBody = $('<div id="information">');
                    panelBody.addClass('hideMyElements panel-body');
                    var author = $('<p id="authorP">');
                    var description = $('<p id="descriptionP">');
                    var showForm = $('<span class="label label-info showForm">Edytuj</span>');
                    var emptyParagraph = $('<p>');
                    var formToUpdate = $('<form action="#" id="updateForm" data-id=' + data[i].id + '>');
                    var inputTitle = $('<input type="text" class="form-control input-sm" id="titleForm">');
                    var inputAuthor = $('<input type="text" class="form-control input-sm" id="authorForm">');
                    var inputDescription = $('<input type="text" class="form-control input-sm" id="descriptionForm">');
                    var buttonUpdate = $('<button type="button" id="updateBook" class="btn btn-success btn-xs pull-right">');
                    buttonUpdate.text('Zmień');
                    inputTitle.val(data[i].title);
                    formToUpdate.addClass('form-inline hideMyElements');
                    formToUpdate.append('<label for="title">Tytuł:&nbsp;</label>');
                    formToUpdate.append(inputTitle);
                    formToUpdate.append('<label for="author">&nbsp;Autor:&nbsp;</label>');
                    formToUpdate.append(inputAuthor);
                    formToUpdate.append('<label for="description">&nbsp;Opis:&nbsp;</label>');
                    formToUpdate.append(inputDescription);
                    formToUpdate.append(buttonUpdate);
                    panelBody.append(author);
                    panelBody.append(description);
                    panelBody.append(showForm);
                    panelBody.append(emptyParagraph);
                    panelBody.append(formToUpdate);
                    panel.append(panelBody);
                }
                $('#listBooks').append(panel);
            },
            error: function (data) {
                error.text('Brak połączenia z serwerem');
                console.log(data);
                $('#error').append(error);
            }
        });
    }

    var error = $('<p class="text-danger">');

    getAllBooks();

    $('body').on('click', '.infoAboutBook', function () { // dodanie eventu do nowo utworzonego elementu
        if ($(event.target).hasClass('deleteBook')) {
            return false;
        }
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
                    infoAboutBook.find('#authorForm').val(data[0].author);
                    infoAboutBook.find('#descriptionForm').val(data[0].description);
                    infoAboutBook.find('#authorP').text('Autor: ' + data[0].author);
                    infoAboutBook.find('#descriptionP').text('Opis: ' + data[0].description);
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
            var form = $('form');
            form.submit(function (event) {
                var title = $('#title').prop('value');
                var author = $('#author').prop('value');
                var description = $('#description').prop('value');

                if (validateForms(title, author, description) == false) {
                    event.preventDefault();
                }

                $.ajax({
                    url: 'api/books.php',
                    method: 'POST',
                    dataType: "json",
                    data: {title: title, author: author, description: description},
                    success: function (data) {
                        getAllBooks();
                    },
                    error: function (data) {
                        error.text(data);
                        $('#error').append(error);
                    }
                });
            });
        }
    });

    $('body').on('click', '.deleteBook', function () {
        var idElementToDelete = $(event.target).parent().parent();
        $.ajax({
            url: 'api/books.php',
            method: 'DELETE',
            dataType: "json",
            data: {delete: idElementToDelete.attr('data-id')},
            success: function (data) {
                if (data) {
                    setTimeout(function () {   // ta część kodu odpowiada za przeładowanie strony
                        location.reload();
                    }, 50);
                }
            },
            error: function (data) {
                error.text('Nie znaleziono książki o podanym ID');
                $('#error').append(data);
            }
        });
    });

    $('body').on('click', '#updateBook', function () {
        var formUpdate = $(event.target).parent();
        var title = formUpdate.find('#titleForm').prop('value');
        var author = formUpdate.find('#authorForm').prop('value');
        var description = formUpdate.find('#descriptionForm').prop('value');
        var id = formUpdate.attr('data-id');

        if (validateForms(title, author, description) == false) {
            event.preventDefault();
        }

        $.ajax({
            url: 'api/books.php',
            method: 'PUT',
            dataType: "json",
            data: {title: title, author: author, description: description, id: id},
            success: function (data) {
                setTimeout(function () {   // ta część kodu odpowiada za przeładowanie strony
                    location.reload();
                }, 50);
            },
            error: function (data) {
                error.text(data);
                $('#error').append(error);
            }
        });
    });

    $('body').on('click', '.showForm', function () {
        var showUpdateForm = $(event.target).nextAll('#updateForm');
        if (showUpdateForm.hasClass('hideMyElements')) {
            showUpdateForm.toggleClass('hideMyElements');
        } else {
            showUpdateForm.toggleClass('hideMyElements');
        }
    });
});