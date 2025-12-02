<?php
require_once "db.php";
$db = new DB();

if (isset($_GET['cid'])) {
    $certificate_id = $_GET['cid'];
    $sql = "SELECT student_name, ecd_level, issued_date FROM ecd_certificates WHERE certificate_id = ? LIMIT 1";
    $stmt = $db->conn->prepare($sql);
    $stmt->bind_param("s", $certificate_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $certificate = $result->fetch_assoc();

    if ($certificate) {
               
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

        echo "                          <img src='./assets/logo.png' style=\"height: 80px;\" alt=''>";
        echo "                      </center><br>";
        echo "                      <h3 style=\"font-weight: lighter;\" class='section-title mb-8'>Certificate Verification</h3>";
        echo "                      <h2 style=\"font-size: 60px;\" class='section-title mb-2'>{$certificate['student_name']}</h2>";

        echo "                              <div class='section-col-max mx-auto'>";
        echo "                                  <h3 class='section-title mb-4'>ECD {$certificate['ecd_level']}</h3>";
        echo "                                  <p class='mb-4 text-center'>";
        echo "                                      This certifies that {$certificate['student_name']} has successfully completed ECD {$certificate['course_name']} with a {$certificate['grade']}.";
        echo " ";
        echo "Issued on {$certificate['issued_date']} by Christ Our Hope College.";
        echo "";
        echo "This certificate has been verified through the official records of the Centre For Occupational Health & Safety and is recognized as valid.";
        echo "                                  </p>";

        echo "                                  <div class='lead-form-wrapper single-col-max mx-auto theme-bg-light rounded p-5'>";
        echo "                                      <h4 class='form-heading text-center mb-3'>For more details</h4>";
        echo "                                      <div class='form-intro text-center mb-3'>Please contact COHS at info@cohs.education or leave your email below and we will get back to you.</div>";
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
}
?>
