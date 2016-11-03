<!DOCTYPE html>

<html lang="en"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Регистрация</title>
	<link rel="stylesheet" href="<? asset('views/css/style.css') ?>">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="<? asset('views/js/ajax.js') ?>"></script>
</head>
<body>

  <section class="container">
    <div class="login">
      <h1>Регистрация</h1>
      
      <form method="post" id="form"> 
        <p>
            <h2 class="error" id="name"> </h2>    
            <input type="text" name="name" value="" placeholder="Имя">
            <h2 class="error" id="surname"> </h2>
            <input type="text" name="surname" value="" placeholder="Фамилия">
        </p>
        <p>
            <h2 class="error" id="login"> </h2>
            <input type="text" name="login" value="" placeholder="Логин для входа на сайт"></p>
        <p>
            <h2 class="error" id="password"> </h2>
            <input type="password" name="password" value="" placeholder="Пароль">
            <input type="password" name="password2" value="" placeholder="Пароль еще раз">
        </p>
        <h2 id="success"></h2>
        
        <p class="remember_me">
          <label>
            <a href="/login">Войти на сайт</a> 
          </label>
        </p>
        <p class="submit">
            <input type="submit"  id="btn_registration" value="Зарегистрироваться">
          </p>
      </form>
      
      <br>
      
      
    </div>
  </section>
</body>
</html>