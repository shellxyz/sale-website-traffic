<?php session_start();
if ($_SESSION['admin'] != 1) {
    echo ('Unauthorized Access');
    exit;
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Edit traffic clients</title>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="../commonfiles/css/style.css" />
        <script type='text/javascript' src='../commonfiles/js/datePicker.js'></script>
    </head>
    <body>
        <div style='width:200px;position:absolute;left:0px;top:0px;'>
<?php
include 'leftMenu.php';
?>
        </div>
        <div style='width:1080px;position:absolute;left:200px;top:0px;'>
            <br/>
            <br/>
            <form action='addClient.php' method='post'>
                <table>
                    <tr>
                        <td>
                            <strong>Client Email:</strong>
                        </td>
                        <td>
                            <input type='text' id='email' name='email' size='100'>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Visits Bought:</strong>
                        </td>
                        <td>
                            <select id='visits_bought' name='visits_bought'>
                                <option value = '500'> 500
                                <option value = '1000'> 1000
                                <option value = '5000'> 5,000
                                <option value = '10000'> 10,000
                                <option value = '20000'> 20,000
                                <option value = '50000'> 50,000
                                <option value = '100000'> 100K
                                <option value = '500000'> 500K
                                <option value = '1000000'> 1 Million
                                <option value = '3000000'> 3 Million
                                <option value = '5000000'> 5 Million
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Assign More:</strong>
                        </td>
                        <td>
                            <select id = 'assign_percentage' name = 'assign_percentage' >
                                <option value = '0.00'> 0%
                                <option value = '0.01'> 1%
                                <option value = '0.02'> 2%
                                <option value = '0.03'> 3%
                                <option value = '0.04'> 4%
                                <option value = '0.05'> 5%
                                <option value = '0.10'> 10%
                                <option value = '0.15'> 15%
                                <option value = '0.20'> 20%
                                <option value = '0.25'> 25%
                                <option value = '0.30'> 30%
                                <option value = '0.35'> 35%
                                <option value = '0.40'> 40%
                                <option value = '0.45'> 45%
                                <option value = '0.50'> 50%
                            </select>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <strong>Target Country</strong>
                        </td>
                        <td>
                            <select id='target_country' name='target_country'>
                                <option value='All'> All
                                <option value='NA'> North America
                                <option value='USA'> United States
                                <option value='Canada'> Canada
                                <option value='UK'> UK
                                <option value='Australia'> Australia
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="CongoRepublic">Congo, The Democratic Republic of The</option>
                                <option value="Cook">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-bissau">Guinea-bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia, Federated States of</option>
                                <option value="Moldova">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-leste">Timor-leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>


                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Viet Nam</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>



                                <option value='Other'> Other
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Our sites only?:</strong>
                        </td>
                        <td>
                             <select id='our_sites_only' name='our_sites_only'>
                                <option value='0' selected='true'>No
                                <option value='1' >Yes
                             </select>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <strong>Source</strong>
                        </td>
                        <td>
                            <select id='source' name='source'>
                                <option value=''>Please select...
                                <option value='ebay' selected='true'>Ebay
                                <option value='addserver'>Online Services Cloud
                                <option value='fiverr'>Fiverr
                                <option value='gigbucks'>Gigbucks
                                <option value='twentyville'>Twentyville
                                <option value='gigme5'>Gigme5
                                <option value='fittytown'>Fittytown
                                <option value='taskarmy'>Taskarmy
                                <option value='gigsWood'>GigsWood
                                <option value='magicGig'>MagicGig
                                <option value='upHype'>UpHype
                                <option value='gigtask'>Gigtask
                                <option value='tenbux'>Tenbux
                                <option value='diamond-dollar'>Diamond-dollar
                                <option value='small-gigs'>Small-gigs
                                <option value='fivebucksdeals'>Fivebucksdeals
                                <option value='everestgigs'>Everestgigs
                                <option value='other'>Other
                            </select>

                        </td>
                    </tr>

                    <tr>
                        <td colspan='2'>
                            <input type='submit' id='submit' name='submit' value='Add Client'>
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            $email = $_POST['email'];
            $source = $_POST['source'];
            $visits_bought = $_POST['visits_bought'];
            $assign_percentage = $_POST['assign_percentage'];
            $remaining_visit = $visits_bought + $visits_bought * $assign_percentage;
            $our_sites_only = $_POST['our_sites_only'];
            $target_country = $_POST['target_country'];

            if (!$email) {
                exit;
            }

// we connect to example.com and port 3307
            $link = mysql_connect('localhost', 'visitor_traffic', 'UEpmKvAqB=^)');
            if (!$link) {
                die('Could not connect: ' . mysql_error());
            }


            if (!mysql_select_db("visitor_traffic-database")) {
                echo "Unable to select mydbname: " . mysql_error();
                exit;
            }

            $password = generatePassword();

            $sql = " insert into clients (email, source, password, remaining_visit, target_country, visits_bought, our_sites_only) values ('$email','$source', '$password', $remaining_visit, '$target_country', $visits_bought, '$our_sites_only')";
//echo $sql ;
            $result = mysql_query($sql);
            if ($result && mysql_insert_id($link) > 0) {
                echo ("<strong>Client Added:" . mysql_insert_id($link) . "</strong>");
                $clientId = mysql_insert_id($link);
                // Additional headers
                $headers = 'To: $email ' . "\r\n";
                $headers = 'From: Online Services Cloud - Traffic System <traffic_support@onlineservicescloud.com>' . "\r\n";

                require 'oursites.php';

                $disclaimer = "Disclaimer: We do not guarantee sales, sign ups, and clicks, as your site must sell itself and we can only send quality visitors	to your site. Though we try to send visitors from different unique IPs, there is no guarantee that it will be 100% unique. We used the term Unique to indicate that we will show your web-sites to many unique visitors/computers (we will try to scatter the traffic as much as possible and maintain 24 hour unique - but no guarantee). Mostly the visitors will be from many unique IPs (may or may not be all) in 24 hour period. We do not guarantee any percentage of uniqueness. Regarding traffic statistics: http://www.VisitorsShop.com/ is the only acceptable statistics. we know what we are doing. We keep track of the traffic on our own. Whenever we send a visitor (it can be a previous IP) to your site - if we can load your site, we deduct 1 visit. Third party counters may not be able to count all visits; hence, we do not accept their statistics. Visitors many times may close the window even before the tracking code is loaded. If the 3rd party tracking is done through JavaScript, tracking may not work if JavaScript is disabled at the visitors' Computers. Your web-site will be displayed in our queue. Please advise if you do not want to display";
                $mismatch = "Please check the following URL to understand how the internet traffic works and to understand counting visitors. http://www.VisitorsShop.com/counterMismatch.php\n\n";

                $body = "Dear Customer,\n\nYour user account with our Add Server is created. You can now login into our system (http://www.VisitorsShop.com/clientHome.php?clientId=$clientId) to add your url.\n\n User ID:$email \n Password:$password\n\nIf you do not add soon, we may also add your web-sites to our system. Please check http://www.VisitorsShop.com/clientHome.php?clientId=$clientId for your own traffic statistics (and also activate sites added by us).\n\nPlease read the disclaimer at the end of this email before adding or activating your sites.\n\nWe are always here to listen to you and help you out with any of your concerns. Contact our customer support at traffic_support@onlineservicescloud.com with any of your concerns at any time. We will be more than happy to assist you.\n\nRegards,\n$ourSites \n\n\n$disclaimer\n\n$mismatch";

                //$send = mail($email, 'Your user account with our Add Server is created ', $body, $headers);
                $send = mail('traffic_support@onlineservicescloud.com', 'Your user account with our Add Server is created ', $body, $headers);
                $send = mail($email, 'Your user account with our Add Server is created ', $body, $headers); //$headers



                if ($send) {
                    echo ("<br/>Email sent successfully<br/>");
                }
            } else {
                echo ("<br/><strong>Error: Client Added</strong>");
            }

            mysql_close($link);

            function generatePassword($length = 5, $strength = 4) {
                $vowels = 'aeuy';
                $consonants = 'bdghjmnpqrstvz';
                if ($strength & 1) {
                    $consonants .= 'BDGHJLMNPQRSTVWXZ';
                }
                if ($strength & 2) {
                    $vowels .= "AEUY";
                }
                if ($strength & 4) {
                    $consonants .= '23456789';
                }
                if ($strength & 8) {
                    $consonants .= '@#$%';
                }

                $password = '';
                $alt = time() % 2;
                for ($i = 0; $i < $length; $i++) {
                    if ($alt == 1) {
                        $password .= $consonants[(rand() % strlen($consonants))];
                        $alt = 0;
                    } else {
                        $password .= $vowels[(rand() % strlen($vowels))];
                        $alt = 1;
                    }
                }
                return $password;
            }
            ?>
        </div>
    </body>