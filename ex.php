<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Plantopia Oasis – Catalog</title>
<style>
    :root{
  --bg1:#2b3f3a;
  --bg2:#3e5f56;
  --panel:#415f58;
  --card:#3a5851;
  --sidebar:#0f1a17;
  --text:#eaf5f1;
  --muted:#b6d0c8;
  --accent:#d6a84a;
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:"Segoe UI",sans-serif;
}
/* APP */
.app{
  width:95%;
  height:95vh;
  margin:20px auto;
  border-radius:26px;
  overflow:hidden;
  display:flex;
  background:linear-gradient(135deg,#2f4f47,#3e5f56);
  box-shadow:0 40px 80px rgba(0,0,0,.5);
}

/* SIDEBAR */
.sidebar{
  width:260px;
  background:linear-gradient(180deg,#0c1512,#13231f);
  padding:24px;
  color:#fff;
  display:flex;
  flex-direction:column;
}

.brand{
  font-weight:600;
  margin-bottom:30px;
}

.menu{
  list-style:none;
}

.menu li{
  padding:12px 14px;
  border-radius:10px;
  margin-bottom:6px;
  color:#cfe5dd;
  cursor:pointer;
  transition:.3s;
}

.menu li.active,
.menu li:hover{
  background:#1f332e;
  color:#fff;
}

.sidebar-plant{
  margin-top:auto;
}

.sidebar-plant img{
  width:100%;
  filter:drop-shadow(0 20px 30px rgba(0,0,0,.6));
}

/* MAIN */
.main{
  flex:1;
  padding:26px;
  color:var(--text);
  overflow-y:auto;
}

/* TOP BAR */
.topbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.update{
  font-size:12px;
  color:var(--muted);
}

/* CATEGORIES */
.categories{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:16px;
  margin:22px 0;
}

.cat{
  background:var(--panel);
  padding:14px;
  border-radius:14px;
  display:flex;
  align-items:center;
  gap:12px;
}

.cat.active{
  outline:2px solid var(--accent);
}

.cat img{
  width:42px;
}

.cat small{
  display:block;
  font-size:12px;
  color:var(--muted);
}

/* FILTER BAR */
.filter-bar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:20px;
}

.filters span{
  background:#3a5851;
  padding:6px 14px;
  border-radius:20px;
  font-size:12px;
  margin-right:8px;
  color:#cfe5dd;
}

.filters .active{
  background:var(--accent);
  color:#000;
}

.search{
  background:#3a5851;
  border:none;
  padding:8px 14px;
  border-radius:10px;
  color:#fff;
}

/* CARDS */
.cards{
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:18px;
}

.card{
  background:linear-gradient(180deg,#415f58,#3a5851);
  border-radius:20px;
  padding:18px;
  display:flex;
  gap:16px;
  transition:.35s;
}

.card:hover{
  transform:translateY(-6px);
  box-shadow:0 20px 40px rgba(0,0,0,.45);
}

.card img{
  width:80px;
  filter:drop-shadow(0 12px 20px rgba(0,0,0,.45));
}

.card h3{
  font-size:15px;
  margin-bottom:6px;
}

.card p{
  font-size:12px;
  color:var(--muted);
  line-height:1.4;
}

.meta{
  display:flex;
  gap:14px;
  margin-top:10px;
  font-size:12px;
}

.meta span{
  color:var(--accent);
}

</style>
</head>
<body>

<div class="app">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="brand">🌿 Plantopia Oasis</div>

    <ul class="menu">
      <li>Dashboard</li>
      <li>Analytics</li>
      <li class="active">Catalog</li>
      <li>Tasks</li>
      <li>Profile</li>
      <li>Settings</li>
    </ul>

    <div class="sidebar-plant">
      <img src="https://i.imgur.com/JYUbk7k.png" alt="">
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <!-- TOP BAR -->
    <div class="topbar">
      <h1>Catalog</h1>
      <span class="update">Last update: Today, 09:33AM</span>
    </div>

    <!-- CATEGORY BOXES -->
    <div class="categories">
      <div class="cat active">
        <img src="https://i.imgur.com/4AiXzf8.png">
        <div>
          <strong>HERBS</strong>
          <small>52 Plants</small>
        </div>
      </div>

      <div class="cat">
        <img src="https://i.imgur.com/8Km9tLL.png">
        <div>
          <strong>FLOWERS</strong>
          <small>42 Plants</small>
        </div>
      </div>

      <div class="cat">
        <img src="https://i.imgur.com/4AiXzf8.png">
        <div>
          <strong>CACTUS</strong>
          <small>25 Plants</small>
        </div>
      </div>

      <div class="cat">
        <img src="https://i.imgur.com/8Km9tLL.png">
        <div>
          <strong>TREE</strong>
          <small>116 Plants</small>
        </div>
      </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-bar">
      <div class="filters">
        <span class="active">All</span>
        <span>Indoor</span>
        <span>Outdoor</span>
        <span>Garden</span>
        <span>Flowering</span>
        <span>Hanging</span>
      </div>
      <input class="search" placeholder="Search">
    </div>

    <!-- PRODUCT GRID -->
    <div class="cards">

      <div class="card">
        <img src="https://i.imgur.com/4AiXzf8.png">
        <div>
          <h3>POTHOS (EPIPREMNUM)</h3>
          <p>Fast growing trailing plant with heart-shaped leaves.</p>
          <div class="meta">
            <span>Medium</span>
            <span>Orchid</span>
            <span>14.5"</span>
            <span>82%</span>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="https://i.imgur.com/8Km9tLL.png">
        <div>
          <h3>CALATHEA ORBIFOLIA</h3>
          <p>Elegant tropical plant with patterned leaves.</p>
          <div class="meta">
            <span>Medium</span>
            <span>Orchid</span>
            <span>14.5"</span>
            <span>82%</span>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="https://i.imgur.com/4AiXzf8.png">
        <div>
          <h3>FIDDLE-LEAF FIG</h3>
          <p>Large violin-shaped leaves indoor plant.</p>
          <div class="meta">
            <span>Medium</span>
            <span>Asparagus</span>
            <span>12.8"</span>
            <span>78%</span>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="https://i.imgur.com/8Km9tLL.png">
        <div>
          <h3>SNAKE PLANT</h3>
          <p>Low maintenance air purifying plant.</p>
          <div class="meta">
            <span>Small</span>
            <span>Asparagus</span>
            <span>5.8"</span>
            <span>56%</span>
          </div>
        </div>
      </div>

    </div>

  </main>
</div>

</body>
</html>



