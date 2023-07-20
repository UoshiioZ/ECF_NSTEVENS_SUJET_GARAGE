<?php
// Inclure le fichier de configuration
require_once 'config.php';

// Etablir la connexion à la base de données
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

    // Etablir la connexion à la base de données
    
    // Requête SQL pour sélectionner les avis vérifiés
    $sql = "SELECT * FROM avis WHERE verifie = 1";

    // Exécuter la requête SQL
    $result = $conn->query($sql);

    // Afficher les avis vérifiés
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ratingHTML = '';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $row['rating']) {
                    $ratingHTML .= '<span class="star">&#9733;</span>'; // étoile pleine
                } else {
                    $ratingHTML .= '<span class="star">&#9734;</span>'; // étoile vide
                }
            }
            echo '
            <div class="avis-item">
                <h3>' . $row['prenom'] . '</h3>
                <p>' . $row['avis'] . '</p>
                <div class="rating">' . $ratingHTML . '</div>
            </div>
            ';
        }
    } else {
        echo '<p>Aucun avis vérifié pour le moment.</p>';
    }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECF GARAGE V.PARROT</title>
    <link rel="stylesheet" href="css\style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <a href="#"><img src="assets/images/LogoB.png" alt="Logo Garage V.Parrot"></a>
        </div>
        <nav>
            <ul>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>><a href="index.php">Accueil</a></li>
                <li><a href="pages\ventes.php">Voiture d'occasion</a></li>
                <li><a class="login-button" href="pages\login.php">Se connecter</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-image"></div>
        <div class="hero-content">
            <img src="assets\images\LogoBCroped.png" alt="">
            <p>Votre partenaire de confiance pour la réparation et la vente de voitures d'occasion. <br> Qualité et service exceptionnels garantis.</p>
            <a class="en-savoir-plus" href="#section-reparation" data-scroll>En savoir plus</a>
        </div>
    </section>
    <section class="section-reparation" id="section-reparation">
        <div class=section-reparation-image></div>
        <div class="section-reparation-content">
            <p>Confiez-nous l'entretien et la réparation de votre voiture. Notre équipe expérimentée de mécaniciens utilise des équipements de pointe pour garantir des résultats fiables. Nous vous offrons un service transparent et vous tenons informés à chaque étape. Reprenez la route en toute sérénité avec notre expertise. <br> Qualité et service exceptionnels garantis.</p>
            <a class="section-reparation-rdv" href="#section-contact" data-scroll>Prenez rendez-vous!</a>
        </div>
    </section>
    <section class="section-achat" id="section-achat">
        <div class=section-achat-image></div>
        <div class="section-achat-content">
            <p>Découvrez notre sélection de voitures d'occasion de qualité. Fiables et soigneusement inspectées, nos véhicules répondent à vos besoins et à votre budget. Achetez en toute confiance grâce à notre transparence et à notre garantie de satisfaction.</p>
            <a class="section-achat-newpage" href="pages\ventes.php">Voir nos voitures</a>
        </div>
    </section>

    <section class="section-avis" id="section-avis">
        <div class=section-avis-image></div>
        <div class="section-avis-content">
            <h1>VOS AVIS!</h1>
            <p>Faites confiance à nos clients satisfaits et découvrez par vous-même pourquoi le Garage Auto-Occasion est le choix préféré pour l'achat de voitures d'occasion et les services de réparation.</p>
            <form id="avisForm" action="traitement_avis.php" method="post">
                <div class="input-container">
                    <label for="prenom">Prénom:</label>
                    <input type="text" id="prenom" name="prenom" pattern="[A-Za-zÀ-ÖØ-öø-ÿ]+" required>
                </div>

                <div class="input-container">
                    <label for="avis">Laissez nous votre avis:</label>
                    <textarea id="avis" name="avis" rows="5" required></textarea>
                </div>

                <div class="input-container">
                    <label for="rating">Note:</label>
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5"></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4"></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3"></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2"></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1"></label>
                        </div>
                </div>
                <button type="submit">Envoyer</button>
            </form>
        </div>
        <div class="avis-list">
        <h2>Avis des utilisateurs</h2>
    
        </div>
    </section>
    <section class="section-contact" id="section-contact">
        <div class=section-contact-image></div>
        <div class="section-contact-content">
            <h1>NOUS CONTACTER!</h1>
            <form id="contactForm" action="traitement_contact.php" method="post">
            <div class="input-row">
                <div class="input-container">
                    <label for="prenom">Prénom:</label>
                    <input type="text" id="prenom" name="prenom" pattern="[A-Za-zÀ-ÖØ-öø-ÿ]+" required>
                </div>
                <div class="input-container">
                    <label for="nom">Nom:</label>
                    <input type="text" id="nom" name="nom" pattern="[A-Za-zÀ-ÖØ-öø-ÿ]+" required>
                </div>
            </div>

            <div class="input-row">
                <div class="input-container">
                    <label for="telephone">Téléphone:</label>
                    <input type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" required>
                </div>
                <div class="input-container">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>

            <div class="input-container">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="pill-button">Envoyer</button>
        </form>
        </div>
    </section>
    <footer>
        <p class=horraire >Nous Sommes ouvert!
            Du Lundi au Vendredi de 9H à 18H
        </p>
        <p class=copyright >&copy; <?php echo date("Y"); ?> Garage V.Parrot. Tous droits réservés.</p>
    </footer>
    <script>
    // Fonction pour animer le défilement vers la cible
    function smoothScroll(target, duration) {
        var targetElement = document.querySelector(target);
        var targetPosition = targetElement.getBoundingClientRect().top;
        var startPosition = window.pageYOffset;
        var startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            var timeElapsed = currentTime - startTime;
            var run = ease(timeElapsed, startPosition, targetPosition, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        function ease(t, b, c, d) {
            // Fonction d'animation dite "easeInOutCubic"
            t /= d / 2;
            if (t < 1) return c / 2 * t * t * t + b;
            t -= 2;
            return c / 2 * (t * t * t + 2) + b;
        }

        requestAnimationFrame(animation);
    }

    // Ajoutez un gestionnaire d'événements au clic sur les liens avec l'attribut data-scroll
    var scrollLinks = document.querySelectorAll('[data-scroll]');
    scrollLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            var target = link.getAttribute('href');
            var duration = 1000; // Durée de l'animation en millisecondes (ajustez selon vos préférences)
            smoothScroll(target, duration);
        });
    });

     // Fonction pour gérer l'envoi du formulaire
    document.getElementById('avisForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var prenom = document.getElementById('prenom').value;
        var avis = document.getElementById('avis').value;
        var rating = document.querySelector('input[name="rating"]:checked');

        if (!prenom || !avis || !rating) {
            alert("Veuillez remplir tous les champs et sélectionner une note.");
            return;
        }

        // Appeler une fonction pour ajouter l'avis à l'affichage
        ajouterAvis(prenom, avis, rating.value);
        
        // Réinitialiser le formulaire après l'envoi
        document.getElementById('prenom').value = '';
        document.getElementById('avis').value = '';
        rating.checked = false;
    });

    // Fonction pour ajouter l'avis à l'affichage
    function ajouterAvis(prenom, avis, rating) {
        var avisList = document.querySelector('.avis-list');
        var avisItem = document.createElement('div');
        avisItem.classList.add('avis-item');

        // Code pour afficher les étoiles à droite de la div
        var ratingHTML = '';
        for (var i = 1; i <= 5; i++) {
            if (i <= rating) {
                ratingHTML += '<span class="star">&#9733;</span>'; // étoile pleine
            } else {
                ratingHTML += '<span class="star">&#9734;</span>'; // étoile vide
            }
        }

        avisItem.innerHTML = `
            <h3>${prenom}</h3>
            <p>${avis}</p>
            <div class="rating">${ratingHTML}</div>
        `;
        avisList.prepend(avisItem); // Ajoute l'avis au début de la liste

        // Fonction pour ajouter l'avis à l'affichage
    function ajouterAvis(prenom, avis, rating) {
        var avisList = document.querySelector('.avis-list');
        var avisItem = document.createElement('div');
        avisItem.classList.add('avis-item');

        // Code pour afficher les étoiles à droite de la div
        var ratingHTML = '';
        for (var i = 1; i <= 5; i++) {
            if (i <= rating) {
                ratingHTML += '<span class="star">&#9733;</span>'; // étoile pleine
            } else {
                ratingHTML += '<span class="star">&#9734;</span>'; // étoile vide
            }
        }

        avisItem.innerHTML = `
            <h3>${prenom}</h3>
            <p>${avis}</p>
            <div class="rating">${ratingHTML}</div>
        `;
        avisList.prepend(avisItem); // Ajoute l'avis au début de la liste

        // Afficher la pop-up de remerciement
        window.open("merci.php", "popup", "width=400,height=300");
    }


    // Autres fonctions et gestionnaires d'événements...
    }
</script>
</body>
</html>