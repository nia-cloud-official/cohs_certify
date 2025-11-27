<?php
require_once "db.php";
$db = new DB();

if (isset($_GET['cid'])) {
    $certificate_id = $_GET['cid'];
    $sql = "SELECT c.student_name, 
                   c.course_name, 
                   c.issued_date, 
                   c.number_of_modules, 
                   c.grade, 
                   c.expiry_date, 
                   s.school_name, 
                   s.website_link
            FROM certificates c
            JOIN settings s ON 1=1
            WHERE c.certificate_id = ? LIMIT 1";
    $stmt = $db->conn->prepare($sql);
    $stmt->bind_param("s", $certificate_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $certificate = $result->fetch_assoc();
    if ($certificate) {
        $grade = "";
        if ($certificate['grade'] == "DISTINCTION") {
            $grade = "D";
        }
        if ($certificate['grade'] == "PASS") {
            $grade = "P";
        }
        if ($certificate['grade'] == "CREDIT") {
            $grade = "C";
        }
        if (!empty($certificate['expiry_date'])) {
        $expiry = $certificate['expiry_date'];
    } else {
        $expiry = "N/A";
    }
        
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";

        echo "<head>";
        echo "  <title>{$certificate['student_name']} Certificate</title>";

        echo "  <!-- Meta -->";
        echo "  <meta charset='utf-8'>";
        echo "  <meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        echo "  <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "  <meta name='description' content='Certificate Verification'>";
        echo "  <meta name='author' content='COH&S'>";
        echo "  <link rel='shortcut icon' href='favicon.ico'>";

        echo "  <!-- Google Font -->";
        echo "  <link href='https://fonts.googleapis.com/css?family=Montserrat:800|Roboto:400,500,700&display=swap' rel='stylesheet'>";

        echo "  <!-- FontAwesome JS-->";
        echo "  <script defer src='assets/fontawesome/js/all.min.js'></script>";

        echo "  <!-- Theme CSS -->";
        echo "  <link id='theme-style' rel='stylesheet' href='assets/css/theme.css'>";

        echo "</head>";

        echo "<body>";
        echo "  <div class='sections-wrapper'>";

        echo "      <div class='section-blocks mb-5'>";

        echo "          <div id='section-content' class='section-content section'>";
        echo "              <div class='container py-5'>";
        echo "                  <div class='section-col-max mx-auto'>";
        echo "                      <center>";

        echo "                          <img src='./assets/logo.png' style=\"height: 150px;\" alt=''>";
        echo "                      </center><br>";
        echo "                      <h3 style=\"font-weight: lighter;\" class='section-title mb-8'>Certificate Verification</h3>";
        echo "                      <h2 style=\"font-size: 60px;\" class='section-title mb-2'>{$certificate['student_name']}</h2>";

        echo "                      <div class='data-summary justify-content-center text-center'>";
        echo "                          <div class='row mb-5'>";
        echo "                              <div class='item col-6 col-lg-3 mb-3 mb-lg-0'>";
        echo "                                  <div class='data'>{$certificate['number_of_modules']}</div>";
        echo "                                  <div class='meta'>Modules</div>";
        echo "                              </div><!--//item-->";
        echo "                              <div class='item col-6 col-lg-3 mb-3 mb-lg-0'>";
        echo "                                  <div class='data'>5+</div>";
        echo "                                  <div class='meta'>CPDS</div>";
        echo "                              </div><!--//item-->";
        echo "                              <div class='item col-6 col-lg-3 mb-3 mb-lg-0'>";
        echo "                                  <div class='data'>{$grade}</div>";
        echo "                                  <div class='meta'>Recieved Grade</div>";
        echo "                              </div><!--//item-->";
        echo "                              <div class='item col-6 col-lg-3 mb-3 mb-lg-0'>";
        echo "                                  <div class='data'>{$expiry}</div>";
        echo "                                  <div class='meta'>Expiry Date</div>";
        echo "                              </div><!--//item-->";
        echo "                          </div><!--//row-->";
        echo "                      </div><!--//course-summary-->";
        echo "                              <div class='section-col-max mx-auto'>";
        echo "                                  <h3 class='section-title mb-4'>{$certificate['course_name']}</h3>";
        echo "                                  <p class='mb-4 text-center'>";
        echo "                                      This certifies that {$certificate['student_name']} has successfully completed the course {$certificate['course_name']} with a {$certificate['grade']}.";
        echo " ";
        echo "Issued on {$certificate['issued_date']} by Centre For Occupational Health & Safety.";
        echo "";
        echo "This certificate has been verified through the official records of the Centre For Occupational Health & Safety and is recognized as valid.";
        echo "                                  </p>";

        echo "                                  <div class='lead-form-wrapper single-col-max mx-auto theme-bg-light rounded p-5'>";
        echo "                                      <h4 class='form-heading text-center mb-3'>For more details</h4>";
        echo "                                      <div class='form-intro text-center mb-3'>Please contact ITH at info@cohs.education or leave your email below and we will get back to you.</div>";
        echo "                                      <div class='form-wrapper'>";
        echo "                                          <form class='lead-form' netlify>";
        echo "                                              <div class='form-group mb-3'>";
        echo "                                                  <label for='email' class='sr-only'>Email</label>";
        echo "                                                  <input type='email' class='form-control ' id='email' placeholder='Your Email'>";
        echo "                                              </div>";
        echo "                                              <button type='submit' class='btn btn-ghost btn-submit w-100'>Submit</button>";
        echo "                                          </form>";
        echo "                                         <br>";
        echo "                                              <a href='https://cohs.education'><button class='btn btn-primary btn-primary w-100'>Visit Our Main Website</button></a>";
        echo "                                      </div><!--//form-wrapper-->";
        echo "                                  </div><!--//lead-form-wrapper-->";

        echo "                              </div>";
        echo "                          </div><!--//container-->";
        echo "                      </div><!--//section-requirements-->";

        echo "                  </div>";
        echo "              </div><!--//container-->";
        echo "          </div><!--//section-content-->";

        echo "  <footer class='footer pb-5 text-center'>";
        echo "      <div class='container'>";
        echo "          <div class='copyright mb-2'>";
        echo "              <a class='theme-link' href='#' target='_blank'>Certificate Verification</a> by COH&S";
        echo "          </div>";
        echo "          <div class='legal mb-0'>";
        echo "              <ul class='list-inline mb-0'>";
        echo "                  <li class='list-inline-item'><a href='#'>Privacy</a></li>";
        echo "                  <li class='list-inline-item theme-text-light'>|</li>";
        echo "                  <li class='list-inline-item'><a href='#'>Terms of Services</a></li>";
        echo "              </ul>";
        echo "          </div>";
        echo "      </div><!--//container-->";
        echo "  </footer><!--//footer-->";

        echo "  <!-- Javascript -->";
        echo "  <script src='assets/plugins/popper.min.js'></script>";
        echo "  <script src='assets/plugins/bootstrap/js/bootstrap.min.js'></script>";
        echo "  <script src='assets/js/main.js'></script>";

        echo "</body>";
        echo "</html>";
    } else {
        echo "<p style='color:red;'>Certificate not found.</p>";
    }
} else {
    echo "<p>Please provide a certificate ID (?cid=XYZ).</p>";
}
