$("input#login-btn").on("click", function (e) {
	if($("#username-login").val() === "") {
		$("#login-info-text").text("Username field is empty ...");
	} else if ($("#password-login").val() === "") {
		$("#login-info-text").text("Password field is empty ...");
	} else {
		$.ajax({
			url: $("#login-form").attr("action"),
			type: $("#login-form").attr("method"),
			timeout: 30000,
			data: $("#login-form :input").serializeArray(),
			success: function (data) {
				if(data === "LoggedIn") {
					window.location.replace("teams.php");
				} else {
					$("#login-info-text").text(data);
				}
			}
		});
	}

	$("#login-form").submit(function() {
		return false;
	});
});

$("input#registrer-btn").on("click", function (e) {
	if($("#username-reg").val() === "" || $("#password-reg").val() === "" || $("password-retype-reg").val() === "") {
		$("#reg-info-text").text("You dont fill all fields");
	} else if($("#password-reg").val() != $("#password-retype-reg").val()) {
		$("#reg-info-text").text("Passwords dont match");
	} else {
		$.ajax({
			url: "processes/process.php",
			type: "POST",
			timeout: 30000,
			dataType: "json",
			data: $("#registration-form :input").serializeArray(),
			complete: function (data) {
				clear_form_fields('registration-form');
				$("#reg-info-text").text(data.responseJSON.message);
			}
		});
	}
	$("#registration-form").submit(function() {
		return false;
	});
});

function clear_form_fields(form)
{
	var form_string_text = "#" + form + " :text";
	var form_string_password = "#" + form + " :password";
	$(form_string_text).each(function() {
		$(this).val('');
	});

	$(form_string_password).each(function() {
		$(this).val('');
	});
}


		$("#registration-form").submit(function() {
		return false;
	});