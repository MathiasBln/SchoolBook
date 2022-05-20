
<section class="header-gpe">
    <section class="banner-gpe">
        <div class="banner-image-gpe" style="background-image:url(assets/<?=$groups[0]["idgroups"]?>-group.jpg)"></div>     
    </section>

     <nav class="navbar navbar-expand-xl navbar-light">
        <div class="container">
            <section class="group-profil">
                <div class="image-circle">
                    <img src="assets/<?= $groups[0]["image"]?>" class="rounded-circle" alt="group logo">
                </div>
            </section>
        
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">  
                    <a class="nav-link nav-link-gpe" id="buttonPosts">A propos</a>
                    <a class="nav-link nav-link-gpe" href="group_invitation.php?id_gpe=<?= $id_gpe?>">Invitez vos amis</a>
                    <a class="nav-link nav-link-gpe" id="buttonMembers">Membres du groupe</a>
                    <?php if($user[0]["status"] == 1): ?>
                        <a class="nav-link nav-link-gpe" href="updateGroup.php?id_gpe=<?= $id_gpe?>">Modifier</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1> <?= $groups[0]["name"] ?></h1>
        <div class="a-propos-groupe">
            <h4>A propos de nous</h4>
            <p><?= $groups[0]["description"]?></p>
        </div>
    </div>
   
</section>

