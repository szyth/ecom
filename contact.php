<?php require('includes/header.inc.php'); ?>


<section>
    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12">
                        <div class="breadcrumb_wrapper">
                            <a href="index.html" class="breadcrumb">Home</a>
                            <a href="login.html" class="breadcrumb">Contact</a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="media/parallax/2.jpg" alt="Unsplashed background img 2"></div>
    </div>
</section>

<div class="row">
    <div class="col s12 m6 offset-m1 maps">
        <a href="https://onebigbit.com/"> <img src="media/map/obb_map.PNG" alt=""></a>
    </div>
    <div class="col s12 m4">
        <div class="address">
            <div class="address__icon">
                <i class="material-icons prefix">place</i>

            </div>
            <div class="address__details">
                <h2 class="ct__title">our address</h2>
                <p>C-25, Aliganj, Lucknow, Uttar Pradesh, India. </p>
            </div>
        </div>

        <div class="address">
            <div class="address__icon">
                <i class="material-icons">phone</i>
            </div>
            <div class="address__details">
                <h2 class="ct__title">Phone Number</h2>
                <p>+91-522-431-6496</p>
            </div>
        </div>
        <div class="address">
            <div class="address__icon">
                <i class="material-icons prefix">build</i>
            </div>
            <div class="address__details">
                <h2 class="ct__title">customer support</h2>
                <p>24x7</p>
            </div>
        </div>

    </div>
</div>
</div>


<div id="" class="row">
    <div class="col s12 m10  offset-m1">
        <div class="card contact_card_custom">
            <div class="card-content white-text">
                <span class="card-title">Contact Us</span>
                <div class="row">
                    <form class="col s12">
                        <div class="row">
                            <div class="input-field col s12 m4">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="name" type="text" class="validate white-text">
                                <span class="field_error" id="name_error"></span>
                                <label for="name">Name</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <i class="material-icons prefix">mail</i>
                                <input id="email" type="email" class="validate white-text">
                                <span class="field_error" id="email_error"></span>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <i class="material-icons prefix">phone</i>
                                <input id="mobile" type="tel" class="validate white-text">
                                <span class="field_error" id="mobile_error"></span>
                                <label for="mobile">Telephone</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">chat</i>
                                <textarea id="comment" class="materialize-textarea white-text"></textarea>
                                <span class="field_error" id="comment_error"></span>
                                <label for="comment">Your Message</label>
                            </div>
                        </div>
                        <a id="contact_submit_button" onclick="send_message()" class="waves-effect waves-light btn-large  btn-flat center">Send
                            Message</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<section>
    <svg class="curve" data-name="layer" viewBox="0 0 1416.9 174.01">
        <path d="M0,220.8S283.66,120,608.94,163.56s437.93,100.57,818,10.34V309.54H0V280.8Z" transform="translate(0 -120.53)" />

    </svg>
</section>


<?php require('includes/footer.inc.php'); ?>