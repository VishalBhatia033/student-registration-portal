<?php
session_start();
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>design</title>
    <style>
      body,
      html {
        margin: 0;
        padding: 0;
        /* background-color: transparent; */
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
          sans-serif;
        background-color: rgba(0, 0, 0, 0.5);
      }
      .navbar p a {
        cursor: pointer;
        text-decoration: none;
        color: white;
        padding: 5px;
        transition: 0.2s;
        transition-timing-function: ease-in;
        border-bottom: 3px solid #002a38;
      }
      .navbar p {
        cursor: pointer;
        padding: 5px;
        transition: 0.2s;
        transition-timing-function: ease-in;
        border-bottom: 3px solid #002a38;
      }
      footer {
        display: flex;
        height: 20vh;
        width: 100%;
        background-color: #002a38;
        line-height: 1.3;
        font-family: Menlo, monospace;
        justify-content: center;
        align-items: center;
      }
      footer ul {
        list-style: none;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      footer ul li a {
        text-decoration: none;
        color: white;
        padding: 1rem;
      }

      .heading {
        color: white;
        background-color: #002a38;
        text-decoration: underline;
        /* text-align: start; */
      }

      .heading {
        font-size: 4rem;
        text-align: center;
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
          sans-serif;
        font-weight: 200;
      }
      .navbar {
        /* border-top: 1px solid rgb(216, 215, 215); */
        display: flex;
        font-size: 0.8rem;
        justify-content: space-between;
        align-items: center;
        height: 10vh;
        background-color: #002a38;
        gap: 2%;
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
          sans-serif;
        position: sticky;
        top: 0;
      }
      .navbar p {
        cursor: pointer;
        padding: 5px;
        transition: 0.2s;
        transition-timing-function: ease-in;

        /* border-bottom: 3px solid white; */
      }
      .navbar p a {
        cursor: pointer;
        text-decoration: none;
        color: white;
        padding: 8px 15px;
        transition: 0.2s;
        transition-timing-function: ease-in;
        border-bottom: 3px solid #002a38;
      }
      .navbar p:hover {
        border-bottom: 3px solid rgb(216, 176, 129);
      }
      /* .navbar p a:hover {
        border-bottom: 3px solid rgb(216, 176, 129);
      } */
      .banner {
        /* background-image: url(../images/banner.jpg); */
        /* background-position: center;
  background-repeat: no-repeat;
  background-size: cover; */
        height: 65vh;
        display: flex;
        /* justify-content: top;
        align-items: center; */
        flex-direction: column;
        flex-wrap: wrap;
      }
      .heading2 {
        margin-top: 3%;
        text-align: start;
        height: 100%;
        width: 60%;
        font-size: 9rem;
        padding-left: 2rem;
        font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
        color: white;
      }
      .line {
        margin-top: 2%;
        color: white;
        word-spacing: 2px;
        font-family: Calibri, "Trebuchet MS", sans-serif;
        height: 10%;
        width: 45%;
        text-align: center;
      }
      .banner_button {
        margin-top: 2%;
        padding: 0.4rem;
        padding-right: 1rem;
        padding-left: 1rem;
        color: white;
        background-color: transparent;
        font-family: Calibri, "Trebuchet MS", sans-serif;
        border: 1.2px solid rgb(184, 183, 183);
        border-bottom: 2px solid white;
      }
      hr {
        margin-top: 40px;
        border-top: 1px solid rgb(216, 215, 215);
      }

      @media (max-width: 750px) {
        .line {
          height: 25%;
        }
        .navbar {
          font-size: 0.6rem;
        }
      }

      
@keyframes wave-animation {
  0%,
  100% {
    transform: rotate(0deg);
  }
  25% {
    transform: rotate(20deg);
  }
  75% {
    transform: rotate(-15deg);
  }
}
     
      footer a:hover ~ footer p{
        animation: wave-animation 0.3s infinite;
      }
      video {
        width: 100%;
        margin: 0;
        padding: 0;
        position: fixed;
        top: 0;
        z-index: -1;
      }
      .links {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
      }

      .card {
        height: 70vh;
        background-color: #002a38;
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
      }
      .cardtext {
        width: 40%;
        color: white;
        /* height: 80%; */
      }
      .card .images {
        height: 70%;
        width: 15%;
        position: relative;
      }
      .card .images img {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        object-fit: cover;
      }
      .card .images .floatingimg {
        position: absolute;
        top: 70%;
        left: 40%;
        height: 45%;
        width: 100%;
      }
      .card .images .floatingimg2 {
        position: absolute;
        top: -10%;
        left: -60%;
        height: 45%;
        width: 100%;
      }
      @keyframes moveone{
        0%,
        100% {
          transform: translateX(0px);
        }
        50% {
          transform: translateX(50px);
        }

      }
      @keyframes movetwo{
        0%,
        100% {
          transform: translateX(10px);
        }
        50% {
          transform: translateX(-25px);
        }

      }
      .card .images .floatingimg {
        animation: moveone 3s infinite;
      }
      .card .images .floatingimg2 {
        animation: movetwo 3s infinite;
      }
      .numbers{
        height: 40vh;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
      }
      .thenum{
        height: 80%;
        width: 30%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
      }
      .thenum p{
        text-align: center;
        margin: 0;
        padding: 0;
        color: white;
      }
      .thenum .num{
        font-size: 4rem;
        font-weight: 800;
      }
      .thenum .name{
        font-size: 1.7rem;
      }
      @media (max-width: 800px) {
        .images{
          width: 60%;
          display: none;
        }
        .cardtext{
          width: 90%;
          padding: 1rem;
        }
        .card{
          height: 100%;
        }
        .heading2{
          font-size: 3rem;
        }
        .banner{
          height: 100%;
        }
        video{
          display: none;
        }
        .thenum{
          width: 70%;
        }
        .numbers{
          height: 100%;
          padding: 2rem 0;
        }
        footer{
          font-size: 0.6rem;
        }
      }
    </style>
  </head>
  <body>
    <video
      muted
      loop
      autoplay
      src="video/Group Of College Students Walking Through College Corridor - Study stock footage - Studying Video (1).mp4"
    ></video>
    <div class="heading">NOWNESS</div>
    <nav class="navbar">
      <div class="links">
        <p><a href="home.php">HOME</a></p>
        <p><a href="form1.php">REGISTER</a></p>
        <?php
        $set=false;
        $file="";
        $show="";

        if(isset($_SESSION['name'])){
          $show="MY PROFILE";
          if(($_SESSION['role']=="admin")){
            $file="admin.php";
          }else{
            $file="profile.php";
          }
        }else{
          $show="LOG IN";
          $file="login.php";
        }
        // if(($_SESSION['role']=="admin")){
        //   $file="admin.php";
        // }else{
        //   $file="prolile.php";
        ?>
        
        <p><a href="<?php echo $file; ?>"> <?php echo $show; ?> </a></p>
        <p><a href="contact.php">CONTACT US</a></p>
        <p><a href="about.php">ABOUT</a></p>
      </div>
    </nav>

    <div class="banner">
      <div class="heading2">#Register and join us</div>

      <!-- <button class="banner_button" type="button">VIEW THE PORGRAM</button> -->
    </div>

    <div class="card">
      <div class="images">
        <img src="images/cardimg.jpg" alt="" />
        <img class="floatingimg" src="images/card2img.jpg" alt="" />
        <img class="floatingimg2" src="images/card3img.avif" alt="" />
      </div>
      <div class="cardtext">
        <p>
          There is no secret to success. It is the result of preparation, hard
          work, and learning from failure. – General Colin Powell
        </p>
        <p>
          It is well to remind ourselves that anxiety signifies a conflict, and
          so long as a conflict is going on, a constructive solution is
          possible. – Rollo May
        </p>
        <p>
          The price of success is hard work, dedication to the job at hand, and
          the determination that whether we win or lose, we have applied the
          best of ourselves to the task at hand.” —Vince Lombardi
        </p>
        <p>
          “The problem is not the problem. The problem is your attitude about
          the problem. Do you understand?” —Captain Jack Sparrow
        </p>
        <p>
          Keep your dreams alive. Understand to achieve anything requires faith
          and belief in yourself, vision, hard work, determination, and
          dedication. Remember all things are possible for those who believe. –
          Gail Devers
        </p>
      </div>
    </div>

    <div class="numbers">
      <div class="thenum registered">
      <?php
        $table="st_profile";
        $r="SELECT COUNT(*) FROM st_profile";
        $res=$conn->query($r);
        $ro=$res->fetch_assoc();
        ?>
        <p class="num"><?php echo $ro['COUNT(*)'];?>+</p>
        <p class="name">Students Registered</p>
      </div>
      <div class="thenum courses">
      <?php
        $table="st_course";
        $r="SELECT COUNT(*) FROM st_course";
        $res=$conn->query($r);
        $ro=$res->fetch_assoc();
        ?>
        <p class="num"><?php echo $ro['COUNT(*)'];?>+</p>
        <p class="name">Courses</p>
      </div>
      <div class="thenum departments">
      <?php 
      $table="st_dept";
      $r="SELECT COUNT(*) FROM st_dept";
      $res=$conn->query($r);
      $ro=$res->fetch_assoc();
      ?>
        <p class="num"><?php echo $ro['COUNT(*)'];?>+</p>
        <p class="name">Departments</p>
      </div>
    </div>

    <footer>
      <ul>
        <li>
          <p id="wave">👋</p>
        </li>
        <li><a class="footerlink" href="home.php">Home</a></li>
        <li><a class="footerlink" href="about.php">About</a></li>
        <li><a class="footerlink" href="form1.php">Register</a></li>
        <li><a class="footerlink" href="login.php">Log in</a></li>
        <li><a class="footerlink" href="contact.php">Contact us</a></li>
      </ul>
    </footer>
  </body>
</html>
