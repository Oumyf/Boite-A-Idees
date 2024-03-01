<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
    .menu {
            /* padding: 20px; */
            /* margin-bottom: 20px; */
            background-color: rgba(250, 100,175, 0.2);
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 10px;
            margin-bottom: 100px;
            padding-left: 30px;
            
            

            
        }

        .menu ul {
            display: flex;
            justify-content: center;
            list-style-type: none;
            margin: 0;
            padding: 30px;
            overflow: hidden;
        }

        .menu li {
            float: left;
            margin-right: 50px;
        }

        .menu li:last-child {
            margin-right: 0;
        }

        .menu li a {
            /* display: block; */
            color: #000;
            text-decoration: none;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .menu li a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="menu">
    <ul>
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="mesidees.php">Mes Idees</a></li>
        <li><a href="categories.php">Liste Catégories</a></li>
        <li><a href="index.php">Connexion</a></li>
        <li><a href="index.php">Déconnexion</a></li>
    </ul>
</div>
</body>
</html>