<?php
require 'lib.inc.php';
require 'header.php';
?>

<?php
$co = connexionBD();
landing($co);
?>


<div class="container" id="container-index">
    <h1 id="str"> </h1>
    <div class="list-group">



    </div>
    <nav class="nav justify-content-end nav-tabs" id="boutons-filtrage">
        <button type="button" class="btn nav-link" aria-current="true" onclick="filterSelection('all')">
            Tout voir
        </button>
        <?php
        $co = connexionBD();
        filtrage($co);
        ?>
    </nav>

    <div class="image-container" id="ancre">

        <h1 class="index-mobile-titre">PHOTOS</h1>
        <?php
        $co = connexionBD();
        afficherPhotos($co);

        deconnexionBD($co);
        ?>
    </div>

    <div class="popup-image">
        <span>&times;</span>
        <img src="" alt="">
        <p class="text-desc-full hover-description">
        </p>
        <div class="boutons zindex999">

            <button type="button" class="previous btn btn-light" onclick="afficherprecedent(id)">Précedent</button>
            <button type="button" class="next btn btn-light" onclick="affichersuivant(id)">Suivant</button>
        </div>
    </div>
    <div class="easter-egg">
        <span>&times;</span>
        <?php
        $co = connexionBD();
        easterEgg($co);
        deconnexionBD($co);
        ?>
    </div>
    <p class="clue"></p>
</div>

<script>
    let i = 0

    var AllImages = document.querySelectorAll('.image-container .image')


    AllImages.forEach(image => {
        i++
        var source = image.querySelector('.img').getAttribute('src')
        image.querySelector('.img').setAttribute('id', i);
        image.onclick = () => {
            document.querySelector('.popup-image').style.display = 'block';
            document.querySelector('.popup-image img').src = image.querySelector('.img').getAttribute('src');
            document.querySelector('.popup-image p').innerHTML = image.querySelector('.pepe').innerHTML;
            document.querySelector('.next').setAttribute('id', image.querySelector('.img').id)
            document.querySelector('.previous').setAttribute('id', image.querySelector('.img').id)
        }
    });



    document.querySelector('.popup-image span').onclick = () => {
        document.querySelector('.popup-image').style.display = 'none';
    }


    function affichersuivant(id) {
        var actuel = parseInt(id)
        var suivant = actuel + 1
        console.log(actuel)
        console.log(suivant)



        /* effacer l'actuelle image */
        document.querySelector('.popup-image').style.display = 'none';

        /*afficher la suivante (on simule le click sur l'image d'après) */
        document.getElementById(suivant).click()
    }

    function afficherprecedent(id) {
        var actuel = parseInt(id)
        var precedent = parseInt(actuel) - 1
        console.log(id)
        console.log(precedent)
        /* effacer l'actuelle image */
        document.querySelector('.popup-image').style.display = 'none';
        /*afficher la precedente */
        document.getElementById(precedent).click()
    }



    /* curseur custom */

    const bob = document.getElementById('cursor');

    let mouseX = 0;
    let mouseY = 0;

    let ballX = 0;
    let ballY = 0;

    let speed = 0.2; //how fast ball catches up to mouse pointer;

    function animate() {
        let distX = mouseX - ballX;
        let distY = mouseY - ballY;

        ballX = ballX + (distX * speed);
        ballY = ballY + (distY * speed);

        bob.style.left = ballX + 'px';
        bob.style.top = ballY + 'px';

        requestAnimationFrame(animate)

    };

    animate();

    document.addEventListener('mousemove', function(e) {
        mouseX = e.pageX;
        mouseY = e.pageY;
    });

    document.addEventListener('click', function(e) {
        e.preventDefault;
        bob.classList.remove('active');
        //some rando comment

        void bob.offsetWidth;

        bob.classList.add('active');

    }, false);
    /* ----- */
    /* filtrage des photos : */

    filterSelection("all")

    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("filter");
        if (c == "all") c = "";

        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
        }
    }

    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
        }
    }

    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }

    /* easter egg */
    let easter = 0
    cachette = Math.floor(Math.random() * AllImages.length);
    console.log('Pour découvrir une photo inédite, clique 3 fois sur la photo correspondante au nombre affiché :')
    console.log(cachette)
    document.querySelector("p.clue").innerHTML = cachette
    document.getElementById(cachette).addEventListener("click", function(easterEgg) {
        easter++
        if (easter == 3) {
            document.querySelector('.easter-egg').style.display = 'block';
        }
    })

    document.querySelector('.easter-egg span').onclick = () => {
        document.querySelector('.popup-image').style.display = 'none';
        document.querySelector('.easter-egg').style.display = 'none';
    }


    /* ---- */
</script>





<?php
require 'footer.php';
?>