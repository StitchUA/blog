
$(document).ready(
    function(){
        $.chat_position = 'hide';
        $.chat_hide_position = 0;
        $.chat_visible_position = "-380px";
        $("#chat-eject-button").click(function(){
            if($.chat_position == 'hide'){
                $("#chat-main-container").css({width : "403px"});
                $("#chat-hv").animate({right: $.chat_hide_position}, "slow");
                
                $.chat_position = 'visible';
            }
            else
            {
                $("#chat-hv").animate({right: $.chat_visible_position}, "slow", null, function(){$("#chat-main-container").css({width : "25px"});});
                $.chat_position = 'hide';
            }
        });
    ChatAjaxUpdate();
    setInterval(ChatAjaxUpdate, 5000);
});
function ChatAjaxParse(data, textStatus, jqXHR){
    if(textStatus == "success"){
        if(typeof(data) == 'string')
            data = $.parseJSON(data);
        if(data.res != 'undefined' && data.res == 1){
            ChatAjaxUpdate();
            return;
        }
        else{
            var cmd = new ChatMessagesBuilder(data);
            cmd.buildMessagesBlocks();
            var htmlBlocks = cmd.renderMessages();
            $(".chat-field-container").html(htmlBlocks);
        }
    }
}
function ChatAjaxUpdate(){
    $.ajax({
        dataType : "json",
        url : "?r=chatAjax/GetMessages",
        success: ChatAjaxParse
    });
}

