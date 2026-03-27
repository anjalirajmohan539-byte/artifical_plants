<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Premium Sidebar</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
}

/* Sidebar */
.sidebar {
    position: fixed;
    width: 250px;
    height: 100%;
    background: #1e1e2f;
    color: #fff;
    transition: 0.3s;
    overflow-y: auto;
}

/* Collapsed */
.sidebar.collapsed {
    width: 70px;
}

/* Logo */
.sidebar .logo {
    text-align: center;
    padding: 20px;
    font-size: 22px;
    font-weight: bold;
    background: #151522;
}

/* Menu */
.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 15px;
    cursor: pointer;
    transition: 0.3s;
}

.sidebar ul li:hover {
    background: #343456;
}

.sidebar ul li i {
    margin-right: 10px;
}

/* Hide text when collapsed */
.sidebar.collapsed ul li span {
    display: none;
}

/* Content */
.content {
    margin-left: 250px;
    padding: 20px;
    transition: 0.3s;
}

.content.full {
    margin-left: 70px;
}

/* Topbar */
.topbar {
    background: #fff;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.toggle-btn {
    font-size: 20px;
    cursor: pointer;
}

/* Dropdown */
.submenu {
    display: none;
    padding-left: 20px;
    background: #2a2a40;
}

.submenu li {
    padding: 10px;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="logo">Admin</div>

    <ul>
        <li><i class="fas fa-home"></i> <span>Dashboard</span></li>

        <li onclick="toggleMenu(this)">
            <i class="fas fa-box"></i> <span>Products</span>
        </li>
        <ul class="submenu">
            <li>Add Product</li>
            <li>View Product</li>
        </ul>

        <li><i class="fas fa-shopping-cart"></i> <span>Orders</span></li>
        <li><i class="fas fa-users"></i> <span>Users</span></li>
        <li><i class="fas fa-cog"></i> <span>Settings</span></li>
        <li><i class="fas fa-sign-out-alt"></i> <span>Logout</span></li>
    </ul>
</div>

<!-- Content -->
<div class="content" id="content">

    <div class="topbar">
        <span class="toggle-btn" onclick="toggleSidebar()">☰</span>
    </div>

    <h2>Dashboard</h2>
    <p>Welcome to your premium admin panel 🚀</p>

</div>

<script>
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("collapsed");
    document.getElementById("content").classList.toggle("full");
}

function toggleMenu(element) {
    let submenu = element.nextElementSibling;
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>






