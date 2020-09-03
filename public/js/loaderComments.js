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
                                '<a href="#" class="btn-link text-semibold media-heading box-inline">' + data[index].username + '</a>' +
                                '<p class="text-muted text-sm">' + data[index].created_comment + '</p>' +
                                '</div>' +
                                '<p>' + data[index].title + '</p>' +
                                '<p>' + data[index].comment_text + '</p>' + 
                                
                                '<div class="container">' +
                                    '<div class="row">' +
                                    '<form action=\'/todo\' method="GET">' +
                                    '<div class="pad-ver">' +
                                    '<a class="btn btn-secondary" href="#">Ответить</a>' +
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
