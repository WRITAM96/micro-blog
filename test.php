<style>
  .navbar {
    position: fixed;
    top: 0;
    right: 0;
    display: flex;
    align-items: center;
    background-color: #1DA1F2;
    color: #fff;
    padding: 10px;
    width: 300px;
    height: 100vh;
    flex-direction: column;
  }

  .navbar__logo {
    font-size: 20px;
    font-weight: bold;
    color: #fff;
    text-decoration: none;
    margin-bottom: 20px;
  }

  .navbar__links {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .navbar__link {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
  }

  .navbar__link:hover {
    text-decoration: underline;
  }
</style>

<nav class="navbar">
  <a class="navbar__logo" href="#">Logo</a>
  <div class="navbar__links">
    <a class="navbar__link" href="#">Home</a>
    <a class="navbar__link" href="#">Explore</a>
    <a class="navbar__link" href="#">Notifications</a>
    <a class="navbar__link" href="#">Messages</a>
    <a class="navbar__link" href="#">Bookmarks</a>
    <a class="navbar__link" href="#">Profile</a>
    <a class="navbar__link" href="#">More</a>
    <a class="navbar__link" href="#">Logout</a>
  </div>
</nav>
