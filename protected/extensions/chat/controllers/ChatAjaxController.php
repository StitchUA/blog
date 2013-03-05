<?php
    /**
     * Class-handler for ajax requests.
     */
    class ChatAjaxController extends Controller{
        /**
         * Get to a clients a messages.
         */
        public function actionGetMessages(){
            if(!Yii::app()->request->isAjaxRequest)
                throw new CHttpException(404);
            $chatModel = Chat::model();
            $criteria = new CDbCriteria();
            $criteria->order = "pk_chat_id DESC";
            $criteria->limit = "15";
            $msgs = $chatModel->findAll($criteria);
            $msgArr = array();
            foreach ($msgs as $index => $chObj) {
                $uname = $chObj->user_id == 0? "Guest": User::model()->findByPk($chObj->user_id)->username;
                $msgArr[$index] = array(
                    'name' => $uname,
                    'date' => date("m.d.Y", strtotime($chObj->date_create)),
                    'time' => date("h:i a", strtotime($chObj->date_create)),
                    // Restore normalize appearance of saved string.
                    'msg' => htmlspecialchars_decode(stripslashes($chObj->message))
                    );
            }
           echo json_encode($msgArr);
            Yii::app()->end();
        }
        /**
         * Create new a message and save into database.
         */
        public function actionAdd(){
            if(!Yii::app()->request->isAjaxRequest)
                throw new CHttpException(404);
            
            $chatModel = new Chat();
            $user = Yii::app()->user;
            
            $chatModel->date_create = date("Y-d-m h:i:s");
            
            if(!$user->isGuest){
                $chatModel->user_id = $user->getId();
            }
            else{
                $chatModel->user_id = 0;
            }
            // Create safe string for stor in database.
            $chatModel->message = htmlspecialchars(addslashes(trim($_POST['chat_msg'])));//Yii::app()->request->getParam("chat_msg");
            
            if($chatModel->save()){
                echo json_encode(array("res" => 1));
            }
            else {
                echo json_encode(array("res" => 0));
            }
            Yii::app()->end();
        }
    }
?>