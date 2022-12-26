<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Net'Gallery - Inscription</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" /> <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
    <link href="fontawesome/css/all.min.css" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
    <link href="css/inscription.css" rel="stylesheet" />
<!--

TemplateMo 550 Diagoona

https://templatemo.com/tm-550-diagoona

-->
</head>
<body>


    <header>
        <div class="nav_bar">
            <nav class="navbar navbar-expand-lg" id="tm-main-nav">
                <button class="navbar-toggler toggler-example mr-0 ml-auto" type="button"                                
                    data-toggle="collapse" data-target="#navbar-nav" 
                    aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse tm-nav" id="navbar-nav">
                    <ul class="navbar-nav text-uppercase">
                        <li class="nav-item">
                            <a class="nav-b nav-link tm-nav-link" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-b nav-link tm-nav-link" href="galerie.php">Galerie</a>
                        </li>                            
                        <li class="nav-item">
                            <a class="nav-link tm-nav-link" href="livredor.php">Livre d'or</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tm-nav-link" href="inscription.php">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tm-nav-link" href="session.php">Gestion</a>
                        </li>
                    </ul>                            
                </div>                        
            </nav>
        </div>
        <h1>Inscription<br> <span>Exposition</span></h1>
        <p>Inscrivez-vous !</p>
    </header>

    <div class="main">
        <main class="tm-col-right tm-contact-main"> 
            <section class="tm-content tm-contact">
                <p class="mb-85">Penser à entrer une adresse mail valide (ex: @gmail.com) et un mot de passe sécurisé.</p>
                <form id="contact-form" action="action.php" method="post" novalidate>
                    <div class="form-group mb-4">
                        <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" name="cfmdp" class="form-control" placeholder="Confirmer le mot de passe" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email (Facultatif)" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control" placeholder="Nom" required="" />
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="forname" class="form-control" placeholder="Prénom" required="" />
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-big btn-primary">Valider</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
    </div>

    <footer class="tm-site-footer">
        <p class="mb-0">Copyright 2022 Combot Evan | Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-text-link">TemplateMo</a></p>
    </footer>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>

</body>
</html>

