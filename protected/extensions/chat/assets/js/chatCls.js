function ChatMessage(uname, mdate, mtime, m){
    var name = uname;
    var date = mdate;
    var time = mtime;
    var message = m;
    this.renderMessageBlock = function (){
        var outputBlock = "<div class='chat-msg-container'>";
        
        outputBlock += "<div class='chat-msg-info'>";
        outputBlock += "<div class='chat-uname'>" + name + "</div>";
        outputBlock += "<div class='chat-date'>" + date + "</div>";
        outputBlock += "<div class='chat-time'>" + time + "</div>";
        outputBlock += "</div>";
        
        outputBlock += "<div class='chat-msg-body'>";
        outputBlock += "<div class='chat-msg'>" + message + "</div>";
        outputBlock += "</div>";
        
        outputBlock += "</div>";
        return outputBlock;
    };
}
function ChatMessagesBuilder(data){
    var msgData = data;
    var messages = [];
    this.buildMessagesBlocks = function(){
        for(var msgKey in msgData){
            if(!msgData.hasOwnProperty(msgKey)) continue;
            messages.push(new ChatMessage(msgData[msgKey].name, msgData[msgKey].date, msgData[msgKey].time, msgData[msgKey].msg));
        }
    };
    this.renderMessages = function(){
        var output = "<div id='chat-msgs-container'>";
        for(var i = 0; i < messages.length; i++){
            output += messages[i].renderMessageBlock();
        }
        output += "</div>";
        return output;
    }
}

