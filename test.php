<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background: #d3d3d3;
    }

    #heart {
      font-size: 40px;
      cursor: pointer;
      color: black;
      transition: 0.3s;
    }
  </style>
</head>
<body>

  <span id="heart" onclick="toggleHeart()">❤</span>
 

  <script>
    let liked = false;

    function toggleHeart() {
      const heart = document.getElementById("heart");

      liked = !liked;

      heart.style.color = liked ? "red" : "black";
    }
  </script>

</body>
</html>









