<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <img id="logo" src="svg/Logo.svg" alt="">
     
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a id="home"class="nav-link active" aria-current="page" href="../home.php">Home</a>
            </li>
            <li class="nav-item">
                <a id="nav-link"class="nav-link active" aria-current="page" href="../recherche.php">Search</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./group_search.php">Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages.php?id=<?=$_SESSION['user_id'];?>">Pages</a>
            </li>
        </ul>
        <div id="logout">
                    <a class="nav-link" href="../logout.php">Logout</a>

                </div>
        
        </div>
    </div>
</nav>
