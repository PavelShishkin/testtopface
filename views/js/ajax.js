$( document ).ready(function() {
    $("#btn_login").click(function() {
			sendAjaxForm('form', '/login'); 
			return false; 
		}
	);
});

$( document ).ready(function() {
    $("#btn_registration").click(function() {
			sendAjaxForm('form', '/registration'); 
			return false; 
		}
	);
});

//Отчистка ошибок
function cleaningElement() {
    var elements = ['error','success',
                    'name', 'surname',
                    'login','password'];
    for(var index in elements) {
        if(document.getElementById(elements[index]) !== null) {
            document.getElementById(elements[index]).innerHTML = "";
        }
    }
}

//Передача POST данных и вывод ошибок 
function sendAjaxForm(form, url) {
    jQuery.ajax({
        url:      url,   
        type:     "POST",
        dataType: "html", 
        data: jQuery("#"+form).serialize(),  
        success: function(response) {
        cleaningElement();
        if(response === 'redirect') {   
            document.location.href="/"; //Если ошибок нет, редирект на главную страницу  
        } else if(response === 'success') {
            //Отчищаю формоу от данных 
            document.getElementById('form').reset(); 
            document.getElementById('success').innerHTML = "Регистрация прошла успешна";
        } else {
            //Массив с ошибками 
            result = JSON.parse(response); 
            //Вывожу ошибки пользователю
            for(var index in result) {
                document.getElementById(index).innerHTML = result[index];
            }
        }
    	}
 	});
}
