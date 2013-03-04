<?php
    class ChatWidget extends CWidget{
	/**
	 * @var string the URL of the CSS file used by this detail view. Defaults to null, meaning using the integrated
	 * CSS file. If this is set false, you are responsible to explicitly include the necessary CSS file in your page.
	 */
	public $cssFile;
        
        public function init() {
            $assetsDir = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.chat.assets'));
            $cs = Yii::app()->getClientScript();
            if($this->cssFile===null)
                $this->cssFile=$assetsDir.'/css/chat_style.css';
           $cs->registerCssFile(($this->cssFile));
           $js1 = $assetsDir.'/js/jquery-1.9.1.js';
           $js2 = $assetsDir.'/js/jquery-ui.js';
           $js3 = $assetsDir.'/js/chat_script.js';
           $js4 = $assetsDir.'/js/chatCls.js';
           $cs->registerScriptFile($js1, CClientScript::POS_END);
           $cs->registerScriptFile($js2, CClientScript::POS_END);
           $cs->registerScriptFile($js4, CClientScript::POS_END);
           $cs->registerScriptFile($js3, CClientScript::POS_END);
            
           // parent::init();
        }
        public function run() {
            $o = $this->owner;
            $this->render("body", array("owner" => $o));
            //parent::run();
        }
    }
?>