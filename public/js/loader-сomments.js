showComments();
$("#loaderContent").click(function (){
    showComments();
})

function showComments()
{
    $.get(
        '/loadMoreComments/' + $(".media-body").length + '/' + idUserPage, 
        function(data) {   
            for (let index = 0; index < data.length; index++) {
                var html = "";
                html += '<div  class="media-body">' +
                                '<div class="mar-btm">' +
                                '<a href="#" class="btn-link text-semibold media-heading box-inline">' + data[index].user.name + '</a>' +
                                '<p class="text-muted text-sm">' + data[index].created_comment + '</p>' +
                                '</div>'; 
                                if (data[index].comment_id != null) {
                                    if (data[index].comment_id != "\"Комментарий удалён\"") 
                                    {
                                        html += '<mark>В ответ на комментарий пользователя ' + data[index].parentUsername + '</mark><br>' +
                                            '<mark>Текст комментария:   ' + data[index].parentUserCommentText + '</mark><br><br>';
                                    }
                                    else
                                    {
                                        html += '<mark>Текст комментария:   \"Комментарий удалён\"</mark><br><br>';
                                    }
                                    
                                }

                        html += '<p>Заголовок: ' + data[index].title + '<br>' +
                                'Комментарий: ' + data[index].comment_text + '</p>' + 
                                
                                '<div class="container">' +
                                    '<div class="row">' +
                                    '<form action="/" method="GET">' +
                                    '<div class="pad-ver">' +
                                    '<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-id-comment="'+ data[index].id +'" data-text-author="'+ data[index].comment_text +'" data-author-username="' + data[index].user.name + '"' +
                                    'class="btn btn-secondary" href="#">Ответить</a>' +
                                    '</div>' +
                                    '</form>';
                                    if (data[index].buttonDelete) 
                                    {
                                        html += "<form action='/deleteComment/"+ data[index].id +"/"+ data[index].user_id_wall +"' method='GET'>" + 
                                                    '<div class="col text-right">' +
                                                    '<button class="btn btn-danger">Удалить</button>' +
                                                    '</div>' +
                                                '</form>';   
                                    }
                                  
                                 html +='</div></div><hr>';
                addComments(html);
            }    
            
        }
      );
    

}

function addComments(content)
{
    $("#comments").append(content);
}

function checkValidAndSumbmitCommentResponce() {
    var formGroup = $('.form-control');
    var title = formGroup.prevObject.find('#recipient-name');
    var text = formGroup.prevObject.find('#message-text');
    
    if (validationParams(title, text))
    {
        $('.form-request-to-comment')[0].submit();
    }
}

function validationParams(title, text) {
    var formValid = true;   
    
    if(title[0].value.length < 30)
    {
        title.addClass('is-valid').removeClass('is-invalid');
    }
    else if (title[0].value.length > 30) {
        title.addClass('is-invalid').removeClass('is-valid');
        formValid = false;
    }

    if(text[0].value.length < 255)
    {
        text.addClass('is-valid').removeClass('is-invalid');
    }
    else if (text[0].value.length > 255) {
        text.addClass('is-invalid').removeClass('is-valid');
        formValid = false;
    }
    return formValid;
}

function checkValidAndSumbmitComment()
{
    var formGroup = $('.form-control');
    var title = formGroup.prevObject.find('#title-comment');
    var text = formGroup.prevObject.find('#text-comment');

    if (validationParams(title, text))
    {
        $('.form-create-comment')[0].submit();
        return true;
    }
}


$('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('author-username');
    
    var textAuthor = button.data('text-author');
    var idComment = button.data('id-comment');
    $('.form-request-to-comment')[0].action = document.location.origin + '/requestToComment/' + idComment
    var modal = $(this)
    modal.find('.modal-title').text('Ответить на сообщение пользователя: ' + recipient)
    modal.find('.text-author-comment').text(textAuthor)
  })

