<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>Contact us</title>
    <style>
        body{
            background-color: #002a38;
        color: white;
        height: 90vh;
        width: 100vw;
        }
        header{
            height: 30vh;
        }
      main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 40vh;
        width: 100vw;
        gap: 5%;
        background-color: #002a38;
        color: white;
      }
      i {
        font-size: 8rem;
        color: white;
        cursor: pointer;
        transition: 0.3s all ease;
      }
      i:hover{
        transform: scale(0.9);
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
        justify-content: center;
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
        border-bottom: 3px solid #002a38;
      }
      .links{
        display: flex;
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
    </style>
  </head>

  <body>
    <header>
        <div class="heading">NOWNESS</div>
        <nav class="navbar">
          <div class="links">
            <p><a href="home.php">HOME</a></p>
            <p><a href="">ABOUT</a></p>
            <p><a href="form1.php">REGISTER</a></p>
            <p><a href="login.php">LOGIN</a></p>
            <p><a href="contact.php">CONTACT US</a></p>
          </div>
        </nav>
    </header>
    <main>
        <i class="fa-brands fa-facebook"></i>
        <i class="fa-brands fa-instagram"></i>
        <i class="fa-brands fa-youtube"></i>
        <i class="fa-brands fa-linkedin"></i>
        <i class="fa-brands fa-twitter"></i>
    </main>
   
  </body>
</html>
