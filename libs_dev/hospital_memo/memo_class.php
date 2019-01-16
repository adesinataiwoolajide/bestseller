<?php
	class hospitallMemo{

		public $db;
		function __construct($db){
			$this->db=$db;
		}

		public function addNewMemo($sender, $reciever, $content, $category, $subject)
		{
			try{
				$addMemo = $this->db->prepare("INSERT INTO hospital_memo (memo_content, memo_reciever, memo_sender, memo_category, subject) VALUES (:content, :reciever, :sender, :category, :subject)");
				$arrAddmemo = array(':content'=>$content, ':reciever'=>$reciever, ':sender'=>$sender, 
					':category'=>$category, ':subject'=>$subject);
				if(!empty($addMemo->execute($arrAddmemo))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function addNewMemoWithAttachment($sender, $reciever, $content, $category, $subject, $attachment)
		{
			try{
				$addMemo = $this->db->prepare("INSERT INTO hospital_memo (memo_content, memo_reciever, memo_sender, memo_category, subject, attachment) VALUES (:content, :reciever, :sender, :category, :subject, :attachment)");
				$arrAddmemo = array(':content'=>$content, ':reciever'=>$reciever, ':sender'=>$sender, 
					':category'=>$category, ':subject'=>$subject, ':attachment'=>$attachment);
				if(!empty($addMemo->execute($arrAddmemo))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function checkExiatenceMemo($sender, $content, $subject)
		{
			try{
				$check = $this->db->prepare("SELECT * FROM hospital_memo  WHERE memo_content=:content AND memo_sender=:sender AND subject=:subject");
				$arrCheck = array(':content'=>$content, ':sender'=>$sender, ':subject'=>$subject);
				$check->execute($arrCheck);
				if($check->rowCount()>0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function gettingMemiID($memo_id)
		{
			try{
				$getMemo = $this->db->prepare("SELECT * FROM hospital_memo  WHERE memo_id=:memo_id");
				$arrGet = array(':memo_id'=>$memo_id);
				$getMemo->execute($arrGet);
				$roll =$getMemo->fetch();
				return $roll;
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function updateMemo($reciever, $content, $memo_id, $subject)
		{
			try{
				$updatingMemo = $this->db->prepare("UPDATE hospital_memo  SET memo_reciever=:reciever, memo_content=:content, subject=:subject WHERE memo_id=:memo_id");
				$arrUpdate = array(':reciever'=>$reciever, ':content'=>$content, ':subject'=>$subject, ':memo_id'=>$memo_id);
				if($updatingMemo->execute($arrUpdate)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function deleteMemo($memo_id)
		{
			try{
				$delMemo = $this->db->prepare("DELETE FROM hospital_memo  WHERE memo_id=:memo_id");
				$arrDel = array(':memo_id'=>$memo_id);
				if(!empty($delMemo->execute($arrDel))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}
	}
?>