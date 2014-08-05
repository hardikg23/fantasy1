<?php
     include 'Header.php';
     include 'PHP/includes/database_connectivity_includes.php';
     @session_start();
    if(isset ($_SESSION['username']) && isset ($_SESSION['email'])&&isset ($_SESSION['password'])) {
		if(!empty ($_SESSION['username']))
			$session_username= $_SESSION['username'];
		if(!empty ($_SESSION['email']))
			$session_email= $_SESSION['email'];
		if(!empty ($_SESSION['password']))
			$session_password= $_SESSION['password'];
	}
        include 'PHP/includes/seriedId_setter.php';

?>

<html>
<head>
	<title>Home</title>
        <!--
                <link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/login.css">
        -->
            <link rel="stylesheet" type="text/css" href="css/T&C.css">
</head>
<body>
    <div class="filler box-shadow-comman" style="position: absolute;width: 1000px;height: 35px;left: 176px;top: 150px;background-color: white">
    </div>

    <div class="main-body-container box-shadow-comman" style="position: absolute;width: 1000px;height: 1000px;left: 176px;top: 170px;background-color: white">
            <!-- LOGIN and LOGOUT ---------------------------------------------------------------------------------------->
        <?php
                include 'PHP/includes/login_and_logout_file_include.php';
        ?>
        <!----------------------------------------------------------------------------------------------------------->



         <!-- MAIN MENU ------------------------------------------------------------------------------------------------>
        <div style="position: absolute;left: 0px;top:40px;width:1000px;height: 30px;">
        <?php
                include 'PHP/includes/main_mune_finder_and _display.php';
         ?>
        </div>
        <!--------------------------------------------------------------------------------------------------------------->



         <!-- SUBMENU --------------------------------------------------------------------------------------------------->
         <?php
                include 'PHP/includes/sub_menu_display.php';
         ?>
         <!------------------------------------------------------------------------------------------------------------->

         <!------ T&C ---------------------------------------------------------------------------------------------------->
         <div style="position: absolute;top: 125px;left: 20px;font-size: 21px;font-weight: bold;width: 100%;">
                    TERMS & CONDITION
          </div>
         <div  style="position: absolute;width: 950px;height: 800px;left: 25px;top: 160px;overflow: auto;">
             
             <br>
             <div class="TC-header">
                 INTRODUCTION
             </div>
             <div class="TC-content">
                 <ul>
                     <li>These terms and conditions shall govern your use of our website.</li>
                     <li>By using our website, you accept these terms and conditions in full; accordingly, if you disagree with these terms and conditions or any part of these terms and conditions, you must not use our website.</li>
                     <li> If you register with our website, submit any material to our website or use any of our website services, we will ask you to expressly agree to these terms and conditions.</li>
                     <li>You must be at least [18] years of age to use our website; and by using our website or agreeing to these terms and conditions, you warrant and represent to us that you are at least [18] years of age.</li>
                     <li>Our website uses cookies; by using our website or agreeing to these terms and conditions, you consent to our use of cookies in accordance with the terms of our [privacy and cookies policy].</li>
                 </ul>
            </div>

             <a href="#" name="copy&tread"></a>
            <div class="TC-header">
                 COPYRIGHTS & TRADEMARKS
            </div>
             <div class="TC-content">
                 The trademarks, names, logos, images, assets and service marks displayed on this
                 website are registered and unregistered trademarks of the website owner.
                 Nothing contained on this website should be construed as granting any license or right
                 to use any trademark without the prior written permission of the website owner.
                 The written content displayed on this website is owned by its respective author and may not
                 be reproduced in whole, or in part, without the express written permission of the author.
                 We have full right’s to decide who is to be awarded as the winner for any competition going
                 on the fantasycricleague.com Our decision will be final and is only revocable by us.
            </div>

                 <a href="#" name="privacypolicy"></a>
              <div class="TC-header">
                PRIVACY POLICY
             </div>
             <div class="TC-content">
                <ul>
                    <li>
                        We may collect, store and use the following kinds of personal information: 
                        <ol>
                            <li>information about your computer and about your visits to and use of this website.</li>
                            <li>your IP address</li>
                            <li>browser type and version</li>
                            <li>length of visit</li>
                            <li>page views and website navigation paths</li>
                        </ol>
                    </li>
                     <li>
                         information that you provide to us when registering with our website including [your email address].
                     </li>
                    <li>
                        information that you provide when completing your profile on our website.
                        <ol>
                            <li>your name</li>
                            <li>profile pictures</li>
                            <li>gender</li>
                        </ol>
                    </li>
                    
                    <li>
                        information contained in or relating to any communications that you send to us or send through our website including the communication content and meta data associated with the communication.
                    </li>
                    <li>
                        Any other personal information that you choose to send to us
                    </li> 
                    <li>
                        Before you disclose to us the personal information of another person, you must obtain that person's consent to both the disclosure and the processing of that personal information in accordance with this policy.
                    `</li>
                    <li>
                        COOKIES   <br>          
                        A cookie is a small file sent by a web server to a web browser, which enables the server to collect information from the web browser.
                    </li>
                          


                </ul>
             </div>


                <a href="#" name="licenceofuse"></a>
             <div class="TC-header">
                LICENCE TO USE WEBSITE
             </div>
             <div class="TC-content">
                 <ul>
                     <li>You may:
                         <ol>
                             <li>view pages from our website in a web browser;</li>
                             <li>download pages from our website for caching in a web browser;</li>
                             <li>print pages from our website;</li>
                         </ol>
                     </li>
                     <li>Except as expressly permitted by these terms and conditions, you must not edit or otherwise modify any material on our website.</li>
                     <li>Unless you own or control the relevant rights in the material, you must not:
                        <ol>
                             <li>republish material from our website (including republication on another website);</li>
                             <li>sell, rent or sub-license material from our website;</li>
                             <li>show any material from our website in public;</li>
                             <li>exploit material from our website for a commercial purpose;</li>
                             <li>redistribute material from our website.</li>
                        </ol>
                     </li>
                     <li>We reserve the right to restrict access to areas of our website, or indeed our whole website, at our discretion; you must not circumvent or bypass, or attempt to circumvent or bypass, any access restriction measures on our website.</li>
                 </ul>
            </div>

                  <a href="#" name="acceptableuse"></a>
             <div class="TC-header">
                ACCEPTABLE USE
             </div>
             <div class="TC-content">
                <ul>
                     <li>You must not:
                         <ol>
                             <li>use our website in any way or take any action that causes, or may cause,
                                 damage to the website or impairment of the performance,
                                 availability or accessibility of the website;
                             </li>
                             <li>use our website in any way that is unlawful, illegal,
                                 fraudulent or harmful, or in connection with any unlawful,
                                 illegal, fraudulent or harmful purpose or activity;
                             </li>
                             <li>use our website to copy, store, host, transmit, send, use, 
                                 publish or distribute any material which consists of (or is linked to) any spyware, 
                                 computer virus, Trojan horse, worm, keystroke logger, 
                                 rootkit or other malicious computer software;
                             </li>
                             <li>conduct any systematic or automated data collection activities (including without limitation scraping,
                                 data mining, data extraction and data harvesting)
                                 on or in relation to our website without our express written consent;
                             </li>
                             <li>[access or otherwise interact with our website using any robot, spider or other automated means;]
                             </li>
                             <li>[use data collected from our website for any direct marketing activity
                                 (including without limitation email marketing, SMS marketing, telemarketing and direct mailing).]
                             </li>
                         </ol>
                     </li>
                     <li>You must not use data collected from our website to contact individuals, companies or other persons or entities.</li>
                     <li>You must ensure that all the information you supply to us through our website, or in relation to our website, is [true, accurate, current, complete and non-misleading].
                     </li>
                </ul>
             </div>






              <a href="#" name="regandacc"></a>
              <div class="TC-header">
                REGISTRATION & ACCOUNTS
             </div>
            <div class="TC-content">
                <ul>
                    <li>
                To be eligible for an individual account on our website, you must be at least 18 years of age.
                    </li>
                    <li>
                       You may register for an account with our website by completing and submitting the account registration form on our website, and clicking on the verification link in the email that the website will send to you.
                    </li>
                    <li>
                    You must notify us in writing immediately if you become aware of any unauthorised use of your account.
                    </li>
                    <li>
                    You must not use any other person's account to access the website, unless you have that person's express permission to do so.
                    </li>
                </ul>
             </div>

              <a href="#" name="emailandpass"></a>
             <a href="#"></a>
              <div class="TC-header">
                EMAIL ADDRESS & PASSWORDS
             </div>

             <div class="TC-content">
                <ul>
                    <li>
                       If you register for an account with our website, you will be asked to choose a valid Email Address and password.
                    </li>
                    <li>
                        You must keep your password confidential.
                    </li>
                    
                    <li>
                        You must notify us immediately if you become aware of any disclosure of your password.
                    </li>
                    <li>
                        You are responsible for any activity on our website arising out of any failure to keep your password confidential, and may be held liable for any losses arising out of such a failure.
                    </li>                 
                </ul>
             </div>

             <a href="#" name="canandsusp"></a>
              <div class="TC-header">
                     CANCELLATION & SUSPENSION OF ACCOUNT
             </div>

             <div class="TC-content">
               <ul>
                   <li>We may:
                        <ol>
                            <li>suspend your account</li>
                            <li>cancel your account</li>
                            <li>edit your account details</li>
                        </ol>
                        at any time in our sole discretion without notice or explanation.
                   </li>
                   <li>You may cancel your account on our website [using your account setting pafe on the website].</li>
               </ul>
            </div>

              <div class="TC-header">
                OUR DETALILS
             </div>

             <div class="TC-content">
                This website is owned and operated by fantasycricleague.com
             </div>


              <div class="TC-header">
                Credit
             </div>

             <div class="TC-content">
                 This document was created using a template from <a href="http://www.seqlegal.com" style="color: blue">SEQ Legal</a> (http://www.seqlegal.com).
             </div>






         </div>
         <!------------------------------------------------------------------------------------------------------------->








    </div>

    <div class="filler box-shadow-comman" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/make_All_page_responsive.js"></script>
	<script type="text/javascript" src="js/Home_login_details_validate.js"></script>
</body>
</html>


<?php
	include 'Footer.php';
?>