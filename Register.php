<?php

        session_start();
        include 'PHP/includes/seriedId_setter.php';
	include 'Header.php';
?>
<html>
    <head>
            <title>Register</title>
                <link rel="stylesheet" type="text/css" href="css/Register.css">
    </head>
    <body>
        <div class="filler box-shadow-comman" style="position: absolute;width: 1000px;height: 35px;left: 176px;top: 150px;background-color: white">
        </div>
        <div  class="main-body-container box-shadow-comman" style="position: absolute;width: 1000px;height: 1000px;left: 183px;top: 175px;background-color: white">
            <div  style="position: absolute;left: 30px;top: -5px;">
            <font color="OLIVEDRAB"><h1>Make Your Profile</h1></font>
            <h6><font color="OLIVEDRAB">(* Denotes Required Fields)</font><br></h6>
            </div>
            <table class="tablecss font-containt" style="position: absolute;left: 40px;top: 40px;width:600px;height: 850px;" cellpadding=2>
		                                      
                <tr >
                    <td width="42%">
                        <b><h4>USER NAME*</h4></b>
                    </td>
                    <td>
                        <table><tr><td>
                        <input type="text" placeholder="User Name" id="user_name" name="user_name" onBlur="validateUserName()" maxlength="18">
                        <td>
                        <td><div style="font-size: 11px;color:red" id="user_name_status"></div></td>  </tr></table>
                    </td>
                    
                </tr>
                <tr><td></td><td></td></tr>

                <tr>
                    <td width="42%">
                        <b><h4>FIRST NAME*</h4></b>
                    </td>
                    <td>
                        <input type="text" placeholder="First Name" id="first_name" name="first_name" onBlur="validateFirstName()" maxlength="10">
                    </td>
                </tr>
                <tr><td></td><td></td></tr>

                <tr>
                    <td width="42%">
                        <b><h4>LAST NAME*</h4></b>
                    </td>
                    <td>
                        <input type="text" placeholder="Last Name" id="last_name" name="last_name" onBlur="validateLastName()" maxlength="10">
                    </td>
                </tr>
                <tr><td></td><td></td></tr>

                <tr>
                    <td width="42%" >
                        <b><h4>GENDER*</h4></b>
                    </td>
                    <td valign="top">
                        <input type="radio" id="gender_name" name="gender_name" value="Male" checked/>&nbsp;&nbsp;<font size="3">Male</font>
                        &nbsp;&nbsp;&nbsp;
                        <input type="radio" id="gender_name" name="gender_name" value="Female"/>&nbsp;&nbsp;<font size="3">Female</font>
                    </td>
                </tr>
                <tr><td></td><td></td></tr>




                <tr>
                    <td width="42%">
                        <b><h4>EMAIL ADDRESS*</h4></b>
                    </td>
                    <td>
                        <table><tr><td>
                        <input type="text"  id="user_email" placeholder="Email" name="user_email" onBlur="validateEmail()" maxlength="40">
                       </td>
                       <td><div style="font-size: 11px;color:red" id="user_email_status"></div></td>  </tr></table>
                    </td>
                </tr>

                
                <tr>
                    <td></td>
                    <td>
                        
                            <p style="display:none;font-size: 9px;color:red" id="wrongEmailError">
                                FORMATE OF EMAIL ADDRESS IS NOT PROPER
                            </p>
                        
                    </td>
                </tr>



                <tr>
                    <td width="42%">
                        <b><h4>CONFIRM EMAIL ADDRESS*</h4></b>
                    </td>
                    <td>
                        <input type="text" id="user_co_email" placeholder="ConfirmEmail" name="user_co_email" onBlur="validateConfirmEmail()" maxlength="40">
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        
                            <p style="display:none;font-size: 9px;color:red" id="confirmEmailError">
                                YOUR EMAIL and CONFIRM EMAIL ADDRESS DOES NOT MATCH!
                            </p>
                       
                    </td>
                </tr>


                <tr>
                    <td width="42%">
                        <h4><b>PASSWORD</b></h4><h6>(Minimum 8 Characters)*</h6>
                    </td>
                    <td>
                        <input type="password" id="user_password" placeholder="Password" name="user_password" onBlur="validatePassword()" maxlength="50">
                    </td>
                </tr>

                
                <tr>
                    <td></td>
                    <td>
                        
                            <p style="display:none;font-size: 9px;color:red" id="passwordError">
                                MINIMUM 8 CHARACTERS!</p>
                       
                    </td>
                </tr>



                <tr>
                    <td width="42%">
                        <b><h4>RE-ENTER PASSWORD*</h4></b>
                    </td>
                    <td>
                        <input type="password" placeholder="ConfirmPassword" id="user_co_password" name="user_co_password" onBlur="validateConfirmPassword()" maxlength="50">
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        
                            <p style="display:none;font-size: 9px;color:red" id="confirmpasswordUnmatchError">
                                PASSWORD DOES NOT MATCH!
                            </p>
                       
                    </td>
                </tr>







                <tr>
                    <td width="42%">
                        <b><h4><br>COUNTRY*</h4></b>
                    </td>
                    <td >
                        <select style="width: 150px;" name="country" id="country" id="country" onChange="validateCountry()" data-content="Enter your country">
                            <option selected="selected" value="-1">Select a Country</option>
                            <option value="1">Afghanistan</option>
                            <option value="267">Aland Islands</option>
                            <option value="2">Albania</option>
                            <option value="3">Algeria</option>
                            <option value="4">American Samoa</option>
                            <option value="5">Andorra</option>
                            <option value="6">Angola</option>
                            <option value="7">Anguilla</option>
                            <option value="8">Antarctica</option>
                            <option value="9">Antigua and Barbuda</option>
                            <option value="10">Argentina</option>
                            <option value="11">Armenia</option>
                            <option value="12">Aruba</option>
                            <option value="13">Australia</option>
                            <option value="14">Austria</option>
                            <option value="15">Azerbaijan</option>
                            <option value="16">Bahamas</option>
                            <option value="17">Bahrain</option>
                            <option value="18">Bangladesh</option>
                            <option value="19">Barbados</option>
                            <option value="20">Belarus</option>
                            <option value="21">Belgium</option>
                            <option value="22">Belize</option>
                            <option value="23">Benin</option>
                            <option value="24">Bermuda</option>
                            <option value="25">Bhutan</option>
                            <option value="26">Bolivia</option>
                            <option value="279">Bonaire, Saint Eustatius and Saba</option>
                            <option value="27">Bosnia-Herzegovina</option>
                            <option value="28">Botswana</option>
                            <option value="29">Bouvet Island</option>
                            <option value="30">Brazil</option>
                            <option value="31">British Indian Ocean Territory</option>
                            <option value="32">British Virgin Islands</option>
                            <option value="33">Brunei Darussalam</option>
                            <option value="34">Bulgaria</option>
                            <option value="35">Burkina Faso</option>
                            <option value="36">Burundi</option>
                            <option value="37">Cambodia</option>
                            <option value="38">Cameroon</option
                            ><option value="39">Canada</option>
                            <option value="40">Cape Verde</option>
                            <option value="41">Cayman Islands</option>
                            <option value="42">Central African Republic</option>
                            <option value="43">Chad</option>
                            <option value="44">Chile</option>
                            <option value="45">China</option>
                            <option value="46">Christmas Island</option>
                            <option value="47">Cocos Islands</option>
                            <option value="48">Colombia</option>
                            <option value="49">Comoros</option>
                            <option value="51">Congo</option>
                            <option value="50">Congo, Democratic Republic of</option>
                            <option value="52">Cook Islands</option>
                            <option value="53">Costa Rica</option>
                            <option value="97">Croatia</option>
                            <option value="55">Cuba</option>
                            <option value="281">Curacao</option>
                            <option value="56">Cyprus</option>
                            <option value="57">Czech Republic</option>
                            <option value="58">Denmark</option>
                            <option value="59">Djibouti</option>
                            <option value="60">Dominica</option>
                            <option value="61">Dominican Republic</option>
                            <option value="62">Ecuador</option>
                            <option value="63">Egypt</option>
                            <option value="64">El Salvador</option>
                            <option value="241">England</option>
                            <option value="65">Equatorial Guinea</option>
                            <option value="66">Eritrea</option>
                            <option value="67">Estonia</option>
                            <option value="68">Ethiopia</option>
                            <option value="69">Faeroe Islands</option>
                            <option value="70">Falkland Islands</option>
                            <option value="71">Fiji</option>
                            <option value="72">Finland</option>
                            <option value="73">France</option>
                            <option value="74">French Guiana</option>
                            <option value="75">French Polynesia</option>
                            <option value="76">French Southern Territories</option>
                            <option value="77">Gabon</option>
                            <option value="78">Gambia</option>
                            <option value="79">Georgia</option>
                            <option value="80">Germany</option>
                            <option value="81">Ghana</option>
                            <option value="82">Gibraltar</option>
                            <option value="83">Greece</option>
                            <option value="84">Greenland</option>
                            <option value="85">Grenada</option>
                            <option value="86">Guadaloupe</option>
                            <option value="87">Guam</option>
                            <option value="88">Guatemala</option>
                            <option value="271">Guernsey</option>
                            <option value="89">Guinea</option>
                            <option value="90">Guinea-Bissau</option>
                            <option value="91">Guyana</option>
                            <option value="92">Haiti</option>
                            <option value="93">Heard and McDonald Islands</option>
                            <option value="94">Holy See</option>
                            <option value="95">Honduras</option>
                            <option value="96">Hong Kong</option>
                            <option value="98">Hungary</option>
                            <option value="99">Iceland</option>
                            <option value="100">India</option>
                            <option value="101">Indonesia</option>
                            <option value="102">Iran</option>
                            <option value="103">Iraq</option>
                            <option value="104">Ireland</option>
                            <option value="273">Isle of Man</option>
                            <option value="105">Israel</option>
                            <option value="106">Italy</option>
                            <option value="54">Ivory Coast</option>
                            <option value="107">Jamaica</option>
                            <option value="108">Japan</option>
                            <option value="275">Jersey</option>
                            <option value="109">Jordan</option>
                            <option value="110">Kazakhstan</option>
                            <option value="111">Kenya</option>
                            <option value="112">Kiribati</option>
                            <option value="115">Kuwait</option>
                            <option value="116">Kyrgyzstan</option>
                            <option value="117">Laos</option>
                            <option value="118">Latvia</option>
                            <option value="119">Lebanon</option>
                            <option value="120">Lesotho</option>
                            <option value="121">Liberia</option>
                            <option value="122">Libya</option>
                            <option value="123">Liechtenstein</option>
                            <option value="124">Lithuania</option>
                            <option value="125">Luxembourg</option>
                            <option value="126">Macao</option>
                            <option value="127">Macedonia</option>
                            <option value="128">Madagascar</option>
                            <option value="129">Malawi</option>
                            <option value="130">Malaysia</option>
                            <option value="131">Maldives</option>
                            <option value="132">Mali</option>
                            <option value="133">Malta</option>
                            <option value="134">Marshall Islands</option>
                            <option value="135">Martinique</option>
                            <option value="136">Mauritania</option>
                            <option value="137">Mauritius</option>
                            <option value="138">Mayotte</option>
                            <option value="139">Mexico</option>
                            <option value="140">Micronesia</option>
                            <option value="141">Moldova</option>
                            <option value="142">Monaco</option>
                            <option value="143">Mongolia</option>
                            <option value="240">Montenegro</option>
                            <option value="144">Montserrat</option>
                            <option value="145">Morocco</option>
                            <option value="146">Mozambique</option>
                            <option value="147">Myanmar</option>
                            <option value="148">Namibia</option>
                            <option value="149">Nauru</option>
                            <option value="150">Nepal</option>
                            <option value="152">Netherlands</option>
                            <option value="153">New Caledonia</option>
                            <option value="154">New Zealand</option>
                            <option value="155">Nicaragua</option>
                            <option value="156">Niger</option>
                            <option value="157">Nigeria</option>
                            <option value="158">Niue</option>
                            <option value="159">Norfolk Island</option>
                            <option value="113">North Korea</option>
                            <option value="242">Northern Ireland</option>
                            <option value="160">Northern Mariana Islands</option>
                            <option value="161">Norway</option>
                            <option value="162">Oman</option>
                            <option value="163">Pakistan</option>
                            <option value="164">Palau</option>
                            <option value="165">Palestine</option>
                            <option value="166">Panama</option>
                            <option value="167">Papua New Guinea</option>
                            <option value="168">Paraguay</option>
                            <option value="169">Peru</option>
                            <option value="170">Philippines</option>
                            <option value="171">Pitcairn Island</option>
                            <option value="172">Poland</option>
                            <option value="173">Portugal</option>
                            <option value="174">Puerto Rico</option>
                            <option value="175">Qatar</option>
                            <option value="176">Reunion</option>
                            <option value="177">Romania</option>
                            <option value="178">Russia</option>
                            <option value="179">Rwanda</option>
                            <option value="269">Saint Barthelemy</option>
                            <option value="277">Saint Martin</option>
                            <option value="185">Samoa</option>
                            <option value="186">San Marino</option>
                            <option value="187">Sao Tome and Principe</option>
                            <option value="188">Saudi Arabia</option>
                            <option value="243">Scotland</option>
                            <option value="189">Senegal</option>
                            <option value="190">Serbia</option>
                            <option value="191">Seychelles</option>
                            <option value="192">Sierra Leone</option>
                            <option value="193">Singapore</option>
                            <option value="283">Sint Maarten</option>
                            <option value="194">Slovakia</option>
                            <option value="195">Slovenia</option>
                            <option value="196">Solomon Islands</option>
                            <option value="197">Somalia</option>
                            <option value="198">South Africa</option>
                            <option value="199">South Georgia and the South Sandwich Islands</option>
                            <option value="114">South Korea</option>
                            <option value="285">South Sudan</option>
                            <option value="200">Spain</option>
                            <option value="201">Sri Lanka</option>
                            <option value="180">St. Helena</option>
                            <option value="181">St. Kitts and Nevis</option>
                            <option value="182">St. Lucia</option>
                            <option value="183">St. Pierre and Miquelon</option>
                            <option value="184">St. Vincent and the Grenadines</option>
                            <option value="202">Sudan</option>
                            <option value="203">Suriname</option>
                            <option value="204">Svalbard &amp; Jan Mayen Islands</option>
                            <option value="205">Swaziland</option>
                            <option value="206">Sweden</option>
                            <option value="207">Switzerland</option>
                            <option value="208">Syria</option>
                            <option value="209">Taiwan</option>
                            <option value="210">Tajikistan</option>
                            <option value="211">Tanzania</option>
                            <option value="212">Thailand</option>
                            <option value="213">Timor-Leste</option>
                            <option value="214">Togo</option>
                            <option value="215">Tokelau</option>
                            <option value="216">Tonga</option>
                            <option value="217">Trinidad and Tobago</option>
                            <option value="218">Tunisia</option>
                            <option value="219">Turkey</option>
                            <option value="220">Turkmenistan</option>
                            <option value="221">Turks and Caicos Islands</option>
                            <option value="222">Tuvalu</option>
                            <option value="224">Uganda</option>
                            <option value="225">Ukraine</option>
                            <option value="226">United Arab Emirates</option>
                            <option value="228">United States Minor Outlying Islands</option>
                            <option value="230">Uruguay</option>
                            <option value="223">US Virgin Islands</option>
                            <option value="229">USA</option>
                            <option value="231">Uzbekistan</option>
                            <option value="232">Vanuatu</option>
                            <option value="233">Venezuela</option>
                            <option value="234">Vietnam</option>
                            <option value="244">Wales</option>
                            <option value="235">Wallis and Futuna Islands</option>
                            <option value="236">Western Sahara</option>
                            <option value="237">Yemen</option>
                            <option value="238">Zambia</option>
                            <option value="239">Zimbabwe</option>
                        </select>
                    </td>
                </tr>
                

                <tr>
                    <td colspan="2" width="100%">
                        <h4><b><br><font size="2px">Please Choose a Question from this List:</font></b></h4>
                        <h6 class="question">
				(  Why Do I need to Enter a Security Question?  )
                            <div class="display">
				Sometimes, it may happen that you might forget your Password! It happens<br>
				with the most Intelligent person on earth as well! In such case, this <br>
				security question will help you to reset your password again! No worries at all!!!!

                            </div>
                        </h6>
                    </td>
                </tr>
                <tr>
                    <td width="100%" colspan="2">
                        <select  name="quest" id="quest" onChange="validateSecQuest()">
                            <option selected="selected" value="-1">Select a Question from this list</option>
                            <option value="1">Which is your Favourite team?</option>
                            <option value="2">Who is your Favourite Actor/Actress?</option>
                            <option value="3">Which is your Favourite Football Team?</option>
                            <option value="4">What is your pet name?</option>
                            <option value="5">What is your Favourite Colour?</option>
                        </select>
                    </td>
                </tr>



                <tr>
                    <td>
                        <h4><b><font size="2px">Enter Your Answer for the Question*</font></b></h4>
                    </td>
                    <td >
                        <input  class="enterquestion" placeholder="Please Enter Answer" id="sec_quest_ans" name="sec_quest_ans" onBlur="validateAns()">
                    </td>
                </tr>
                
              <tr>
                    <td width="42%" rowspan="2">
                        <div style= "height: 60px;">
                            <b><font size="2px">Security Code:</font></b>

                            <br>
                              <?php
                                    $_SESSION['secure']=  rand(10000, 99999);
                                ?>
                            <div id="codeimage">
                                <img src="Generate.php">
                            </div>

                        </div>
                        <img id="refreshsecuritycode" style="cursor: pointer;margin-top: -20px; margin-left: 130px;" src="photos/Refresh.png" height="20px" width="20px">

                    </td>
                    <td height="60px" style="padding-top: 20px">
                            <input type="text"  id="secure_code" placeholder="Enter Code" name="code" onBlur="validateCode()" />
                     </td>
                </tr>
               
                <tr>
                   
                    <td>
                        <p style="display:none;font-size: 9px;color:red" id="WrongCode">
                               ENTER CORRECT CODE
                        </p>
                        
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" width="100%">
                        <h6 class="term">
                            <div style="height:20px">
                                <a href="T&C.php?seriesId?<?php echo $seriesId;?>" target="blank">
                                    <font style="color: blue;">Terms and Condtions</font>
                                </a>
                                <br>
                                By registering you agree to our terms and condition.
                            </div>
                        </h6>
                    </td>
                </tr>


                <tr>
                    <td colspan="2" valign="bottom" align="center">
                        <div id="feedback"></div>
                        <input type="submit" id="submit" name="submit" value="Save and Register!">
                    </td>
                </tr>



            </table>
				
	</div>
        <div class="filler" style="position: absolute;width: 1000px;height: 45px;left: 176px;top: 1150px;background-color: white">
        </div>




    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/Register.js"></script>
    <script type="text/javascript" src="js/make_All_page_responsive.js"></script>


    <script type="text/javascript">

    			function validateForm()
                        {
                                       var s1=validateUserName();
					var s2=validateFirstName();
                                        var s3=validateLastName();
					var s4=validateEmail();
					var s5=validateConfirmEmail();
					var s6=validatePassword();
					var s7=validateConfirmPassword();
					var s8=validateCountry();
					var s9=validateAns();
                                        var s10=validateCode();
                                        var s11=validateSecQuest();
					
                                        if(s1&&s2&&s3&&s4&&s5&&s6&&s7&&s8&&s9&&s10&&s11)
					{
                                            return true;
					}
					return false;

			}
                                        function validateUserName()
					{
						var f=document.getElementById("user_name").value;
						if(f=="")
						{
                                                    $('#user_name').css('border','1px solid red');
                                                    $('#user_name').css('box-shadow', '0px 0px 5px red');
                                                    return false;
						}
						else
						{
                                                    $('#user_name').css('border-color','silver');
                                                    $('#user_name').css('box-shadow', 'none');
							return true;
						}
					}

					function validateFirstName()
					{
						var f=document.getElementById("first_name").value;
						if(f=="")
						{
                                                    $('#first_name').css('border','1px solid red');
                                                    $('#first_name').css('box-shadow', '0px 0px 5px red');
							return false;
						}
						else
						{
						    $('#first_name').css('border-color','silver');
                                                    $('#first_name').css('box-shadow', 'none');
                                                    return true;
						}
					}

                                        function validateLastName()
					{
						var f=document.getElementById("last_name").value;
						if(f=="")
						{
                                                    $('#last_name').css('border','1px solid red');
                                                    $('#last_name').css('box-shadow', '0px 0px 5px red');
					            return false;
						}
						else
						{
                                                    $('#last_name').css('border-color','silver');
                                                    $('#last_name').css('box-shadow', 'none');
                                                    return true;
						}
					}
				


				function validateEmail()
				{
					var e=document.getElementById("user_email").value;
					if(e=="")
					{
                                                $('#user_email').css('border','1px solid red');
                                                $('#user_email').css('box-shadow', '0px 0px 5px red');
						return false;
					}
					else
					{
                        			//var rule=/^[a-zA-Z]+(\.[0-9]+[a-zA-Z]|_[0-9]+|_[0-9]+[a-zA-Z]+|[0-9]+_[a-zA-Z]+|_[a-zA-Z]+|\.[0-9]+|[0-9]+|[0-9]+[a-zA-Z]+|[a-zA-Z]*|\.[a-zA-Z]+|\.[a-zA-Z]+[0-9]+)(@)[a-zA-Z]+\.([a-zA-Z]+|[a-zA-Z]+\.[a-z]{2})$/;
						var rule= /^[a-zA-Z0-9_\.]+(@)[a-zA-Z]+\.([a-zA-Z]{2,3}|[a-zA-Z]+\.[a-z]{2})$/;
						if(!e.match(rule))
						{
                                                    document.getElementById("wrongEmailError").style.display="block";
                                                    return false;

						}
						else
						{
                                                    document.getElementById("wrongEmailError").style.display="none";
                                                    $('#user_email').css('border-color','silver');
                                                    $('#user_email').css('box-shadow', 'none');
                                                    return true;
                                                }
                                            }
                                 }




				function validateConfirmEmail()
				{
					var em=document.getElementById("user_email").value;
					var co=document.getElementById("user_co_email").value;
					if(co=="")
					{
                                            $('#user_co_email').css('border','1px solid red');
                                            $('#user_co_email').css('box-shadow', '0px 0px 5px red');
                                            return false;
					}
					if(em!=co)
					{
                                            document.getElementById("confirmEmailError").style.display="block";
                                            return false;
					}
					else
					{
                                            document.getElementById("confirmEmailError").style.display="none";
                                            $('#user_co_email').css('border-color','silver');
                                            $('#user_co_email').css('box-shadow', 'none');
                                            return true;
					}
					
				}




				function validatePassword()
				{
					var pass=document.getElementById("user_password").value;
					if(pass=="")
					{
                                            $('#user_password').css('border','1px solid red');
                                            $('#user_password').css('box-shadow', '0px 0px 5px red');
					    return false;
					}
					else if(pass.length<8)
					{
                                            $('#user_password').css('border','1px solid red');
                                            $('#user_password').css('box-shadow', '0px 0px 5px red');
                                            document.getElementById("passwordError").style.display="block";
                                            return false;
					}
					else
					{
                                             document.getElementById("passwordError").style.display="none";
                                            $('#user_password').css('border-color','silver');
                                            $('#user_password').css('box-shadow', 'none');
                                            return true;
					}
				}
				function validateConfirmPassword()
				{
					var pass=document.getElementById("user_password").value;
					var cop=document.getElementById("user_co_password").value;
					if(cop=="")
					{
                                            $('#user_co_password').css('border','1px solid red');
                                            $('#user_co_password').css('box-shadow', '0px 0px 5px red');
                                            return false;
					}
					else if(cop!=pass)
					{
                                            document.getElementById("confirmpasswordUnmatchError").style.display="block";
                                            return false;
					}
					else
                                        {
                                            document.getElementById("confirmpasswordUnmatchError").style.display="none";
                                            $('#user_co_password').css('border-color','silver');
                                            $('#user_co_password').css('box-shadow', 'none');
                                            return true;
					}
				}






				function validateSecQuest()
				{
					var a=document.getElementById("quest").value;
					if(a==-1)
					{
                                            $('#quest').css('border','1px solid red');
                                            $('#quest').css('box-shadow', '0px 0px 5px red');
                                            return false;
					}
					else
					{
                                            $('#quest').css('border-color','silver');
                                            $('#quest').css('box-shadow', 'none');
                                            return true;
					}
				}
				function validateAns()
				{
					var i=document.getElementById("sec_quest_ans").value;
					if(i=="")
					{
                                            $('#sec_quest_ans').css('border','1px solid red');
                                            $('#sec_quest_ans').css('box-shadow', '0px 0px 5px red');
                                            return false;
					}
					else
					{
                                            $('#sec_quest_ans').css('border-color','silver');
                                            $('#sec_quest_ans').css('box-shadow', 'none');
                                            return true;
					}
				}


				function validateCountry()
				{
					var country=document.getElementById("country").value;
					if(country==-1)
					{
                                            $('#country').css('border','1px solid red');
                                            $('#country').css('box-shadow', '0px 0px 5px red');
                                            return false;
					}
					else
					{
                                            $('#country').css('border-color','silver');
                                            $('#country').css('box-shadow', 'none');
                                            return true;
					}
				}
                                function validateCode()
                                {
                                    var code=document.getElementById("secure_code").value;
                                    if(code=="")
                                    {
                                        $('#secure_code').css('border','1px solid red');
                                        $('#secure_code').css('box-shadow', '0px 0px 5px red');
                                        return false;
                                    }
                                    else
                                    {
                                        $('#secure_code').css('border-color','silver');
                                        $('#secure_code').css('box-shadow', 'none');
                                        return true;
                                    }
                                }


                                $('#user_name,#first_name,#last_name,#user_email,#user_co_email,#user_password,#user_co_password,#sec_quest_ans,#secure_code').focus(function(){
                                   $(this).css('border','1px solid #12DEE5');
                                   $(this).css('box-shadow', '0px 0px 8px #12DEE5');
                                });
                                 $('#user_name,#first_name,#last_name,#user_email,#user_co_email,#user_password,#user_co_password,#sec_quest_ans,#secure_code').focusout(function(){
                                    $('#email').css('border-color','silver');
                                   $('#email').css('box-shadow', 'none');
                                });
		


	</script>
</body>
</html>

<?php
    include 'Footer.php';
?>