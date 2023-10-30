# SNIPPETS
## PHP
### Redirect a otra página con parámetros GET
```php
$dir = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/main.php?success=$loginEmail";
header("Location:$dir", true, 302);
```
### Console log
```php
echo "<script type='text/javascript'>console.log('loginEmail: $loginEmail');</script>";
echo "<script type='text/javascript'>console.log('loginPassword: $loginPassword');</script>";
echo "<script type='text/javascript'>console.log('loginCheck: $loginCheck');</script>";
```


