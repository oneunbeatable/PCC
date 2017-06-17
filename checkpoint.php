<?php

function _alcohol_input($r)
    {
        $tr = trim($r);
        $tr = filter_var($tr, FILTER_SANITIZE_STRING);
        return $tr;
    }


function _verify($username,$password,$base){
			$username=_alcohol_input( $username );
			$password=_alcohol_input( $password );
			$likeun = '%' . $username . '%';
			$likepw = '%' . $password . '%';
			$uStat = 1;
			$db=$base;
			
	$db->begin_transaction();
	$rs = $db->query('SELECT * FROM users u LEFT JOIN user_type_list l ON l.uIDs=u.uID LEFT JOIN usertypes t ON t.typeID=l.uTypeIDs WHERE u.UserName LIKE ? AND u.PassWord LIKE ? AND u.uStatus=? LIMIT 1',$likeun,$likepw,$uStat);
			if($db->num_rows == 0){
			/****************************************************/
			/*******************check the cls table*************************/
			/****************************************************/
			/*
                $cls = $db->query('SELECT * FROM info_client_users u LEFT JOIN info_profiles p ON u.uID=p.pID WHERE u.UserName LIKE ? AND u.PassWord LIKE ? AND u.uStatus=? LIMIT 1',$likeun,$likepw,$uStat);
			if($db->num_rows > 0){
				foreach($cls AS $crd) {
  							$uTypeID=$crd['utID'];
								$uAno="Client";
									$iam=$crd['fName'].' '.$crd['sName'];
										$usergen=$crd['UserName']; 
											$hashedgen=$crd['PassWord'];
												$mukha=$crd['pImg'];	
													$uID=$crd['uID'];
					}
													session_regenerate_id();
														$_SESSION['logged'] = TRUE; 
															$_SESSION['userid'] = $uID;
																$_SESSION['UserName'] = $usergen;
																	$_SESSION['PassWord'] = $hashedgen;
																		$_SESSION['logtype'] = $uAno;
																			$_SESSION['human'] = $iam;													
																			$_SESSION['img'] = $mukha;													
															session_write_close();
														setcookie("UserName",$usergen);
													setcookie("PassWord",$hashedgen);
												setcookie('userid', $uID);
											setcookie('typeofuser', $uAno);
					return TRUE;								
							}else{ return FALSE;}
                            */
			/********************************************************
			***** when the entry is true *********************
			********************************************************/	
			}
			elseif($db->num_rows > 0){		
				foreach($rs AS $crd) {
  							$uTypeID=$crd['utID'];
								$uAno=$crd['typeDesc'];
									$iam=$crd['fName'].' '.$crd['sName'];
										$usergen=$crd['UserName']; 
											$hashedgen=$crd['PassWord'];
												$mukha=$crd['pImg'];	
													$uID=$crd['uID'];}
														session_regenerate_id();
														$_SESSION['logged'] = TRUE; 
															$_SESSION['userid'] = $uID;
																$_SESSION['UserName'] = $usergen;
																	$_SESSION['PassWord'] = $hashedgen;
																		$_SESSION['logtype'] = $uAno;
																			$_SESSION['human'] = $iam;													
																			$_SESSION['img'] = $mukha;
																		$_SESSION['fName'] = $crd['fName'];
																	$_SESSION['mName'] = $crd['mName'];
																$_SESSION['sName'] = $crd['sName'];
															session_write_close();
														setcookie("UserName",$usergen);
													setcookie("PassWord",$hashedgen);
												setcookie('userid', $uID);
											setcookie('typeofuser', $uAno);
										$db->end_transaction();
									return TRUE;								
							}else{ return FALSE;}
						}


function _wentAway() 
{	ob_start();
	session_start();
	$_SESSION['logged'] = FALSE;
	$_SESSION['UserName'] = '';
	$_SESSION['PassWord'] = '';
	$_SESSION = array();
	setcookie('UserName', '', false);
	setcookie('PassWord', '', false);
	setcookie('userid', '', false);
	setcookie('typeofuser', '', false);
	ob_flush();
	session_unset();
	session_destroy();
	header('Location: ../index.php');
	die();
}






?>