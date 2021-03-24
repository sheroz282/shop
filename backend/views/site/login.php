<?php
    include_once __DIR__ . "/../header.php";
?>

<style>
#login-container {
    width: 300px;
    margin: 0 auto;
}
</style>

<div id="login-container" class="width1024">
    <div><br><br><br><br></div>
    <h1>Login</h1>
    <form action="/backend/index.php?model=auth&action=check" method="POST">
        <div>
            <label>Login:</label><input type="text" name="login">
        </div>
        <div>
            <label>Password:</label><input type="password" name="password">
        </div>
        <div><br></div>
        <div>
            <input type="submit" value="login">
        </div>
    </form>
    <div><br><br><br><br></div>
</div>

<?php
    include_once __DIR__ . "/../footer.php";
?>