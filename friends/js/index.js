

$(document).ready(function() {

	$.ajax({
		type: "POST",
		url: "../php/friends.php",
		cache: false,
		success: function (res) {
			if(res=='returntoindex'){
				window.location.href = "../index.html"
			}
			var obj=$.parseJSON(res);
			console.log(obj)
			var users = obj.user;
			var $post = $('#main-window').html();
			var posts = '';
			users.forEach(function (user) {
				var single=$post;
				posts += single;
			});
			$('#main-window').html(posts);

			var j=0;
			$.each($('.post'),function(el){
console.log(users[j]);
					var image = ' url("'+users[j].profilepictureURL+'") 50% 50% / cover no-repeat';
					$(this).find('.user-img').css('background',image);
					$(this).find('.user-name').text(users[j].nickname);
					$(this).find('.post-date').text(users[j].hometown);
					$(this).find('.user-id').text(users[j].userid);
					$(this).find('.content').text("");
					$(this).find('.actions').find('.heart').remove();
					j++;

});
		},
		error: function (obj) {

		}


	});
});


function changeClass(element) {
	$(element).toggleClass('heart');
	$(element).toggleClass('hearted');
}
function goUser(element) {
var uid="userid="+$(element).parent().find('.user-id').text();
	$.ajax({
		type: "POST",
		data:uid,
		url: "../php/parseuser.php",
		cache: false,
		success: function (res) {
			window.location.href = "../php/profiles.php";

		},
		error: function (obj) {

		}


	});


}
$("#searchinput").keypress(function (e) {
	var datastring ="search="+$("#searchinput").val();
	if (e.which == 13) {
		$.ajax({
			type: "POST",
			data:datastring,
			url: "../php/parsesearch.php",
			cache: false,
			success: function (res) {
				window.location.href = "../search/"

			},
			error: function (obj) {

			}


		});
}});

function goUser(element) {
	var uid="userid="+$(element).parent().find('.user-id').text();
	$.ajax({
		type: "POST",
		data:uid,
		url: "../php/parseuser.php",
		cache: false,
		success: function (res) {
			window.location.href = "../php/profiles.php";

		},
		error: function (obj) {

		}


	});


}