<?php
    class ChatAjaxController extends Controller{
        
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
                $uname = $chObj->user_name;// == 0? "Гость":$chObj->user_name;
                $msgArr[$index] = array(
                    'name' => $uname,
                    'date' => date("m.d.Y", strtotime($chObj->date_create)),
                    'time' => date("h:i a", strtotime($chObj->date_create)),
                    'msg' => htmlspecialchars_decode(stripslashes($chObj->message))
                    );
            }
           echo json_encode($msgArr);
            Yii::app()->end();
        }
        public function actionAdd(){
            if(!Yii::app()->request->isAjaxRequest)
                throw new CHttpException(404);
            
            $chatModel = new Chat();
            $user = Yii::app()->user;
            
            //$dt = new DateTime();
            $chatModel->date_create = date("Y-d-m h:i:s");//$dt->format("d-m-Y h:i:s");
            
            if(!$user->isGuest){
                $chatModel->user_name = $user->getName();
            }
            else{
                $chatModel->user_name = "Guest";
            }
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