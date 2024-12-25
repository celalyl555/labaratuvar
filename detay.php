<?php 

include('header.php'); 
$seo_url = $_GET['seo'];
$seo_url = str_replace('.php', '', $seo_url); // .php uzantısını kaldır
 
$query = $conn->prepare("SELECT * FROM kategoriler WHERE seo_url = :seo_url");
$query->bindParam(':seo_url', $seo_url, PDO::PARAM_STR);
$query->execute();
$kategoriler = $query->fetch(PDO::FETCH_ASSOC);
if (!$kategoriler) {
    // SEO URL veritabanında yoksa 404 sayfasına yönlendir
    header("Location: 404");
   
} 
?>

    <!-- ======================================================== -->

    <!-- Main Detay Area Start -->

    <div class="detayscreen">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    
    <main class="detayMain">

        <div class="detayImg">
            <img src="assets/img/main/eurolab.avif" alt="">
        </div>

        <div class="detayTxt">

            <div class="detayMap">
                <a href="">Home</a>
                <p>-</p>
                <a href="">Markets & Services</a>
                <p>-</p>
                <a href="">Buildings & Infrastructure</a>
            </div>
            
            <h2 class="detayHeader">Data Centers & Telecommunications</h2>

        </div>
    </main>

    <!-- Main Detay Area End -->
    
    <!-- ======================================================== -->

    <!-- Text Area Start -->

    <section class="detayIcerik">

        <div class="detayscreen">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="detayInsideTxt">

            <p><strong>Today’s society is driven by data, creating demand for robust data centers and telecommunications infrastructure.</strong></p>

            <h2>Comprehensive services for the telecommunications</h2>

            <h3>Your challenges</h3>

            <p>As investors and developers, you aim to deliver telecoms and digital infrastructure that is both profitable and in line with end-user demands. You require the help of organizations with fully integrated TIC and engineering services that can support them across the entire value chain. This includes everything from design and construction, to operations and maintenance, to decommissioning and closure.</p>

            <h3>How we support you</h3>

            <p>Our experience includes a wide range of cloud computing, colocation, wholesale, and enterprise data center projects. The requirements for each of these types of data centers are as unique as the business that each supports. We put our exceptionally skilled staff to work delivering innovative technology solutions to all of our clients.</p>

            <p>Bureau Veritas supports you at every step of the way during your telecoms and data center projects. We help you build sustainably and remain compliant with all regulations from start-up through handover.</p>

            <p>Our subsidiary, Primary Integration Solutions, is a leader in data center building, commissioning and operational risk management services.</p>

            <ul>
                <li><strong>Data Center Commissioning:</strong> Our comprehensive processes for qualifying the electrical, mechanical, plumbing and control systems that support mission critical environments ensure that the critical load is always protected.</li>
                <li><strong>Data Center QA/QC:</strong> Our QA/QC services are designed to ensure compliance with company and industry standards, as well as client specifications and project plans.</li>
                <li><strong>Data Center Operations Consulting Services:</strong> We provide the technical expertise to ensure that your systems operate correctly, standards are replicable and sustainable, equipment is optimized for reliability and performance, and personnel are properly trained.</li>
                <li><strong>Telecoms infrastructure:</strong> We provide supervision, commissioning and testing of new communication networks, pipelines, fiber-optic cables and towers. Our experts can conduct a full inventory assessment and asset inspection to develop an Asset Management Plan.</li>
            </ul>

            <h2>Remote inspections and data collection</h2>

            <p>Providing accurate inspections is a key pillar of Bureau Veritas’ expertise. We use drones and sensors for remote inspection and data collection, carry out surveys using on site cameras, inspect progress on construction, and supervise construction site safety. Our remote inspections improve safety and reduce costs.</p>

            <p>With our Building Information Modeling tool, BIM, Bureau Veritas can use 3D technology to provide digital modeling for the design and construction of your building, helping manage data and simulate operations (SIMOPS).</p>

        </div>

    </section>
    
    <!-- Text Area End -->
    
    <!-- ======================================================== -->

    <!-- Sertifika Area Start -->

    <section>

        <div class="sertifika">

            <div class="sertifikabg">
                <h2>FOSTERING TRUST, IMPROVING PERFORMANCE</h2>
            </div>

            <div class="sertifikaSlider1">
                <div class="owl-carousel owl-sertifika">
                    <a href="" class="item">
                        <img src="assets/img/main/eurolab.avif" alt="">
                        <p class="owl-header">Commodities</p>
                        <p class="owl-txt">How to guarantee safety and quality in a key sector for society?</p>
                    </a>
                    <a href="" class="item">
                        <img src="assets/img/main/orig.jpg" alt="">
                        <p class="owl-header">Marine & Offshore</p>
                        <p class="owl-txt">How to ensure safety in a high-risk environment?</p>
                    </a>
                    <a href="" class="item">
                        <img src="assets/img/main/Trust.jpg" alt="">
                        <p class="owl-header">Automotive & Transport</p>
                        <p class="owl-txt">How to meet future transportation challenges?</p>
                    </a>
                    <a href="" class="item">
                        <img src="assets/img/main/eurolab.avif" alt="">
                        <p class="owl-header">Financial services & Public sector</p>
                        <p class="owl-txt">How to deliver efficient Government services?</p>
                    </a>
                    <a href="" class="item">
                        <img src="assets/img/main/orig.jpg" alt="">
                        <p class="owl-header">Power & Utilities</p>
                        <p class="owl-txt">How to adapt to a changing business environment?</p>
                    </a>
                </div>

                
            </div>

            <div class="borderscreen11">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>

        </div>

    </section>

    <!-- Sertifika Area Start -->

    <!-- ======================================================== -->

    <!-- Footer Area Start -->

    <section>
        
        <!-- <div class="socialMedia">
            <h2>Follow us on</h2>
            <ul class="socialIco">
                <li class="blNone1">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" class="bi bi-twitter-x" viewBox="0 0 16 16">
                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                        </svg>
                    </a>
                </li>
                
                <li>
                    <a href="">
                        <svg viewBox="-5 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Dribbble-Light-Preview" transform="translate(-385.000000, -7399.000000)" fill="#FFFFFF">
                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                        <path d="M335.821282,7259 L335.821282,7250 L338.553693,7250 L339,7246 L335.821282,7246 L335.821282,7244.052 C335.821282,7243.022 335.847593,7242 337.286884,7242 L338.744689,7242 L338.744689,7239.14 C338.744689,7239.097 337.492497,7239 336.225687,7239 C333.580004,7239 331.923407,7240.657 331.923407,7243.7 L331.923407,7246 L329,7246 L329,7250 L331.923407,7250 L331.923407,7259 L335.821282,7259 Z" id="facebook-[#176]"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </li>
                
                <li>
                    <a href="">
                        <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Dribbble-Light-Preview" transform="translate(-180.000000, -7479.000000)" fill="#FFFFFF">
                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                        <path d="M144,7339 L140,7339 L140,7332.001 C140,7330.081 139.153,7329.01 137.634,7329.01 C135.981,7329.01 135,7330.126 135,7332.001 L135,7339 L131,7339 L131,7326 L135,7326 L135,7327.462 C135,7327.462 136.255,7325.26 139.083,7325.26 C141.912,7325.26 144,7326.986 144,7330.558 L144,7339 L144,7339 Z M126.442,7323.921 C125.093,7323.921 124,7322.819 124,7321.46 C124,7320.102 125.093,7319 126.442,7319 C127.79,7319 128.883,7320.102 128.883,7321.46 C128.884,7322.819 127.79,7323.921 126.442,7323.921 L126.442,7323.921 Z M124,7339 L129,7339 L129,7326 L124,7326 L124,7339 Z" id="linkedin-[#161]"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </li>
                
                <li>
                    <a href="">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" fill="#FFFFFF"/>
                            <path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="#FFFFFF"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z" fill="#FFFFFF"/>
                        </svg>
                    </a>
                </li>

                <li>
                    <a href="">
                        <svg viewBox="0 -3 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Dribbble-Light-Preview" transform="translate(-300.000000, -7442.000000)" fill="#FFFFFF">
                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                        <path d="M251.988432,7291.58588 L251.988432,7285.97425 C253.980638,7286.91168 255.523602,7287.8172 257.348463,7288.79353 C255.843351,7289.62824 253.980638,7290.56468 251.988432,7291.58588 M263.090998,7283.18289 C262.747343,7282.73013 262.161634,7282.37809 261.538073,7282.26141 C259.705243,7281.91336 248.270974,7281.91237 246.439141,7282.26141 C245.939097,7282.35515 245.493839,7282.58153 245.111335,7282.93357 C243.49964,7284.42947 244.004664,7292.45151 244.393145,7293.75096 C244.556505,7294.31342 244.767679,7294.71931 245.033639,7294.98558 C245.376298,7295.33761 245.845463,7295.57995 246.384355,7295.68865 C247.893451,7296.0008 255.668037,7296.17532 261.506198,7295.73552 C262.044094,7295.64178 262.520231,7295.39147 262.895762,7295.02447 C264.385932,7293.53455 264.28433,7285.06174 263.090998,7283.18289" id="youtube-[#168]"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>

    </section> -->
    <?php 

include('footer.php'); 


?>