<!-- va contenir le formulaire d'inscription -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <title>SchoolBook</title>
</head>
<body>
    



<div class="contain-register">
            <?php 
            require_once 'configuration.php'; // ajout connexion bdd 
            $stmt = $pdo->prepare("SELECT * FROM schools");
            $stmt->execute();
            $allSchools = $stmt->fetchAll();
            
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                        ?>
                             <form action="index.php" method="post" class="box">
         
                                <div class="text-box">
                                    <h2>Go Sign In</h2>
                                    <p><strong>CONGRATULATION</strong> Your account has been Successfully created !</p>
                                <button type="submit" class="btn-box"><i class="gg-arrow-right"></i></button>

                                </div>
                            </form>
                        <?php
                        break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error</strong> différent password
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error</strong> email not valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error</strong> email too long
                            </div>
                        <?php 
                        break;

                        case 'name_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error</strong> name too long
                            </div>
                        <?php 
                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error</strong> Account is already exist
                            </div>
                        <?php 

                    }
                }
                ?>
            
            <form action="register_traitment.php" method="post" class="register-form" enctype="multipart/form-data" >
                <div class="text-register">
                <h2>Register</h2>
                <p>already have an account? <a href="index.php"> Sign In</a></p>    
                </div>   
                <div class="inputs-register">
                    <input type="text" name="name" class="form-input" placeholder="name" required="required" autocomplete="off">
                    <input type="text" name="last_name" class="form-input" placeholder="last name" required="required" autocomplete="off">

                    <input type="date" name="birth_date" class="form-input date" placeholder="name" required="required" autocomplete="off">
                    <!-- <input type="text" name="school_id" class="form-input" placeholder="School" required="required" autocomplete="off"> -->
               
              
                    <input type="email" name="email" class="form-input" placeholder="Email" required="required" autocomplete="off">
               
               
                    <input type="password" name="password" class="form-input" placeholder="Mot de passe" required="required" autocomplete="off">
             
                
                    <input type="password" name="password_retype" class="form-input" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">

                    
                    <select class="select-school form-input" name="choice-school">
                        <option value="" selected>name school</option>
                        <?php foreach($allSchools as $theSchool): ?>
                        <option value="<?php echo $theSchool['idschools'] ?>"><?= $theSchool['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
		                   
                </div>
                <div class="btn-register">
                  <button type="submit">Sign Up</button>
                </div>   
            </form>

        </div>
        <script src="./main.js"></script>
</body>
</html>
