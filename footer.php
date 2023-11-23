<div id="site-footer" class="site-footer">

    <div class="container">
        <div class="row">
            <footer class="clearfix">

                <div class="col-md-3 col-sm-6">
                    <section id="inspiry_address_widget-2" class="widget clearfix inspiry_address_widget">
                        <h3 class="widget-title">About Company</h3>
                        <p><img src="assets/content/uploads/2020/04/logo.png" alt="Company Logo" width="75%" style="    background-color: #fff; border: 2px solid #fca300;"></p>
                        <p class="address">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non autem tempore corrupti ducimus, nulla ipsum est..<a href="#">Know More</a></p>
                    </section>
                </div>
                <?php

                    $sql="select states.state_name as state_name from destination_state join states on destination_state.state_id=states.id where destination_state.is_deleted=0 limit 5";
                    $result=mysqli_query($con, $sql);
                    if(mysqli_num_rows($result)>0)
                    {
                ?>
                <div class="col-md-3 col-sm-6">
                    <section id="nav_menu-2" class="widget clearfix widget_nav_menu">
                        <h3 class="widget-title">Travel Destinations</h3>
                        <div class="menu-destinations-container">
                            <ul id="menu-destinations" class="menu">
                                <?php 
                                while($row=mysqli_fetch_assoc($result))
                                {
                                ?>
                                <li id="menu-item-860" class="menu-item menu-item-type-taxonomy menu-item-object-tour-destination menu-item-860">
                                    <a href="tours.php?state-name=<?= $row['state_name'] ?>"><?= ucwords($row['state_name']) ?></a>
                                </li>
                                <?php 
                                }
                                ?>
                            </ul>
                        </div>
                    </section>
                </div>
                <?php 
                    }
                ?>
                <div class="clearfix visible-sm"></div>
                <div class="col-md-3 col-sm-6">
                    <section id="nav_menu-2" class="widget clearfix widget_nav_menu">
                        <h3 class="widget-title">Travel Destinations</h3>
                        <div class="menu-destinations-container">
                            <ul id="menu-destinations" class="menu">
                                <li id="menu-item-860" class="menu-item menu-item-type-taxonomy menu-item-object-tour-destination menu-item-860">
                                    <a href="index.php">Home</a>
                                </li>
                                <li id="menu-item-860" class="menu-item menu-item-type-taxonomy menu-item-object-tour-destination menu-item-860">
                                    <a href="disclaimer.php">Disclaimer</a>
                                </li>
                                <li id="menu-item-862" class="menu-item menu-item-type-taxonomy menu-item-object-tour-destination menu-item-862">
                                    <a href="privacy-policy.php">Privacy Policy</a>
                                </li>
                                <li id="menu-item-864" class="menu-item menu-item-type-taxonomy menu-item-object-tour-destination menu-item-864">
                                    <a href="refund-policy.php">Refund Policy</a>
                                </li>
                                <li id="menu-item-866" class="menu-item menu-item-type-taxonomy menu-item-object-tour-destination menu-item-866">
                                    <a href="terms-and-conditions.php">Terms and Conditions</a>
                                </li>
                                <li id="menu-item-868" class="menu-item menu-item-type-taxonomy menu-item-object-tour-destination menu-item-868">
                                    <a href="faqs.php">FAQs</a>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
                <div class="col-md-3 col-sm-6">
                    <section id="inspiry_address_widget-2" class="widget clearfix inspiry_address_widget">
                        <h3 class="widget-title">Address &#038; Contact</h3>
                        <p class="email"><i class="fa fa-user" aria-hidden="true"></i>Mr. Santosh
                        </p>
                        <p class="email"><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:info@preetholiday.com">info@preetholiday.com</a>
                        </p>
                        <p class="phone"><i class="fa fa-phone"></i>
                            <a href="tel:+91 9268393805">9268393805</a>
                        </p>
                        <p class="email" style="margin-top:1.5rem;"><i class="fa fa-map" aria-hidden="true"></i>H.no 11 Vijay Nagar kirari Suleman nager Delhi 86, Near by RC plaza</p>
                    </section>
                </div>

            </footer>
            <div class="bottom-socket clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="copyright">&copy; 2023 Rights Reserved by PreetHoliday. And Designed By <a href='https://www.growbusinessforsure.com/'>GrowbusinessforSURE</a></p>
                        </div>
                        <div class="col-sm-6">
                            <figure class="credit-cards clearfix">
                                <img src="assets/content/themes/img/payment-icons/visa.svg" alt="visa">
                                <img src="assets/content/themes/img/payment-icons/amex.svg" alt="amex">
                                <img src="assets/content/themes/img/payment-icons/paypal.svg" alt="paypal">
                                <img src="assets/content/themes/img/payment-icons/mastercard.svg" alt="mastercard">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#top" id="scroll-top"><i class="fa fa-chevron-up"></i></a>

        </div>
    </div>
</div>

<script type="text/javascript">
    (function() {
        var c = document.body.className;
        c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
        document.body.className = c;
    })();
</script>
<script type='text/javascript' id='flying-pages-js-before'>
    window.FPConfig = {
        delay: 0,
        ignoreKeywords: ["\/wp-admin", "#\/wp-login.php", "\/cart", "\/checkout", "add-to-cart", "logout", "#", "?", ".png", ".jpeg", ".jpg", ".gif", ".svg", ".webp"],
        maxRPS: 3,
        hoverDelay: 50
    };
</script>
<script type='text/javascript' src='assets/content/plugins/flying-pages/flying-pages.min2f91.js?ver=2.4.6' id='flying-pages-js' defer></script>
<script type='text/javascript' src='assets/content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.minf111.js?ver=2.7.0-wc.8.1.1' id='jquery-blockui-js'></script>
<script type='text/javascript' id='wc-add-to-cart-js-extra'>
    /* <![CDATA[ */
    var wc_add_to_cart_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
        "i18n_view_cart": "View cart",
        "cart_url": "https:\/\/tourpress.inspirythemes.com\/cart\/",
        "is_cart": "",
        "cart_redirect_after_add": "no"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='assets/content/plugins/woocommerce/assets/js/frontend/add-to-cart.min12c8.js?ver=8.1.1' id='wc-add-to-cart-js'></script>
<script type='text/javascript' src='assets/content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min956a.js?ver=2.1.4-wc.8.1.1' id='js-cookie-js'></script>
<script type='text/javascript' id='woocommerce-js-extra'>
    /* <![CDATA[ */
    var woocommerce_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='assets/content/plugins/woocommerce/assets/js/frontend/woocommerce.min12c8.js?ver=8.1.1' id='woocommerce-js'></script>
<script type='text/javascript' src='assets/content/plugins/woocommerce/assets/js/flexslider/jquery.flexslider.min513c.js?ver=2.7.2-wc.8.1.1' id='flexslider-js'></script>
<script type='text/javascript' src='assets/content/themes/js/owl-carousel/owl.carousel.min77e6.js?ver=2.2.1' id='owl-carousel-js'></script>
<script type='text/javascript' src='assets/content/themes/js/meanmenu/jquery.meanmenu.mina7f4.js?ver=2.0.8' id='meanmenu-js'></script>
<script type='text/javascript' src='assets/content/themes/js/tether.min6f3e.js?ver=1.3.0' id='tether-js'></script>
<script type='text/javascript' src='assets/content/themes/js/bootstrap.mincce7.js?ver=4.0.0' id='bootstrap-js'></script>
<script type='text/javascript' src='assets/content/themes/js/jquery.nice-select.min5152.js?ver=1.0' id='nice-select-js'></script>
<script type='text/javascript' src='assets/content/themes/js/barrating/jquery.barrating.min1576.js?ver=1.2.1' id='bar-rating-js'></script>
<script type='text/javascript' src='assets/content/themes/js/magnific/jquery.magnific-popup.minf488.js?ver=1.1.0' id='magnific-popup-js'></script>
<script type='text/javascript' src='assets/includes/js/jquery/ui/core.min3f14.js?ver=1.13.2' id='jquery-ui-core-js'></script>
<script type='text/javascript' src='assets/includes/js/jquery/ui/datepicker.min3f14.js?ver=1.13.2' id='jquery-ui-datepicker-js'></script>
<script type='text/javascript' id='jquery-ui-datepicker-js-after'>
    jQuery(function(jQuery) {
        jQuery.datepicker.setDefaults({
            "closeText": "Close",
            "currentText": "Today",
            "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "monthNamesShort": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            "nextText": "Next",
            "prevText": "Previous",
            "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
            "dateFormat": "MM d, yy",
            "firstDay": 1,
            "isRTL": false
        });
    });
</script>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>


<script type='text/javascript' src='assets/content/themes/js/isotope.min7c45.js?ver=3.0.6' id='isotope-js'></script>
<script type='text/javascript' id='tourpress-js-extra'>
    /* <![CDATA[ */
    var localize = {
        "inspiry_sticky_header": ""
    };
    /* ]]> */
</script>
<script type='text/javascript' src='assets/content/themes/js/tourpress5a2c.js?ver=1.1.7' id='tourpress-js'></script>
<script type='text/javascript' id='tourpress-js-after'>
    if (jQuery().fakeLoader) {
        $ = jQuery;
        $(document).ready(function() {
            var loader = $('#site-loader'),
                style = loader.data('style'),
                bg = loader.data('bg'),
                icon = loader.data('icon');

            if (bg === undefined) {
                bg = '#004274';
            }

            $(loader).fakeLoader({
                // timeToHide : 1200,
                zIndex: '9999',
                spinner: style,
                bgColor: bg,
                imagePath: icon
            });
        });
    }
</script>

<script>
    let close = document.querySelector('.modal-close-button');

    close.addEventListener('click', (e) => {
        let modal = document.querySelector('.modal-container');

        modal.style.display = 'none';
        document.querySelector('body').style.overflow = 'auto';


    })

    // code for showing the modal if it is no shown before 
    if (getCookie("modalStatus") == "") {
        setTimeout(() => {
            let modal = document.querySelector('.modal-container');

            modal.style.display = 'flex';
            document.querySelector('body').style.overflow = 'hidden';
            setCookie("modalStatus", "true", 1);
        }, 2000)
    }


    // Function to get the value of a cookie by name
    function getCookie(cookieName) {
        var name = cookieName + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var cookieArray = decodedCookie.split(';');
        for (var i = 0; i < cookieArray.length; i++) {
            var cookie = cookieArray[i].trim();
            if (cookie.indexOf(name) == 0) {
                return cookie.substring(name.length, cookie.length);
            }
        }
        return "";
    }

    // Function to set a cookie
    function setCookie(cookieName, cookieValue, expirationDays) {
        var d = new Date();
        d.setTime(d.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
    }

    // Function to update a cookie by name
    function updateCookie(cookieName, newValue, expirationDays) {
        // Check if the cookie already exists
        if (getCookie(cookieName) !== "") {
            // If it exists, update its value
            setCookie(cookieName, newValue, expirationDays);
        } else {
            // If it doesn't exist, set a new cookie
            setCookie(cookieName, newValue, expirationDays);
        }
    }
</script>


<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->



</body>

</html>