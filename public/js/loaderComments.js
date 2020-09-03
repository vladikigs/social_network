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
                                    '<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-id-comment="'+ data[index].id +'" data-text-author="'+ data[index].comment_text +'" data-authorUsername="' + data[index].username + '"' +
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


$('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('author-authorUsername');
    var textAuthor = button.data('text-author');
    var idComment = button.data('id-comment');
    $('.form-request-to-comment')[0].action += 'requestToComment/' + idComment
    var modal = $(this)
    modal.find('.modal-title').text('Ответить на сообщение пользователя: ')
    modal.find('.text-author-comment').text(textAuthor)
  })