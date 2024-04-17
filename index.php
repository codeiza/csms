<!doctype html>
<?php session_start(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>CSMS - I.F.I.P Official Website</title>

        <!-- CSS FILES --> 
        <link rel="icon" href="images/logo.png" type="image/x-icon">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezKsNsS5/jtUn9g7JQUG5Zl3cmUJmd+1iHRyxOu/rfK7I5LFA6xEMZZ8JZpxr6Vh" crossorigin="anonymous">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-topic-listing.css" rel="stylesheet">     
			<script src="./js/jquery-3.6.0.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <style>
    .elementor-heading-title {
        text-align: center;
        margin-bottom: 20px; /* Adjust as needed */
    }

    .tafe-table {
        width: 70%;
        margin: 0 auto; /* Center the table */
        border-collapse: collapse;
    }

    .tafe-table-header th {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px;
        text-align: center;
        font-weight: bold;
        border-bottom: 2px solid #2E8B57;
    }

    .tafe-table-body td {
        border: 1px solid #4CAF50;
        padding: 10px;
        text-align: center;
    }

    .tafe-table-body tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tafe-table-body tr:hover {
        background-color: #d9ead3;
    }
    .alert-biller-reminder {
            word-wrap: break-word;
        }

        .text-reminder {
            font-weight: bold;
        }

        .reminder-icon {
            font-size: 24px;
            color: gold;
            margin-right: 10px;
        }

        .reminder-title {
            font-size: 12px;
            font-weight: bold;
            color: black; /* Set the desired color for the title */
        }

        .reminder-note {
            font-size: 10px; 
            text-align: justify; 
        }
</style>
    
    <body id="top">

        <main>

            <nav class="navbar navbar-expand-lg">
                <div class="container">
                <a class="navbar-brand" href="index.php">
					<img src="images/logo.png" height="60" alt="CSMS Logo">
                        <span>CSMS</span>
                    </a>

                    <div class="d-lg-none ms-auto me-6">
                        <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                    </div>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
   
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-5 me-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_1">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_2">Services</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_3">FAQs</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_4">How it works</a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_5">Contact us</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="aboutus.php">About Us</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="feedback.php">Feedback</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="donation.php">Donation</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            

            <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">
                            <h1 class="text-white text-center">IGLESIA FILIPINA INDEPENDIENTE PARISH</h1>

                            <h6 class="text-center">CHURCH SERVICE MANAGEMENT SYSTEM</h6>

                           
                        </div>

                    </div>
                </div>
            </section>


            <section class="featured-section">
                <div class="container">
                    <div class="row justify-content-center">
			
				<div class="col-lg-6 col-12"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<div class="row">
				<div class="btn-group">
				<?php if(isset($_SESSION['user'])){ ?>
				<button class="btn btn-danger" onclick="window.location.href='logout.php'" >Logout</button>
			<?php	}else{ ?>
						<button class="btn btn-success" id="log">Login</button>
						<?php  } ?>
						<button class="btn btn-warning" id="sign">Sign Up</button>
				</div>		
				</div>		
				</div>
                        <div class="col-lg-6 col-12">
						
                            <div class="custom-block custom-block-overlay">
                                <div class="d-flex flex-column h-100">
                                    <img src="images/businesswoman-using-tablet-analysis.jpg" class="custom-block-image img-fluid" alt="">

                                    <div class="custom-block-overlay-text d-flex">
                                        <div>
                                            <h5 class="text-white mb-2">I.F.I.P.</h5>

                                            <p style="color: #FEFFFF; text-align: justify; font-family: Tahoma, Geneva, sans-serif ;">The Iglesia Filipina Independiente Parish is a religious institution that is located in the town of 238 Natividad Brgy. Rd. 
                                                Guagua, which is situated in the province of Pampanga in the Philippines.The church is known to be the oldest standing church in the entire province of Pampanga.</p>
                                        </div>
                                    </div>
                                    <div class="section-overlay"></div>
                                </div>
                            </div>
                        </div>
<!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "118490321167188");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v18.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
                    </div>
                </div>
            </section>


            <section class="explore-section section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-12 text-center">
                            <h2 class="mb-4">SERVICES OFFERED</h1>
                        </div>

                    </div>
                </div>


                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="design-tab-pane" role="tabpanel" aria-labelledby="design-tab" tabindex="0">
                                    <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                            <div class="custom-block bg-white shadow-lg">
                                                <a href="client_dash_board.php">
                                                    <div class="d-flex">
                                                    <div style="color: #FEFFFF; text-align: justify; font-family: Tahoma, Geneva, sans-serif; ">>
                                                            <h5 class="mb-2">Baptismal</h5>
                                                            <p class="mb-0">
                                                            <style="color: #FEFFFF; text-align: justify; font-family: Tahoma, Geneva, sans-serif ;text-indent: 20px;">

                                                                A Christian sacrament or ritual involving the application of water to a person’s Head or body, symbolizing purification, renewal, and admission
																into the Christian church. 
															</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                            <div class="custom-block bg-white shadow-lg">
                                                <a href="client_dash_board.php">
                                                    <div class="d-flex">
                                                    <div style="color: #FEFFFF; text-align: justify; font-family: Tahoma, Geneva, sans-serif; ">
                                                            <h5 class="mb-2">Wedding</h5>

                                                                <p class="mb-0">
                                                                    A wedding is a formal ceremony where two people publicly declare
                                                                    their love and commitment to each other, often followed by a reception to
                                                                    celebrate the occasion with family and friends. 
																</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="custom-block bg-white shadow-lg">
                                                <a href="client_dash_board.php">
                                                    <div class="d-flex">
                                                    <div style="color: #FEFFFF; text-align: justify; font-family: Tahoma, Geneva, sans-serif; ">>
                                                            <h5 class="mb-2">Mass</h5>

                                                                <p class="mb-0">
                                                                    A religious service in Christian traditions, especially in the Catholic Church, involving prayers, readings, and the consecration of bread and wine. 
																</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

              <!--                  <div class="tab-pane fade" id="marketing-tab-pane" role="tabpanel" aria-labelledby="marketing-tab" tabindex="0">--->
			  <br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-3">
                                                <div class="custom-block bg-white shadow-lg">
                                                    <a href="client_dash_board.php">
                                                        <div class="d-flex">
                                                        <div style="color: #FEFFFF; text-align: justify; font-family: Tahoma, Geneva, sans-serif; ">>
                                                                <h5 class="mb-2">Funeral</h5>

                                                                <p class="mb-0">
                                                                A ceremony or service held to honor and remember a person who has died, often involving religious or cultural traditions.																</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-3">
                                                <div class="custom-block bg-white shadow-lg">
                                                    <a href="client_dash_board.php">
                                                        <div class="d-flex">
                                                        <div style="color: #FEFFFF; text-align: justify; font-family: Tahoma, Geneva, sans-serif; ">>
                                                                <h5 class="mb-2">Blessing</h5>

                                                                <p class="mb-0">
																A prayer or ritual expressing good wishes and protection, often performed by religious leaders or figures to invoke divine favor upon individuals, objects, or events.
																</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                            
                            </div>

                    </div>
                </div>
            </section>



            <section class="hero-section d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">
                            <h2 class="text-black text-center">SCHEDULES OF SERVICES</h2>
                        </div> 
                        <div class="elementor-element elementor-element-564b98e elementor-widget elementor-widget-heading" data-id="564b98e" data-element_type="widget" data-widget_type="heading.default">
</div>
<br><br>
<div class="elementor-element elementor-element-170368a elementor-widget elementor-widget-Table" data-id="170368a" data-element_type="widget" data-widget_type="Table.default">
    <div class="elementor-widget-container">
        <table class="tafe-table">
            <thead class="tafe-table-header">
                <tr>
                    <th>Event</th>
                    <th>Schedule</th>
                </tr>
            </thead>
            <tbody class="tafe-table-body">
                <tr>
                    <td>Baptismal</td>
                    <td>Mon/Tues/Wed/Thursday/Fri/Sat<br>
                    (7:00 AM - 5:00 PM) <br><br>
                    Sunday <br>
                     (7:00 AM - 5:00 PM)</td>
                </tr>
                <tr>
                    <td>Funeral</td>
                    <td>Monday - Sunday <br>
                        (6:00 AM - 5:00 PM)<br><br>
                        Anytime except monday and regular mass
                    as long as there is a reservation.</td>
                </tr>
                <tr>
                    <td>Wedding</td>
                    <td>Any day of the week, just one in the
                    morning and one in the afternoon.</td>
                </tr>
                <tr>
                    <td>Regular Mass</td>
                    <td>Wednesday/Friday<br>
                    6:00 PM<br><br>
                    Sunday<br>
                    6:00 AM & 6:00 PM</td>
                </tr>

                <tr>
                    <td>Office Hours</td>
                    <td>Monday/Friday<br>
                    (6:00 AM - 6:00 PM)
                   </td>
                </tr>
               
               
               

                
            </tbody>
        </table> <br>
     
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group">
                    <div class="alert alert-info alert-biller-reminder">
                        <h4 class="text-info text-reminder"><i class="fa fa-bell reminder-icon" aria-hidden="true"></i> IMPORTANT REMINDERS</h4>
                        <div class="reminder-title">Note: For all services, any time of the day, you can schedule on our website, as long as it
        does not coincide with the regular mass. </div>
                        <div class="reminder-note">
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
                    </div>
                </div>
            </section>



            <section class="faq-section section-padding" id="section_3">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <h2 class="mb-4">FREQUENTLY ASKED QUESTIONS (FAQs)</h2>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-lg-5 col-12">
                            <img src="images/faq_graphic.jpg" class="img-fluid" alt="FAQs">
                        </div>

                        <div class="col-lg-6 col-12 m-auto">
    <div class="accordion" id="accordionExample">

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    How can I make a donation to Iglesia Filipina Independiente Parish?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    You can make a donation through our system by selecting the "Donation" option and choosing the amount you wish to donate. We accept various payment methods for your convenience.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    What services can I request through the Church Service Management System?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    You can request the following services: <br>
                    - Baptism<br>
                    - Wedding<br>
                    - Funeral<br>
                    - Mass<br>
                    - Blessing<br>
                    Simply select the service you need, fill in the necessary details, and submit your request.
                </div>
            </div>
        </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        How can I request a certificate for events like weddings and baptisms?
                                    </button>
                                    </h2>

                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            You can request certificates for these events through our system. Simply navigate to the "Request Documents" section, choose the type of certificate you need, provide the required information, and submit your request. We will process your request and make the certificate available to you.
                                        </div>
                                    </div>
                                </div>
								<div class="accordion-item">
                                    <h2 class="accordion-header" id="headingfour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                        What online payment methods do you accept, and how do I complete the payment process?
                                    </button>
                                    </h2>

                                    <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            We accept various online payment methods, including GCash, Maya, and traditional bank transfers. To make a payment, the admin will give you the amount of payment you will make, and it will email you to make the payment. Please ensure you upload your payment confirmation, and after you upload your payment, just wait for your email for confirmation, and we will verify the payment.
                                        </div>
                                    </div>
                                </div>
								<div class="accordion-item">
                                    <h2 class="accordion-header" id="heading5">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        How long does it take to process payments made through the Church Service Management System?
                                    </button>
                                    </h2>

                                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                          Payment processing times may vary depending on the payment method used. Typically, payments are verified within 1-2 business days. Once the payment is confirmed, your request will be processed accordingly.
                                        </div>
                                    </div>
                                </div>
								<div class="accordion-item">
                                    <h2 class="accordion-header" id="heading6">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                       What should I do if I encounter issues with the payment process?
                                    </button>
                                    </h2>

                                    <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                          If you encounter any issues while making a payment, please send us a message through our chatbot and send us a message, or you can email us at iglesiafilipinaparish@gmail.com. You can also find our contact information on the website, and we'll be happy to help you resolve any payment-related concerns.
                                        </div>
                                    </div>
                                </div>
								<div class="accordion-item">
                                    <h2 class="accordion-header" id="heading7">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                       How do I navigate the Church Service Management System?
                                    </button>
                                    </h2>

                                    <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                          To navigate the system, simply use the menu options provided on the website. You can access services, certificates, donations, and payment functions through the user-friendly interface. If you need assistance, refer to our user guide or contact our support team.
                                        </div>
                                    </div>
                                </div>
								<div class="accordion-item">
                                    <h2 class="accordion-header" id="heading8">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                       How can I get in touch with the Iglesia Filipina Independiente Parish for additional support or inquiries?
                                    </button>
                                    </h2>

                                    <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                         If you have any further questions or require support, please feel free to contact us through the provided contact information on our website. Our dedicated team is here to assist you with any concerns or inquiries you may have.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="timeline-section section-padding" id="section_4">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-12 text-center">
                            <h2 class="text-black mb-4">HOW DOES IT WORK?</h1>
                        </div>

                        <div class="col-lg-10 col-12 mx-auto">
                            <div class="timeline-container">
                                <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
                                    <div class="list-progress">
                                        <div class="inner"></div>
                                    </div>

                                    <li>
                                        <h4 class="text-white mb-3">Go to the dashboard or click on the services offered</h4>
                                        <p class="text-white">
                                            To use our services, you have to create an account, or you can click signup to register your account. After the registration, 
                                            to successfully create your account, you must first verify the email address you entered in your registration earlier.
										</p>

                                        <div class="icon-holder">
                                          <i class="bi-search"></i>
                                        </div>
                                    </li>
                                    
                                    <li>
                                        <h4 class="text-white mb-3">Fill out the form</h4>

                                        <p class="text-white">
										Fill out the form and submit it.
										</p>

                                        <div class="icon-holder">
                                          <i class="bi bi-card-text"></i>
                                        </div>
                                    </li>

                                    <li>
                                        <h4 class="text-white mb-3">Email confirmation</h4>

                                        <p class="text-white">
                                        Wait for the church's email confirmation and then follow the instructions in the email.
										</p>

                                        <div class="icon-holder">
                                          <i class="bi bi-envelope"></i>
                                        </div>
                                    </li>
									<li>
                                        <h4 class="text-white mb-3">Take note for the event schedule</h4>

                                        <p class="text-white">
                                        Take note of the event schedule sent via email, and arrive on time. </p>

                                        <div class="icon-holder">
                                          <i class="bi bi-calendar-event"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="contact-section section-padding section-bg" id="section_5">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-5">GET IN TOUCH</h2>
                        </div>

                        <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                        <h5 style="color: #676565; font-family:Tahoma, Geneva, sans-serif; font-size: 20px;" class="mb-2">Parish Location</h5><br>
                        <div class="col-lg-5 col-12 mb-4 mb-lg-0 text-center">
    <iframe class="google-map" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d661.9033194191442!2d120.58925300458752!3d14.992326242270797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sZai%20238%20Natividad%20Barangay%20Rd.!5e0!3m2!1sen!2sph!4v1696919855683!5m2!1sen!2sph" width="800" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3 mb-lg- mb-md-0 ms-auto">
                        <h5 style="color: #676565; font-family:Tahoma, Geneva, sans-serif; font-size: 20px;" class="mb-2">238 Natividad Barangay Rd Natividad Guagua, Pampanga</h5>

                            <hr>

                            <p class="d-flex align-items-center mb-1">
                            <h5 style="color: #000000; font-family:Tahoma, Geneva, sans-serif; font-size: 18px;" class="mb-2">Mobile Number:</h5>

                                <a href="tel: 305-240-9671" class="site-footer-link">
                                    09222525848
                                </a>
                            </p>

                            <p class="d-flex align-items-center">
                            <h5 style="color: #0016F4; font-family:Tahoma, Geneva, sans-serif; font-size: 18px;" class="mb-2">Facebook:</h5>
                            <h5 style="color: #676565; font-family:Tahoma, Geneva, sans-serif; font-size: 12px;" class="mb-2">Iglesia Filipina Independiente Parish</h5>
                                <a href="https://www.facebook.com/iglesiafilipinaparish" class="site-footer-link">
                                https://www.facebook.com/iglesiafilipinaparish 
                                </a>
                            </p>

                            <p class="d-flex align-items-center">
                            <h5 style="color: #F74747; font-family:Tahoma, Geneva, sans-serif; font-size: 18px;" class="mb-2">Email Address:</h5>
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=iglesiafilipinaparish@gmail.com" class="site-footer-link">
                                iglesiafilipinaparish@gmail.com
                                </a>
                            </p>
                    


                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-12 mb-4 pb-2">
                <a class="navbar-brand mb-2" href="index.php">
                    <img src="images/logo.png" height="60" alt="CSMS Logo">
                    <span class="site-title">CSMS</span>
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <h6 class="site-footer-title mb-3">RESOURCES</h6>

                <ul class="site-footer-links">
                    <li class="site-footer-link-item">
                        <a href="" class="site-footer-link">Home</a>
                    </li>
                    <li class="site-footer-link-item">
                        <a href="" class="site-footer-link">Services</a>
                    </li>

                    <li class="site-footer-link-item">
                        <a href="" class="site-footer-link">How does it work</a>
                    </li>

                    <li class="site-footer-link-item">
                        <a href="" class="site-footer-link">FAQs</a>
                    </li>

                    <li class="site-footer-link-item">
                        <a href="" class="site-footer-link">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                <h6 class="site-footer-title mb-3">INFORMATION</h6>

                <p class="text-white mb-1">
                    <a href="tel:00-00-000" class="site-footer-link">09222525848</a>
                </p>

                <p class="text-white">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=iglesiafilipinaparish@gmail.com" class="site-footer-link">iglesiafilipinaparish@gmail.com</a>
                </p>
            </div>

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                <div class="d-flex flex-column align-items-start">
                    <p class="copyright-text mb-4">
                        Copyright © 2023 CSMS. All Rights Reserved.
                    </p>
                    <p class="design-by-text mb-0">
                        Developed by: <a href="#" class="designer-link">WHY-PIE</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</footer>

		<script>
		$(document).ready(function(){
			$(document).on('click','#log',function(){
				window.location.href = "login.php";
				
			})
			$(document).on('click','#sign',function(){
				window.location.href = "signup.php";
				
			})
			})
		</script>

        <!-- JAVASCRIPT FILES -->
		
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
