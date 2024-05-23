<?php
include 'connect.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="./style.css">
    
</head>
<body>
    <header class="header">
        <na>
        <div class="banner">

            <div >
                <h3 class="iam">Hi, I am</h3>
                <h1 class="saied">Sa<span style="color:yellow">i</span>ed Hasan</h1>
                <p style="">This is my official portfolio website to show all details and work experience on web development.</p>.</p>
                <br>
            </div>
            <div class="image">
                <img src="assets/my-bg2.png" width: 150px;height: 150px; alt="">
            </div>
        </div>
    </header>
    <main>
        <section class="About">
            <h3 class="sectiontitle">About Me</h3>
            <p class="section-p">I'm a designer & developer with a passion for web design. I enjoy developing simple, clean, and slick websites that provide real value to the end user. Thousands of clients have procured exceptional results while working with me. Delivering work within time and budget that meets clients' requirements is our mantra.</p>
            <div class="about-info-container">
                <div class="about-info">
                    <p>Name:</p>
                    <p>Saied Hasan</p>
                </div>
                <div class="about-info">
                    <p>Email:</p>
                    <p>hasan15-3903@diu.edu.bd</p>
                </div>
                <div class="about-info">
                    <p>Date Of Birth</p>
                    <p>28-10-2000</p>
                </div>
                <div class="about-info">
                    <p>From</p>
                    <p>Kushtia,Bangladesh</p>
                </div>
            </div>
        </section>
        <!-- What I do -->
        <section class="whatido"">
            <div>
                <h3 class="h3">What I Do</h3>
                <p class="lorem">I am a  student of BSc engineering and also a web developer. I combine my academic studies with practical experience in web development. I actively engage in coursework while dedicating time to coding, designing, and building websites to expand my skills and knowledge in the field.</p></div>
            <div class="allskills">
                <div class="skill">
                    <img src="./assets/icons/js.png" alt="">
                    <br>
                    <p class="skilltitle">JavaScript</p>
                    <br>
                    <p class="descriptio">In my journey as a web developer, JavaScript (JS) has been a fundamental language in my toolkit. It enables me to create dynamic and interactive web applications, enhancing the user experience and adding versatility to my development projects.</p>
                </div>
                <div class="skill">
                    <img src="./assets/icons/react.png" alt="">
                    <p class="skilltitle">React</p>
                    <br>
                    <p 
                
                    class="descriptio">React is a powerful JavaScript library that I've mastered in my role as a web developer. Its component-based architecture allows me to efficiently build modern and responsive user interfaces for web applications.</p>
                </div>
                <div class="skill">
                    <img src="./assets/icons/nodejs.png" alt="">
                    <p class="skilltitle">Node.js</p>
                    <br>
                    <p class="descriptio">Node.js is an essential tool in my web development arsenal, enabling me to build server-side applications with JavaScript. Its non-blocking, event-driven architecture ensures scalable and high-performance solutions for various web projects.   
                    </p>
                </div>
                <div class="skill">
                    <img src="./assets/icons/mongo.png" alt="">
                    <p class="skilltitle">MongoDB</p>
                    <br>
                    <p class="descriptio">MongoDB is my preferred NoSQL database for web development, offering flexibility and scalability for data storage. Its document-oriented model and robust query capabilities enable me to efficiently manage and retrieve data in diverse web applications.</p>
                </div>
            </div>
        </section>
        <section class="resume">
            <div>
                <h3 class="title">A summary of my Resume</h3>
                <div class="edu-exp">
                    
                    <div class="education">
                        <h3 class="resume-title">My education</h3>
                        <div>
                            <h3 class="sub">BSC in Computer Engineering</h3>
                            <h4 class="university">Daffodil International University</h4>
                            <p class="p"><span>"I am currently a final-year student pursuing a Bachelor of Science (BSc) degree at Daffodil International University. I embarked on this academic journey in 2020, and throughout my years of study, I have gained valuable knowledge and skills in my field. As I approach graduation, I am excited to apply my education and experiences to real-world challenges and opportunities."</span></p>
                        </div>
                        <hr style="border: 1px solid #D1D1D1;">
                        <div>
                            <h3 class="sub">HSC</h3>
                            <h4 class="university">Cantonment College Jessore / 2016 - 2018</h4>
                            <p><span>I have completed my hsc in 2018 from Jessore Cantonment College with CGPA 4.42.</span></p>

                        </div>
     
    
                    </div>
                    <div class="experience">
    
                        <h3 class="resume-title">My Experience</h3>
                       
                        <hr style="border: 1px solid #D1D1D1;">
                        <div>
                            <h3 class="sub">Jr. Font End Developer</h3>
                            <h4 class="university">Programming hero/ 2022</h4>
                            <p class="p"><span>
                                As a frontend developer, I completed a programming course with Programming Hero in 2022. This comprehensive training has equipped me with the latest skills and knowledge to excel in web development, enabling me to create visually appealing and user-friendly websites while staying updated with industry best practices and trends.

                        </div> 
                        <hr style="border: 1px solid #D1D1D1;">
    
                        <div>
                            <h3 class="sub">HTML Developer</h3>
                            <h4 class="university">Programming Hero / 2022</h4>
                            <p><span>
                                As an HTML Developer at Programming Hero from 2017 to 2018, I played a pivotal role in crafting user-friendly web solutions. My responsibilities included designing and coding clean, responsive websites that not only met client objectives but also exceeded their expectations. I contributed to a talented team, ensuring the delivery of visually engaging and impactful online experiences.</span></p>
    
                        </div>
                    </div>    
                </div>
                <div style="text-align: center; margin-top: 20px;">
                    <a style="background: #FD6E0A; width: 166px;height: 27px; " href="contact.php">Contact Me</a>
                </div>
            </div>
        </section>


    </main>

    <?php include 'footer.php' ?>
</body>
</html>