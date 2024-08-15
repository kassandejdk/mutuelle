<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="GestMutuelle , pour une bonne gestion de votre mutuelle">
	<meta name="author" content="KASSANDE Judicael|NACANABO Abdramane">
	<meta name="keywords" content="GestMutuelle,ESI,Mutuelle,Informatique">
	<title>GestMuelle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('admin/assets/vendors/core/core.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/assets/css/demo2/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />
</head>

<body style="font-family: Poppins;">
    <div class="main-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashbord.accueil') }}">GestMutuelle</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">À propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#faq">FAQ</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="{{ route('dashbord.accueil') }}" class="btn btn-outline-light">Se connecter</a>
                    </form>
                </div>
            </div>
        </nav>
        <div class="page-wrapper">
            <div class="page-content">

                @if(session('success'))
                    <div class="alert fermerAlerte alert-success fs-4 d-flex justify-content-between alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close btn-noboot" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" >&times;</span>
                        </button>
                    </div>
                    <script>
                        const alertFermer=document.querySelector('.fermerAlerte');
                        setTimeout(() => {
                                alertFermer.remove(); 
                        },4000)
                    </script>
                 @endif
                
                <header class="page-header mb-5 text-center">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('admin/assets/images/mutuelle.jpg') }}" class="d-block w-100" alt="Image principale">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Bienvenue sur GestMutuelle</h5>
                                    <p>Des solutions innovantes pour la gestion de vos besoins de mutuelle.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                
               
                
                <section class="about-us mb-5 p-4 bg-dark rounded shadow-sm fs-5" id="about">
                    <h2 class="display-6 mb-2 text-center" style="font-weight: 800;">À propos de nous</h2>
                    <p class="text-justify lead">
                        GestMutuelle est une plateforme dédiée à simplifier la gestion des mutuelles pour les entreprises et les particuliers. Nous proposons des outils complets pour gérer vos adhésions, vos cotisations et vos remboursements de manière efficace.
                    </p>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <i class="link-icon mr-3 text-success" data-feather="check-circle" style="font-size: 1.5rem;"></i>
                                    <span class="lead ms-2">Gestion des adhésions simplifiée</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <i class="link-icon mr-3 text-success" data-feather="check-circle" style="font-size: 1.5rem;"></i>
                                    <span class="lead ms-2">Suivi des cotisations en temps réel</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <i class="link-icon mr-3 text-success" data-feather="check-circle" style="font-size: 1.5rem;"></i>
                                    <span class="lead ms-2">Remboursements rapides et faciles</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                
                <section class="services mb-5" id="services">
                    <h2 class="display-6 mb-2" style="text-align: center;font-weight:800;" >Nos services </h2>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card text-center">
                                <div class="card-body fs-5">
                                    <i class="link-icon mb-3" data-feather="users" style="font-size: 3rem;"></i>
                                    <h3 class="card-title" style="font-weight:800;">Gestion des Membres</h3>
                                    <p class="card-text">Gérez facilement l'adhésion et les informations des membres avec notre système centralisé.
                                        Gérez facilement les adhésions et les informations des membres en temps réel.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card text-center">
                                <div class="card-body fs-5">
                                    <i class="link-icon mb-3" data-feather="briefcase" style="font-size: 3rem;"></i>
                                    <h3 class="card-title" style="font-weight:800;">Gestion des Prêts</h3>
                                    <p class="card-text">Surveillez et gérez les demandes de prêt et les remboursements efficacement.
                                        Gérez facilement les prêts et les remboursements en temps réel.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card text-center">
                                <div class="card-body fs-5">
                                    <i class="link-icon mb-3" data-feather="refresh-ccw" style="font-size: 3rem;"></i>
                                    <h3 class="card-title" style="font-weight:800;">Gestion des Remboursements</h3>
                                    <p class="card-text">Simplifiez le processus de remboursement avec nos outils automatisés.
                                        Gérez facilement vos paiements en temps réel.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="link-icon mb-3" data-feather="file-text" style="font-size: 3rem;"></i>
                                    <h3 class="card-title fs-5" style="font-weight:800;">Génération de Rapports Financiers</h3>
                                    <p class="card-text">Créez des rapports financiers détaillés et précis en quelques clics.
                                        Tres utiles pour garder un oeil sur vos flux financiers
                                        et vous assurer de votre gestion de finances.
                                      
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>

                <section class="faq" id="faq">
                    <h2 class="display-6 mb-2" style="text-align: center;font-weight:800;" >Questions Frequemments posees (FAQ) </h2>
                    <div class="accordion" id="faqAccordion">
                        <div class="row fs-5">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="link-icon mr-2" data-feather="chevron-down"></i> Comment gérer mes cotisations?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                        <div class="card-body">
                                            Pour gérer vos cotisations, connectez-vous à votre compte et accédez à la section des cotisations. Vous pouvez voir un récapitulatif de vos paiements et effectuer des modifications si nécessaire.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link  fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="link-icon mr-2" data-feather="chevron-down"></i> Comment accéder au support?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                        <div class="card-body">
                                            Pour accéder au support, veuillez cliquer sur la section "Support" dans la barre latérale. Vous pouvez soumettre une demande ou consulter notre centre d'aide en ligne.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <i class="link-icon mr-2" data-feather="chevron-down"></i> Comment modifier mes informations personnelles?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                        <div class="card-body">
                                            Pour modifier vos informations personnelles, accédez à la section "Mon Compte" et cliquez sur "Modifier Profil". Vous pouvez mettre à jour vos informations et enregistrer les modifications.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingFour">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                <i class="link-icon mr-2" data-feather="chevron-down"></i> Comment puis-je annuler mon adhésion?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                        <div class="card-body">
                                            Pour annuler votre adhésion, veuillez contacter notre service client. Ils vous guideront à travers le processus d'annulation et vous informeront de toute condition ou politique liée à votre plan actuel.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingFive">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                <i class="link-icon mr-2" data-feather="chevron-down"></i> Quels vos sont moyens de paiement?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                                        <div class="card-body">
                                            <p>Orange Money</p>
                                            <p>Moov Money</p>
                                            <p>LigdiCash</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingSix">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                <i class="link-icon mr-2" data-feather="chevron-down"></i> Puis-je changer de plan après l'inscription?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                                        <div class="card-body">
                                            Oui, vous pouvez changer de plan après l'inscription en vous connectant à votre compte et en sélectionnant l'option "Changer de Plan". Assurez-vous de lire les conditions associées à tout changement de plan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="contact-us" class="contact-us mb-5 mt-5">
                    <h2 class="display-6 mb-2 text-center" style="font-weight: 800;">Contactez-nous</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-4">
                                <h3 class="mb-3">Envoyez-nous un message</h3>
                                <form class="fs-5" method="POST" action="{{ route('contacter.nous') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control"  name="email"  id="email" placeholder="Votre email"  style="height: 50px;"  required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Objet</label>
                                        <input type="text" class="form-control" name="sujet"  id="subject" placeholder="Objet de votre message" style="height: 50px;" required >
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" name="message" id="message" rows="4" placeholder="Votre message"  required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </form>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-4 d-flex flex-column justify-content-center">
                                <h3 class="mb-3">Informations de contact</h3>
                                <p class="lead">
                                    Pour toute question ou assistance, vous pouvez nous contacter via les informations suivantes :
                                </p>
                                <ul class="list-unstyled fs-5">
                                    <li class="mb-2 mt-3" style="line-height: 60px;">
                                        <i class="link-icon mr-2" data-feather="map-pin"></i>
                                        <span>Adresse : 123 Rue de l'Innovation, Ouagadougou, Burkina Faso</span>
                                    </li>
                                    <li class="mb-2" style="line-height: 60px;">
                                        <i class="link-icon mr-2" data-feather="phone"></i>
                                        <span>Téléphone : +226 12 34 56 78</span>
                                    </li>
                                    <li class="mb-2" style="line-height: 60px;">
                                        <i class="link-icon mr-2" data-feather="mail"></i>
                                        <span>Email : contact@gestmutuelle.com</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                
                

                <footer class="footer  text-white py-4 fs-5" style="background: #4d83d3;">
                    <div class="container text-center">
                        <p class="mb-0">&copy; 2024 GestMutuelle. Tous droits réservés.</p>
                    </div>
                </footer>
                
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/template.js') }}"></script>
</body>

<style>
    .page-wrapper{
        margin-left: 0 !important;
        width: 100% !important;
    }
    .navbar{
        width: 100% !important;
        left: 0 !important;
        height: 80px;
    }
    .main-wrapper .page-wrapper{
        width: 100% !important;
        
    }
    .btn-noboot{
      background: none !important;
      border: none !important;
      color: inherit !important;
      padding: 0 !important;
      font: inherit !important;
      cursor: pointer !important;
      outline: inherit !important;
    }
</style>
</html>















