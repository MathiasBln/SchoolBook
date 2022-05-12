<?php require ('partials/header.php'); ?>

  <div class="create-page">

  <?php
    
    session_start(); 
    if (!isset($_SESSION['identifiant'])) { 
      //redirection sur la page de connexion 
      header("Location:connexion.php"); 
    } 
    ?> 
  </div>