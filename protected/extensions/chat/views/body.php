<div id="chat-main-container">
    <div id="chat-hv">
        <div id="chat-eject-button"></div>
        <div class="chat-container">
            <div class="chat-field-container">
                
            </div>
            <div class="chat-new-message-container">
                <form>
                    <div class="chat-textarea">
                        <?php 
                        echo CHtml::activeTextArea(Chat::model(), "message", array(
                                'id' => 'chat-message',
                                'name' => 'chat_msg'
                            ));
                        ?>
                    </div>
                    <?php echo CHtml::ajaxSubmitButton("Отправить", 
                            $owner->createUrl('chatAjax/add'),
                            array('success' => "ChatAjaxParse", 
                                )
                            ); 
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>