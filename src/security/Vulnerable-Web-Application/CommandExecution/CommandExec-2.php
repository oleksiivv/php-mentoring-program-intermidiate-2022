<?php
session_start();

$_SESSION['token'] = $_SESSION['token'] ?? bin2hex(random_bytes(35));
?>
<html>
  <head>
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
    <title>CommandExec-2</title>
  </head>
  <body>
    <div style="background-color:#afafaf;padding:15px;border-radius:20px 20px 0px 0px">
      <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='commandexec.html';">Main Page</button>
    </div>
    <div align="center" style="background-color:#c9c9c9;padding:20px;">
      <h1 align="center">I think there is a vuln here!</h1>
    <form align="center" action="" method="POST">
      <label align="center">Name:</label>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
        <input align="center" type="text" name="typeBox" value=""><br>
      <input align="center" type="submit" value="Submit">
    </form>
  </div>
  <div style="background-color:#ecf2d0;padding:20px;border-radius:0px 0px 20px 20px" align="center">
    <?php
    //Anti-CSRF implementation reduces the vulnerability of the website
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

    if (!$token || $token !== $_SESSION['token']) {
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    }

    if (isset($_GET["typeBox"])) {
      $target =$_GET["typeBox"];
      $substitutions = array('&&' => '',';'  => '','/' => '','\\' => '' );
      $target = str_replace(array_keys($substitutions),$substitutions,$target);
      echo shell_exec($target);
      if ($_GET["typeBox"] == "Trochilidae")
        echo "Welldone! You did great job.";
    }

    ?>
  </div>
  </body>
</html>
