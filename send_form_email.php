<?php
  /* Set e-mail recipient */
  $myemail = "chrismhume@gmail.com";

  /* Check all form inputs using check_input function */
  $name = check_input($_POST['name'], "Enter your name");
  $email = check_input($_POST['email'], "Enter your email");
  // $url = check_input($_POST['url'], "Enter your url");
  // $ordercount = check_input($_POST['ordercount'], "Enter your book quantity");
  // $startdate = check_input($_POST['startdate'], "Enter your start date");
  // $pagecount = check_input($_POST['pagecount'], "Enter your page quantity");

  /* If e-mail is not valid show error message */
  if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
  {
    show_error("E-mail address not valid");
  }
  /* Let's prepare the message for the e-mail */
  $message = "

  Name: $name
  E-mail: $email
  Subject: 'book order'

  Message:
  'I want to chat about a book.'
  ";

  

  /* Send the message using mail() function */
  mail($myemail, $subject, $message);

  // get_price($pagecount, $ordercount);

  /* Redirect visitor to the thank you page */
  header('Location: thanks.html');
  exit();

  /* Functions we used */
  function check_input($data, $problem='')
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0){
      show_error($problem);
    }
    return $data;
  }

  function get_price($pagecount, $ordercount){
    // pages = 60
    // $30 = 30 pages, +$5 for ten afterwards
    $np = $pagecount - 30;
    if ($np != 0){
      //then we have more than 30 pages. 
      $extra_costs = round($np/10) * 5;
      echo 'extra_costs: ', $extra_costs;
      echo '<br>';
      echo $pagecount;
      echo '<br>';
      $final_costs = $extra_costs + 30;
      $_COOKIE['final_costs'] = $final_costs;
    }
    return;
  }

  function show_error($myError)
  {
    ?>
    <html>
      <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href='https://fonts.googleapis.com/css?family=Quicksand:400,300,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
      </head>
      <body>
        <section class="center header header-full-image header-half-height">
          <div>
            <h1><a href="home.html">Blog to Book</a></h1>
            <!-- <h4 class="description">Transform your online writings into a timeless book</h4> -->
          </div>
        </section>
        <div class="error-pg">
          <h3>Please correct the following error:</h3>
          <h4><?php echo $myError; ?></h4>
          <a href="home.html#getstarted">Go Back</a>
        </div>
      </body>
    </html>
    <?php
    exit();
  }
?>