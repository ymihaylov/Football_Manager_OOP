$("input#login-btn").on("click", function (e) {
	e.preventDefault();
	if($("#username-login").val() === "") {
		$("#login-info-text").text("Username field is empty ...");
	} else if ($("#password-login").val() === "") {
		$("#login-info-text").text("Password field is empty ...");
	} else {
		$.ajax({
			url: $("#login-form").attr("action"),
			type: $("#login-form").attr("method"),
			timeout: 30000,
			dataType: "json",
			data: $("#login-form :input").serializeArray(),
			complete: function (data) {
				clear_form_fields('login-form');
				$("#login-info-text").text(data.responseJSON.message);
				if(data.responseJSON.logged) {
					window.location = "teams.php";
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
				if(data.responseJSON.registred) {
					window.location = "teams.php";
				}
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


$(".edit-btn").on("click", function(e){
	e.preventDefault();
	var entire_row = $(this).parent().parent();
	var current_team_info = {
			team_name: $(entire_row).children(".team-name-cell").text(),
			team_coach: $(entire_row).children(".team-coach-cell").text(),
			team_sponsor: $(entire_row).children(".team-sponsor-cell").text()
	};
	if($(entire_row).data("edit") === false)
	{
		$(entire_row).data("edit", true);
		$(entire_row).addClass("edit-row");
		$(this).parent().addClass("edit-bg-color");
		$(entire_row).children(".team-name-cell").append(
			'<input class="edit-input" type="text" value="'+current_team_info.team_name+'" />');
		$(entire_row).children(".team-coach-cell").append(
			'<input type="text" value="'+current_team_info.team_coach+'" />');
		$(entire_row).children(".team-sponsor-cell").append(
			'<input type="text" value="'+current_team_info.team_sponsor+'" />');
		$("#buttons-container").css("display", "block");
	}
	else
	{
		$(entire_row).children("td.editable").children("input").remove();
		$(entire_row).data("edit", false);
		$(entire_row).removeClass("edit-row");
		$(this).parent().removeClass("edit-bg-color");
		if($("tr.edit-row").length === 0)
		{
			$("#buttons-container").css("display", "none");
		}
	}
});

$("#save-changes-btn").on("click", function(e) {
	var edited_teams_array = [];
	$("#information-table tbody tr").each(function(e) {
		if($(this).data("edit")) {
			var edited_team_obj = {
				id: $(this).data("id"),
				team_name: $(this).children(".team-name-cell").children().val(),
				team_coach: $(this).children(".team-coach-cell").children().val(),
				team_sponsor: $(this).children(".team-sponsor-cell").children().val()
			};
			edited_teams_array.push(edited_team_obj);
		}
	});
	var json_string = JSON.stringify(edited_teams_array);
		$.ajax({
			url: "processes/update-teams.php",
			type: "POST",
			timeout: 30000,
			dataType: "json",
			data: {data: json_string},
			complete: function (data) {
				$("#update-info-text").text(data.responseJSON.message)
										.css("display", "block");
				set_all_rows_for_read(edited_teams_array);
			}
		});
});

$("#discard-changes-btn").on("click", function(e) {
	set_all_rows_for_read();
});

function set_all_rows_for_read(edited_teams) {
	$("tr.edit-row").each(function(index) {
		var this_id = $(this).data("id");
		for (var i = 0; i < edited_teams.length; i++) {
			if(edited_teams[i].id === this_id) {
				$(this).children(".team-name-cell").text(edited_teams[i].team_name);
				$(this).children(".team-sponsor-cell").text(edited_teams[i].team_sponsor);
				$(this).children(".team-coach-cell").text(edited_teams[i].team_coach);
			}
		}
		$(this).children("td.editable").children("input").remove();
		$(this).data("edit", false);
		$(this).removeClass("edit-row");
		$(this).children(".edit-team-cell").removeClass("edit-bg-color");
	});

	$("#buttons-container").hide();
}

$(".delete-cell").on("click", function(e) {
	e.preventDefault();
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height:200,
      modal: true,
      buttons: {
        "Delete all items": function() {
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
});