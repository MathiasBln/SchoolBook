

<section class="header-gpe mt-5 p-5">
    
     <nav class="navbar navbar-expand-xl navbar-light">
        <div class="container">
            <section class="group-profil">
                <div class="image-circle">
                    <img src="assets/<?= $groups[0]["image"]?>" class="rounded-circle" alt="group logo">
                </div>
            </section>
        
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">  
                    <a class="nav-link nav-link-gpe" id="buttonPosts">Home</a>
                    <a class="nav-link nav-link-gpe" href="group_invitation.php?id_gpe=<?= $id_gpe?>">Invite friends</a>
                    <a class="nav-link nav-link-gpe" id="buttonMembers">Our members</a>
                    <?php if($user[0]["status"] == 1): ?>
                        <a class="nav-link nav-link-gpe" href="updateGroup.php?id_gpe=<?= $id_gpe?>">Modify</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1> <?= $groups[0]["name"] ?></h1>
        <div class="a-propos-groupe">
            <h4>What we are:</h4>
            <p><?= $groups[0]["description"]?></p>
        </div>
    </div>
   
</section>

