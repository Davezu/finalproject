<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About JobStreet</title>
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <style>
            .nav-container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px 20px;
                background-color: white;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .logo {
                display: flex;
                align-items: center;
            }
            .nav-links {
                display: flex;
                gap: 20px;
            }
            .nav-links a {
                text-decoration: none;
                color: #333;
                font-weight: 500;
            }
            .nav-links a:hover {
                color: #0d3880;
            }
            .user {
                display: flex;
                align-items: center;
            }
            .username {
                display: flex;
                gap: 15px;
            }
            .user-link {
                text-decoration: none;
                padding: 5px;
            }
            .user-link:last-child {
                color: #0d78e4;
            }
            .team-member-img {
                width: 120px;
                height: 120px;
                object-fit: cover;
                border-radius: 50%;
                margin-bottom: 1rem;
            }
            .footer {
                background-color: #051A49;
            }
        </style>
    </head>
    <body>
        <nav class="nav-container">
            <div class="logo">
            <a href="/">
                <svg viewBox="0 0 248 66" height="40" class="o3fpgs4z _1xd9sxs9 gxyy3e0"><circle cy="32.98" cx="32.98" r="30" fill="#fff" class="_1xd9sxse"></circle><mask id="jobStreetCutArrowOutOfCircle"><circle fill="white" cx="32.98" cy="32.98" r="32.98"></circle><path fill="black" d="M33.76 12.58c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M40.18 19.51c0-1.26 1.02-2.28 2.27-2.28s2.28 1.02 2.28 2.28-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 19.51c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.93-2.06-2.06M47 26.46c0-1.41 1.14-2.55 2.55-2.55s2.55 1.14 2.55 2.55-1.14 2.55-2.55 2.55S47 27.87 47 26.46M40.18 26.44c0-1.26 1.02-2.27 2.27-2.27s2.28 1.02 2.28 2.27-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 26.44c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M27.64 26.44c0-1 .81-1.8 1.8-1.8s1.81.81 1.81 1.8-.81 1.8-1.81 1.8-1.8-.81-1.8-1.8M22.53 26.44c0-.85.69-1.55 1.54-1.55s1.54.69 1.54 1.55-.69 1.55-1.54 1.55-1.54-.69-1.54-1.55M17.66 26.44c0-.71.58-1.29 1.29-1.29s1.29.58 1.29 1.29-.57 1.29-1.29 1.29-1.29-.58-1.29-1.29M13.53 26.44c0-.57.46-1.03 1.03-1.03s1.03.46 1.03 1.03-.46 1.03-1.03 1.03-1.03-.46-1.03-1.03M9.63 26.44c0-.43.34-.77.77-.77s.77.35.77.77-.35.77-.77.77-.77-.35-.77-.77M6.33 26.44c0-.29.23-.51.52-.51s.51.23.51.51-.23.52-.51.52-.52-.23-.52-.52M47 33.39c0-1.41 1.14-2.55 2.55-2.55s2.55 1.15 2.55 2.55-1.14 2.55-2.55 2.55S47 34.8 47 33.39M40.18 33.37c0-1.26 1.02-2.27 2.27-2.27s2.28 1.01 2.28 2.27-1.02 2.28-2.28 2.28-2.27-1.02-2.27-2.28M33.76 33.37c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M27.64 33.37c0-1 .81-1.8 1.8-1.8s1.81.81 1.81 1.8-.81 1.8-1.81 1.8-1.8-.81-1.8-1.8M22.53 33.37c0-.85.69-1.55 1.54-1.55s1.54.69 1.54 1.55-.69 1.54-1.54 1.54-1.54-.69-1.54-1.55M17.66 33.37c0-.71.58-1.29 1.29-1.29s1.29.57 1.29 1.29-.57 1.29-1.29 1.29-1.29-.58-1.29-1.29M13.53 33.37c0-.57.46-1.03 1.03-1.03s1.03.46 1.03 1.03-.46 1.03-1.03 1.03-1.03-.46-1.03-1.03M9.63 33.37c0-.43.34-.77.77-.77s.77.35.77.77-.35.77-.77.77-.77-.35-.77-.77M6.33 33.37c0-.29.23-.52.52-.52s.51.23.51.52-.23.51-.51.51-.52-.23-.52-.52M54 33.44c0-1.55 1.26-2.8 2.8-2.8s2.8 1.25 2.8 2.8-1.25 2.79-2.8 2.79-2.8-1.25-2.8-2.79M47 40.32c0-1.41 1.14-2.55 2.55-2.55s2.55 1.14 2.55 2.55-1.14 2.55-2.55 2.55S47 41.73 47 40.32M40.18 40.3c0-1.26 1.02-2.28 2.27-2.28s2.28 1.02 2.28 2.28-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 40.3c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M27.64 40.3c0-1 .81-1.81 1.8-1.81s1.81.81 1.81 1.81-.81 1.8-1.81 1.8-1.8-.8-1.8-1.8M22.53 40.3c0-.86.69-1.55 1.54-1.55s1.54.69 1.54 1.55-.69 1.54-1.54 1.54-1.54-.69-1.54-1.54M17.66 40.3c0-.72.58-1.29 1.29-1.29s1.29.57 1.29 1.29-.57 1.29-1.29 1.29-1.29-.58-1.29-1.29M13.53 40.3c0-.57.46-1.03 1.03-1.03s1.03.46 1.03 1.03-.46 1.03-1.03 1.03-1.03-.46-1.03-1.03M9.63 40.3c0-.43.34-.78.77-.78s.77.35.77.78-.35.77-.77.77-.77-.35-.77-.77M6.33 40.3c0-.29.23-.52.52-.52s.51.23.51.52-.23.51-.51.51-.52-.23-.52-.52M40.18 47.23c0-1.26 1.02-2.28 2.27-2.28s2.28 1.02 2.28 2.28-1.02 2.27-2.28 2.27-2.27-1.02-2.27-2.27M33.76 47.23c0-1.14.92-2.07 2.06-2.07s2.06.93 2.06 2.07-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06M33.76 54.16c0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06-.92 2.06-2.06 2.06-2.06-.92-2.06-2.06"></path></mask><circle fill="#0d3880" class="_1xd9sxsd" cx="32.98" cy="32.98" r="32.98" mask="url(#jobStreetCutArrowOutOfCircle)"></circle><path fill="#000" class="_1xd9sxsf" d="M82.79 17.04h-5.98V12.2h5.98v4.84Zm0 29.92c0 1.86-.55 3.41-1.64 4.66-1.25 1.43-3.01 2.15-5.3 2.15h-3.38v-5.02h2.26c1.39 0 2.08-.72 2.08-2.15V21.07h5.98v25.9ZM100.97 32.94c0-2.92-.45-4.84-1.36-5.76-.69-.7-1.61-1.05-2.76-1.05s-2.02.35-2.71 1.05c-.9.91-1.36 2.83-1.36 5.76s.45 4.89 1.36 5.8c.69.7 1.6 1.05 2.71 1.05s2.06-.35 2.76-1.05c.9-.91 1.36-2.85 1.36-5.8m5.98 0c0 2.28-.18 4.1-.55 5.44-.4 1.49-1.11 2.77-2.15 3.84-1.86 1.95-4.32 2.92-7.4 2.92s-5.5-.97-7.35-2.92c-1.04-1.07-1.75-2.34-2.15-3.84-.37-1.34-.55-3.15-.55-5.44 0-4.26.91-7.35 2.74-9.27s4.26-2.88 7.31-2.88 5.53.96 7.35 2.88c1.83 1.92 2.74 5.01 2.74 9.27M124.99 32.94c0-2.1-.17-3.61-.5-4.52-.6-1.52-1.76-2.28-3.48-2.28s-2.88.76-3.48 2.28c-.33.91-.5 2.42-.5 4.52s.17 3.61.5 4.52c.6 1.55 1.76 2.33 3.48 2.33s2.87-.78 3.48-2.33c.33-.91.5-2.42.5-4.52m5.98 0c0 2.44-.11 4.26-.32 5.48-.34 1.98-1.04 3.5-2.1 4.57-1.43 1.43-3.37 2.15-5.8 2.15s-4.42-.84-5.94-2.51v2.24h-5.76V12.34h5.98v10.83c1.43-1.58 3.34-2.37 5.74-2.37s4.36.72 5.78 2.15c1.06 1.07 1.76 2.59 2.09 4.57.21 1.22.32 3.03.32 5.44M153.04 37.37c0 2.53-.98 4.48-2.92 5.85-1.83 1.28-4.22 1.92-7.17 1.92-2.22 0-4.04-.2-5.44-.59-1.77-.52-3.33-1.46-4.71-2.83l3.88-3.88c1.49 1.49 3.61 2.24 6.35 2.24s4.2-.82 4.2-2.47c0-1.31-.84-2.04-2.51-2.19l-3.75-.37c-4.63-.46-6.94-2.68-6.94-6.67 0-2.37.93-4.26 2.79-5.66 1.7-1.28 3.84-1.92 6.39-1.92 4.08 0 7.11.93 9.09 2.79l-3.65 3.7c-1.19-1.07-3.03-1.6-5.53-1.6-2.25 0-3.38.76-3.38 2.28 0 1.22.82 1.9 2.47 2.06l3.75.37c4.72.46 7.08 2.79 7.08 6.99M167.16 44.86h-3.24c-2.25 0-4-.72-5.25-2.15-1.1-1.25-1.64-2.8-1.64-4.66V26.26h-2.51v-4.52h2.51v-7.03h5.98v7.03h4.16v4.52h-4.16v11.42c0 1.43.68 2.15 2.03 2.15h2.12v5.02ZM188.35 23.02l-4.48 4.52c-.94-.94-1.99-1.42-3.15-1.42-1.01 0-1.87.35-2.6 1.05-.82.82-1.23 1.93-1.23 3.33v14.34h-5.94v-23.8h5.8v2.28c1.43-1.7 3.43-2.56 5.98-2.56 2.25 0 4.13.75 5.62 2.24M203.88 30.74c-.03-.97-.21-1.83-.55-2.56-.73-1.64-2.06-2.47-3.97-2.47s-3.24.82-3.97 2.47c-.34.73-.52 1.58-.55 2.56h9.04Zm5.85 4.07h-14.89c0 1.58.46 2.86 1.39 3.84.93.97 2.2 1.46 3.81 1.46 2.1 0 3.9-.75 5.39-2.24l3.61 3.52c-1.31 1.31-2.59 2.24-3.84 2.79-1.43.64-3.17.96-5.21.96-7.34 0-11.01-4.07-11.01-12.2 0-3.81.96-6.81 2.88-9 1.86-2.1 4.35-3.15 7.49-3.15s5.79 1.08 7.67 3.24c1.8 2.07 2.69 4.78 2.69 8.13v2.65ZM227.36 30.74c-.03-.97-.21-1.83-.55-2.56-.73-1.64-2.06-2.47-3.97-2.47s-3.24.82-3.97 2.47c-.34.73-.52 1.58-.55 2.56h9.04Zm5.85 4.07h-14.89c0 1.58.46 2.86 1.39 3.84s2.2 1.46 3.81 1.46c2.1 0 3.9-.75 5.39-2.24l3.61 3.52c-1.31 1.31-2.59 2.24-3.84 2.79-1.43.64-3.17.96-5.21.96-7.34 0-11.01-4.07-11.01-12.2 0-3.81.96-6.81 2.88-9 1.86-2.1 4.35-3.15 7.49-3.15s5.79 1.08 7.67 3.24c1.8 2.07 2.69 4.78 2.69 8.13v2.65ZM247.87 44.86h-3.24c-2.25 0-4-.72-5.25-2.15-1.1-1.25-1.64-2.8-1.64-4.66V26.26h-2.51v-4.52h2.51v-7.03h5.98v7.03h4.16v4.52h-4.16v11.42c0 1.43.68 2.15 2.03 2.15h2.12v5.02Z"></path>
                </svg>
            </a>
            </div>
            <div class="nav-links">
                <a href=">Job Search</a>
                <a href="/user.php">Home</a>
                <a href="/about.php">About</a>
                <a href="/faq.php">FAQ</a>
                <a href="/contact.php">Contact</a>
            </div>
            <div class="user">
                <div class="username">
                    <a href="" class="user-link text-dark">Dave</a>
                    <a href="" class="user-link">Edit Content</a>
                    </div>
                </div>
            </nav>
            <header class="py-5">
                <div class="container px-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-xxl-6">
                            <div class="text-center my-5">
                                <h1 class="fw-bolder mb-3">Our mission is to make building websites easier for everyone.</h1>
                                <p class="lead fw-normal text-muted mb-4">Start Bootstrap was built on the idea that quality, functional website templates and themes should be available to everyone. Use our open source, free products, or support us by purchasing one of our premium products or services.</p>
                                <a class="btn btn-primary btn-lg" href="#scroll-target">Read our story</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- About section one-->
            <section class="py-5 bg-light" id="scroll-target">
                <div class="container px-5 my-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="https://ap-southeast-2-seek-apac.graphassets.com/AEzBCRO50TYyqbV6XzRDQz/resize=fit:crop,width:900,height:600/6O2QAv2LSuCthpQ3lxkv" alt="..." /></div>
                        <div class="col-lg-6">
                            <h2 class="fw-bolder">Our founding</h2>
                            <p class="lead fw-normal text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About section two-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="https://ap-southeast-2-seek-apac.graphassets.com/AEzBCRO50TYyqbV6XzRDQz/resize=fit:max,width:1280,height:1280/HNarsViHTHS0GtUU0iWW" alt="about" /></div>
                        <div class="col-lg-6">
                            <h2 class="fw-bolder">Growth &amp; expansion</h2>
                            <p class="lead fw-normal text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Team members section-->
            <section class="py-5 bg-light">
                <div class="container px-5 my-5">
                    <div class="text-center">
                        <h2 class="fw-bolder">Our team</h2>
                        <p class="lead fw-normal text-muted mb-5">Dedicated to quality and your success</p>
                    </div>
                    <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
                        <div class="col mb-5 mb-5 mb-xl-0">
                            <div class="text-center">
                                <img class="team-member-img" src="https://avatarfiles.alphacoders.com/375/thumb-1920-375281.jpeg" alt="Ibbie Eckart" />
                                <h5 class="fw-bolder">Sung Jinwoo</h5>
                                <div class="fst-italic text-muted">Founder</div>
                            </div>
                        </div>
                        <div class="col mb-5 mb-5 mb-xl-0">
                            <div class="text-center">
                                <img class="team-member-img" src="https://th.bing.com/th/id/OIP.QnN8IvHkp4FCJ7QkoWjRSQAAAA?rs=1&pid=ImgDetMain" alt="Arden Vasek" />
                                <h5 class="fw-bolder">Cha Hae-in</h5>
                                <div class="fst-italic text-muted">Team Lead</div>
                            </div>
                        </div>
                        <div class="col mb-5 mb-5 mb-sm-0">
                            <div class="text-center">
                                <img class="team-member-img" src="https://images.hdqwalls.com/download/son-goku-dragon-ball-super-anime-retina-display-5k-u1-2048x2048.jpg" alt="Toribio Nerthus" />
                                <h5 class="fw-bolder">Son Goku</h5>
                                <div class="fst-italic text-muted">Co-Founder</div>
                            </div>
                        </div>
                        <div class="col mb-5">
                            <div class="text-center">
                                <img class="team-member-img" src="https://i.pinimg.com/originals/a5/c5/94/a5c5942bb11acf051f1a522b65073f4b.png" alt="Malvina Cilla" />
                                <h5 class="fw-bolder">Vegeta</h5>
                                <div class="fst-italic text-muted">CEO</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class=" footer py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; Your Website 2023</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="#!">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Terms</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Contact</a>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
