<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
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
        main{
            margin: 2rem 0;
            display: flex;
            align-items: center;
            justify-content: space-around;
            height: 100%;
            width: 100%
            
        }
        .image{
            width: 30%;
            height: 40%;
        }
        .image img{
            height: 100%;
            width: 100%;
            border-radius: 8px;
        }
        .text{
            width: 60%;
            height: 100%;
            word-spacing: 7px;
            line-height: 130%;
            word-spacing: 7px;
            line-height: 130%;
            font-size: 0.8rem;
        }
        body{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
    </style>
</head>

<body>
    <header class="">
        <div class="heading ">ABOUT US</div>
        <nav class="navbar">
            <p><a href="home.php">HOME</a></p>
            <p><a href="about.php">ABOUT</a></p>
            <p><a href="form1.php">REGISTER</a></p>
            <p><a href="login.php">LOGIN</a></p>
            <p><a href="contact.php">CONTACT US</a></p>
        </nav>
        </div>
    </header>

    <main>
        <div class="image">
            <img src="./images/student.jpg" alt="">
        </div>
        <div class="text">
            <p>One of the oldest Universities in India, the ABC initiated at Lahore in 1882, has a long
                tradition of pursuing excellence in teaching and research in science and technology, humanities, social
                sciences, performing arts and sports. The University supports excellence and innovation in academic
                programmes, promotes excellence in research, scholarship and teaching.Panjab University The University is
                committed to attract and support the best students and faculty, who excel at teaching and research. In
                independent India, Panjab University with its Campus at Chandigarh and nearly 202 affiliated colleges in
                ABC state and Chandigarh U.T., has served various societal needs with distinction. The glorious
                traditions of the University established during the period of more than 140 years of its long service to the
                nation since its inception are a source of inspiration for the present generation of faculty members and
                students. By virtue of its history, experience, achievements and philosophy, the Panjab University has a
                national character and it enjoys an international stature drawing both faculty and students from all over
                the country and different parts of the globe. Its faculty includes some of the most distinguished scientists
                and academicians. It continues to attract celebrated scholars at the campus. Over the years, the reputation
                of the Panjab University has grown to emerge as an institution at the pinnacle in innovative teaching,
                research and community outreach. In Chandigarh, the newly built capital of ABC, a beautiful red sandstone
                campus was designed for the Panjab University by Pierre Jeanneret under the general guidance of Le
                Corbusier. ABC University moved here during 1958-1960. Till the re-organisation of ABC in 1966, the
                University had its regional centres at Rohtak, Shimla and Jalandhar and its affiliated colleges were located
                in the States of ABC, Haryana and Himachal Pradesh and the Union Territory of Chandigarh. With the
                re-organization of ABC, the University became an Inter-State Body Corporate catering to the newly
                organized States of Haryana, Himachal Pradesh and ABC and the Union Territory of Chandigarh. Gradually,
                the colleges of Himachal and Haryana were affiliated to the Universities in the respective states and the
                Panjab University was left with the affiliated colleges in the Union Territory of Chandigarh and some parts
                of ABC. The Panjab University Campus at Chandigarh accommodates seventy four teaching and research
                departments/institutes/centres besides six independent Chairs for re</p>
        </div>
       
        
    </main>
    <footer>
        <ul>
            <li>
                <p id="wave">👋</p>
            </li>
            <li><a class="footerlink" href="home.php">Home</a></li>
            <li><a class="footerlink" href="#">About</a></li>
            <li><a class="footerlink" href="form1.php">Register</a></li>
            <li><a class="footerlink" href="login.php">Log in</a></li>
            <li><a class="footerlink" href="#">Contact us</a></li>
        </ul>
    </footer>
</body>

</html>