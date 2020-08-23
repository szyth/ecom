<?php require('includes/header.inc.php'); ?>


<section>
    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12">
                        <div class="breadcrumb_wrapper">
                            <a href="index.html" class="breadcrumb">Home</a>
                            <a href="login.html" class="breadcrumb">User Login</a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="media/parallax/2.jpg" alt="Unsplashed background img 2"></div>
    </div>




</section>


<div id="login" class="row">
    <!-- <a href="https://www.freepik.com/vectors/background">Background vector created by freepik - www.freepik.com</a> -->
    <!-- <img src="media/login/1.jpg" alt=""> -->
    <div class="col s12 m5 offset-m1 ">
        <h1 class="login-title">Welcome back</h1>
        <p class="login-body">To keep connected with us please Login with your information.</p>
    </div>

    <div class="col s12 m5">
        <div class="card login_card_custom">
            <div class="card-content white-text">
                <!-- LOGIN FORM -->
                <ul class="tabs">
                    <li class="tab col s6 "><a id="login_click" class="active" href="#login_form">Login</a></li>
                    <li class="tab col s6"><a id="register_click" href="#signup_form">Register</a></li>
                </ul>
                <form id="login_form">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mail</i>
                            <input id="login_email" type="email" class="validate white-text">
                            <label for="login_email">Email</label>
                            <span class="helper-text" data-error="Incorrect Email ID" data-success="right"></span>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input id="login_password" type="password" class="validate white-text">
                            <label for="login_password">Password</label>
                        </div>
                    </div>
                    <a id="submit_login_button" class="waves-effect waves-light btn-large  btn-flat center">Login</a>

                </form>
                <form id="signup_form">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="signup-name" type="text" class="validate white-text">
                            <label for="signup-name">Name</label>
                        </div>
                        <div class="input-field col s12 m6 ">
                            <i class="material-icons prefix">mail</i>
                            <input id="email" type="email" class="validate white-text">
                            <label for="email">Email</label>
                            <span class="helper-text" data-error="Incorrect Email ID" data-success="right"></span>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">phone</i>
                            <input id="mobile" type="number" class="validate white-text">
                            <label for="mobile">Mobile No.</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input id="password" type="password" class="validate white-text">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <a id="submit_signup_button" class="waves-effect waves-light btn-large btn-flat center">Sign
                        Up</a>

                </form>
            </div>
        </div>
    </div>

</div>





<section style="background-color: rgb(255, 255, 255);">
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>




<?php require('includes/footer.inc.php'); ?>