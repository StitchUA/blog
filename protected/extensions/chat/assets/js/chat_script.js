$(document).ready(
    /**
     * Bounding handler on button which show/hide widget.
     */
    function(){
        $.chat_state = 'hide';
        $.chat_hide_position = 0;
        $.chat_visible_position = "-380px";
        $("#chat-eject-button").click(function(){
            if($.chat_state == 'hide'){
                $("#chat-main-container").css({width : "403px"});
                $("#chat-hv").animate({right: $.chat_hide_position}, "slow");

                $.chat_state = 'visible';
            }
            else
            {
                $("#chat-hv").animate({right: $.chat_visible_position}, 
                                        "slow",
                                        null, 
                                        function(){
                                            $("#chat-main-container").css({width : "25px"});
                                        }
                                    );
                $.chat_state = 'hide';
            }
        });
    ChatAjaxUpdate();
    setInterval(ChatAjaxUpdate, 5000);
});
/**
 * Parse ajax answer from server, render html-markup for widget.
 * This method use on success unswer from server.
 * @see jQuery.ajax() for more detail.
 */
function ChatAjaxParse(data, textStatus, jqXHR){
    if(textStatus == "success"){
        if(typeof(data) == 'string')
            data = $.parseJSON(data);
        if(data.res != 'undefined' && data.res == 1 || data.res == 0){
            ChatAjaxUpdate();
            $("#chat-message").val("");
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
/*
 * Call every time when need update messages in widget
 */
function ChatAjaxUpdate(){
    var url = "index.php/chatAjax/GetMessages";
    $.ajax({
        type: "POST",
        dataType : "json",
        url : url,
        success: ChatAjaxParse
    });
}

