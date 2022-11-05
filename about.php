<?php
require 'lib.inc.php';
require 'header.php';
?>

<div class="container">
    <h1>À PROPOS</h1>
    <div class="card mb-3 card-about" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="photos/kuzcooo.jpg" class="img-fluid" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body card-about-text">
                    <h5 class="card-title">Agathe Bevia</h5>
                    <p class="card-text">I was born and raised in coastal North Carolina; it’s the sort of place with sandy soil you can’t forget. Growing up I spent a lot of time on my Granddad’s farm. I’ll always remember sitting in his den listening to stories and there always being one too many logs on the fire.
                        <br>
                        <br>

                        In between then and now I went to school in Savannah, GA. Became good friends with my sister. You know, adult friends. Told my Mom I love her. Found deeper roots in Idaho. Traversed all 50 states + met my best friend Maddie the Coonhound.
                        <br>
                        These days I like to think my photography exists somewhere between that country living and city ideals. Images with roots and connections but excited about big lights and tall buildings.
                    </p>
                    <div class="card-about-links">
                        <div>
                            <img src="icons/insta.png" alt="">
                            <a href="https://www.instagram.com/ehtagaiveb" id="str" target="_blank"></a>
                        </div>
                        <div>
                            <img src="icons/mail.png" alt="">
                            <a href="" id="str2"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    var string = "@ehtagaiveb";
    var str = string.split("");
    var el = document.getElementById('str');
    (function animate() {
        str.length > 0 ? el.innerHTML += str.shift() : clearTimeout(running);
        var running = setTimeout(animate, 90);
    })();

    var string2 = "tonmail@ici.com";
    var str2 = string2.split("");
    var el2 = document.getElementById('str2');
    (function animate() {
        str2.length > 0 ? el2.innerHTML += str2.shift() : clearTimeout(running2);
        var running2 = setTimeout(animate, 90);
    })();
</script>

<?php
require 'footer.php';
