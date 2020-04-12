<div class="container">
<?php
bs()->alert('Welcome to MFWork 0.1', 'primary');
if (!auth()->check()) {
    bs()->alert('Register here: <a href="user/register">Register</a>', 'secondary');
}
else bs()->alert("You are logged in.", "primary");

?>

</div>