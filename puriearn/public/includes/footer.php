 <!-- footer -->
 <section class="w3l-footer-29-main">
        <div class="footer-29 py-5">
            <div class="container py-lg-4">
                <div class="row footer-top-29">
                    <div class="col-lg-4 col-md-6 footer-list-29 footer-1 pe-lg-5">
                        <div class="footer-logo mb-4">
                            <h2><a class="navbar-brand" href="index.php">
                                   <img src="assets/images/logo.png" style="width:200px;">
                                </a></h2>
                             </div>
                            <p>Explore the endless possibilities with Puriearn where your smartphone,
                                 your influence and your effort translate into real earnings.
                            </p>
                        <div class="mt-3">
                        <i class="fa fa-envelope"></i> <a href="mailto:support@puriearn.com">support@puriearn.com</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-list-29 footer-2 mt-sm-0 mt-5">
                        <ul>
                            <h6 class="footer-title-29">Links</h6>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="how-it-works.php">How it works</a></li>
                            <li><a href="services.php">Services</a></li>
                            <li><a href="vendors.php">Vendors</a></li>
                            <li><a href="top-earners.php">Top Earners</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-list-29 footer-3 mt-lg-0 mt-5">
                        <h6 class="footer-title-29">Others</h6>
                        <ul>
                            <li><a href="terms-conditions.php">Terms and conditions</a></li>
                            <li><a href="code-tracker.php">Code Tracker</a></li>
                        </ul>

                    </div>
                    
                </div>
            </div>
        </div>
        <!-- copyright -->
        <section class="w3l-copyright text-center">
            <div class="container">
                <p class="copy-footer-29">© <script>document.write(new Date().getFullYear());</script> Puriearn. All Rights Reserved. </a></p>
            </div>

            <!-- move top -->
            <button onclick="topFunction()" id="movetop" title="Go to top">
                <span class="fas fa-arrow-up"></span>
            </button>
            <script>
                // When the user scrolls down 20px from the top of the document, show the button
                window.onscroll = function() {
                    scrollFunction()
                };

                function scrollFunction() {
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        document.getElementById("movetop").style.display = "block";
                    } else {
                        document.getElementById("movetop").style.display = "none";
                    }
                }

                // When the user clicks on the button, scroll to the top of the document
                function topFunction() {
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                }

            </script>
            <!-- /move top -->
        </section>
        <!-- //copyright -->
    </section>
    <!-- //footer -->
    <!-- Js scripts -->
    <!-- Template JavaScript -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/theme-change.js"></script>
     <script src="assets/js/jquery-1.9.1.min.js"></script>
    <!-- faq -->
    <script>
        const items = document.querySelectorAll(".accordion button");

        function toggleAccordion() {
            const itemToggle = this.getAttribute('aria-expanded');

            for (i = 0; i < items.length; i++) {
                items[i].setAttribute('aria-expanded', 'false');
            }

            if (itemToggle == 'false') {
                this.setAttribute('aria-expanded', 'true');
            }
        }

        items.forEach(item => item.addEventListener('click', toggleAccordion));

    </script>
    <!-- //faq -->
    <!-- MENU-JS -->
    <script>
        $(window).on("scroll", function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function() {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function() {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function() {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });

    </script>
    <!-- //MENU-JS -->

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function() {
            $('.navbar-toggler').click(function() {
                $('body').toggleClass('noscroll');
            })
        });

    </script>
    <!-- //disable body scroll which navbar is in active -->

    <!-- //bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>