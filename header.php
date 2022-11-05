<header>
    <section class="navbar-container navnav">
        <nav>
            <ul>
                <li class="navbar-link">
                    <a class="hover-underline-animation" href="index.php">Photos</a>
                </li>
                <li>
                    <h1 class="header-title" id="beviax-animate"></h1>
                </li>
                <li class="navbar-link">
                    <a class="hover-underline-animation" href="about.php">A propos</a>
                </li>
            </ul>
        </nav>
    </section>
    <section class="navbar-mobile">
        <nav role="navigation">
            <div id="menuToggle" class="navnavmobile">
                <!--
        A fake / hidden checkbox is used as click reciever,
        so you can use the :checked selector on it.
        -->
                <input type="checkbox" />

                <!--
        Some spans to act as a hamburger.
        
        They are acting like a real hamburger,
        not that McDonalds stuff.
        -->
                <span></span>
                <span></span>
                <span></span>

                <!--
        Too bad the menu has to be inside of the button
        but hey, it's pure CSS magic.
        -->
                <ul id="menu">
                    <a href="index.php">
                        <li>Photos</li>
                    </a>
                    <a href="about.php">
                        <li>À propos</li>
                    </a>
                    <a href="admin/admin.php"><img src="icons/padlock.png" alt=""></a>

                </ul>
            </div>
        </nav>
    </section>

</header>


<script>
    /* scrollUp et Down desktop */

    var x = window.matchMedia("(min-width: 768px)")
    scrollUpDownPC(x) // Call listener function at run time
    x.addListener(scrollUpDownPC) // Attach listener function on state changes

    function scrollUpDownPC(x) {
        if (x.matches) {
            const body = document.body;
            const nav = document.querySelector(".navnav");
            const scrollUp = "scroll-up";
            const scrollDown = "scroll-down";
            let lastScroll = 0;

            window.addEventListener("scroll", () => {
                const currentScroll = window.pageYOffset;
                if (currentScroll <= 0) {
                    nav.classList.remove(scrollUp);
                    return;
                }

                if (currentScroll > lastScroll && !nav.classList.contains(scrollDown)) {
                    // down
                    nav.classList.remove(scrollUp);
                    nav.classList.add(scrollDown);
                } else if (
                    currentScroll < lastScroll &&
                    nav.classList.contains(scrollDown)
                ) {
                    // up
                    nav.classList.remove(scrollDown);
                    nav.classList.add(scrollUp);
                }
                lastScroll = currentScroll;
            })
        }
    };

    /* scrollUp et Down mobile */
    var y = window.matchMedia("(max-width: 768px)")
    scrollUpDownMobile(y) // Call listener function at run time
    y.addListener(scrollUpDownMobile) // Attach listener function on state changes

    function scrollUpDownMobile(y) {
        if (y.matches) {
            const body = document.body;
            const nav = document.querySelector(".navnavmobile");
            const scrollUp = "scroll-up";
            const scrollDown = "scroll-down";
            let lastScroll = 0;

            window.addEventListener("scroll", () => {
                const currentScroll = window.pageYOffset;
                if (currentScroll <= 0) {
                    nav.classList.remove(scrollUp);
                    return;
                }

                if (currentScroll > lastScroll && !nav.classList.contains(scrollDown)) {
                    // down
                    nav.classList.remove(scrollUp);
                    nav.classList.add(scrollDown);
                } else if (
                    currentScroll < lastScroll &&
                    nav.classList.contains(scrollDown)
                ) {
                    // up
                    nav.classList.remove(scrollDown);
                    nav.classList.add(scrollUp);
                }
                lastScroll = currentScroll;
            })
        }
    };

    /* apparition titre page */
    var string15 = "BEVIAX";
    var str15 = string15.split("");
    var el15 = document.getElementById('beviax-animate');
    (function animate() {
        str15.length > 0 ? el15.innerHTML += str15.shift() : clearTimeout(running);
        var running = setTimeout(animate, 300);
    })();

    /* mobile toggle navbar */
    const navMenu = document.querySelector(".navbar-mobile");
    navMenu.addEventListener("click", () => {
        navMenu.classList.toggle("active");
    })
</script>