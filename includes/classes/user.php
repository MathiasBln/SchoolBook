<?php
// user.php
class User{
    protected $db;
    protected $user_name;
    protected $user_email;
    protected $user_pass;
    protected $hash_pass;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // LOGIN USER
    function loginUser($email, $password){
        
        try{
            $this->user_email = trim($email);
            $this->user_pass = trim($password);

            $find_email = $this->db->prepare("SELECT * FROM `users` WHERE email = ?");
            $find_email->execute([$this->user_email]);
            
            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);

                $match_pass = password_verify($this->user_pass, $row['password']);
                if($match_pass){
                    $_SESSION = [
                        'user_id' => $row['iduser'],
                        'email' => $row['email'],
                        'user' => $row['token'],
                        'avatar' => $row['avatar'],
                        'banner' => $row['banner'],



                    ];
                    header('Location: profile.php');
                }
                else{
                    header('Location: index.php?login_err=password'); die();
                    return ['errorMessage' => 'Invalid password'];
                }
                
            }
            else{
                header('Location: index.php?login_err=email'); die();
                return ['errorMessage' => 'Invalid email address!'];
            }

        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // FIND USER BY ID
    function find_user_by_id($id){
        try{
            $find_user = $this->db->prepare("SELECT * FROM `users` WHERE iduser = ?");
            $find_user->execute([$id]);
            if($find_user->rowCount() === 1){
                return $find_user->fetch(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    function all_users($id){
        try{
            $get_users = $this->db->prepare("SELECT iduser, username, avatar FROM `users` WHERE iduser != ?");
            $get_users->execute([$id]);
            if($get_users->rowCount() > 0){
                return $get_users->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function all_posts_users($id){
        try{
            $get_users_posts = $this->db->prepare("SELECT * FROM posts INNER JOIN users u ON u.iduser = posts.users_iduser WHERE posts.users_iduser = ?;");
            $get_users_posts->execute([$id]);
            if($get_users_posts->rowCount() > 0){
                return $get_users_posts->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>