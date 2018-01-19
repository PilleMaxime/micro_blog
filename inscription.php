<?php

	// Includes
	include('includes/connexion.inc.php');
	require('lib/smarty/libs/Smarty.class.php');
	$smarty=new Smarty();
	
	
	// Lors de l'envoie on regarde si tout est Ok, si oui on l'insert dans la base
	$test = false ;
	if(isset($_POST['email'])){
	$sql='SELECT pseudo, email FROM utilisateur';
	$stmt=$pdo->query($sql);
	$test=true;
		while($data=$stmt->fetch())
		{
			if($data['email']==$_POST['email'])
			{
			$test=false;
			alert("L'email est déjà enregistré");
			}
			
			if($_POST['email']=="" || $_POST['mdp']=="")
			{
			$test=false;
			alert("Un des champs est vide");
			}
		}
	}
if($test==true)
	{
		$sql2 = "INSERT INTO utilisateurs (email, mdp) VALUES ('{$_POST['email']}', :mdp)";
		$prep = $pdo->prepare($sql2);
		$prep->bindValue(':mdp', md5($_POST['mdp']));
		$prep->execute();
	}

	
	// Includes
	$smarty->display('temp.tpl');
	include('includes/haut.inc.php');

?>
