<?php 
    require_once 'configuration.php'; // On inclut la connexion à la bdd


    // Si les variables existent et qu'elles ne sont pas vides
    
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
    {

        // Patch XSS
        $name = htmlspecialchars($_POST['name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $birth_date = htmlspecialchars($_POST['birth_date']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);
        
        $school = filter_input(INPUT_POST, 'choice-school'); // 1
            

       
       
        // On vérifie si l'utilisateur existe
        $check = $pdo->prepare('SELECT username, last_name, birth_date, email, password, avatar, banner, schools_id FROM users WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $stmt = $pdo->prepare("SELECT idschools FROM schools WHERE idschools = :school");
        $stmt->execute([
            ":school" => $school
        ]);
        $schoolId = $stmt->fetch();
        if(!$schoolId) {
           header('Location: register.php?reg_err=school'); die();
        }

        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
        
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($name) <= 25){ // On verifie que la longueur du name <= 25
                if(strlen($email) <= 255){ // On verifie que la longueur du mail <= 255
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                        if($password === $password_retype){ // si les deux mdp saisis sont bon

                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            
                            // On stock l'adresse IP
                            $ip = $_SERVER['REMOTE_ADDR']; 
                           
                            // On insère dans la base de données
                            $user_image = rand(1,12);
                            $user_banner = rand(1,9);

                            $insert = $pdo->prepare('INSERT INTO users(username,last_name, birth_date, email, password, ip, token, avatar, banner, schools_id) VALUES(:name, :last_name, :birth_date, :email, :password, :ip, :token, :user_image, :user_banner, :schools)');
                            $insert->execute(array(
                                'name' => $name,
                                'last_name' => $last_name,
                                'birth_date' => $birth_date,
                                'email' => $email,
                                'password' => $password,
                                'ip' => $ip,
                                'token' => bin2hex(openssl_random_pseudo_bytes(64)),
                                'user_image' => $user_image.'.png',
                                'user_banner' => $user_banner.'.png',
                                'schools' => $school

                            ));
                            // On redirige avec le message de succès
                            header('Location:register.php?reg_err=success');
                            die();
                        }else{ header('Location: register.php?reg_err=password'); die();}
                    }else{ header('Location: register.php?reg_err=email'); die();}
                }else{ header('Location: register.php?reg_err=email_length'); die();}
            }else{ header('Location: register.php?reg_err=name'); die();}
        }else{ header('Location: register.php?reg_err=already'); die();}
    }