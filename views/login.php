<!DOCTYPE html>

<html lang="en"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Вход</title>
	<link rel="stylesheet" href="<? asset('views/css/style.css') ?>">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="<? asset('views/js/ajax.js') ?>"></script>
</head>
<body>

  <section class="container">
    <div class="login">
      <h1>Вход</h1>
      
      <form method="post" id="form">
        
        <p>
            <h2 class="error" id="login"> </h2>
            <input type="text" name="login" value="" placeholder="Логин">
        </p>
        
        <p>
            <h2 class="error" id="password"> </h2>
            <input type="password" name="password" value="" placeholder="Пароль">
            
        </p>
      
        <h2 id="error"> </h2>
      
        <p class="remember_me">
          <label>
            <a href="/registration">Зарегистрироваться</a> 
          </label>
        </p>
      
        <p class="submit">
            <input type="submit" id="btn_login" value="Войти">
        </p>
      </form>
        
    </div>
  </section>
</body>
</html>
