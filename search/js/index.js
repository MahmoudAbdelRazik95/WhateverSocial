

$(document).ready(function() {

	$.ajax({
		type: "POST",
		url: "../php/search.php",
		cache: false,
		success: function (res) {
			if(res=='returntoindex'){
				window.location.href = "../index.html"
			}
			console.log(res);
			var obj=$.parseJSON(res);
			var poss=(obj.posts.post);
			var users = obj.users.user;
			var pp = obj.pp;
			console.log(obj);
			if(pp!=undefined){
			var image = ' url("'+pp+'") 50% 50% / cover no-repeat';
			$(".profile").css('background',image);}
			var $post = $('#main-window').html();
			var posts = '';
			if(poss!=undefined){
			poss.forEach(function (user) {
				var single=$post;
				posts += single;
			});}
			if(users!=undefined){
			users.forEach(function (user) {
				var single=$post;
				posts += single;
			});}
			$('#main-window').html(posts);
var i =0;
			var j=0;
			$.each($('.post'),function(el){
				if(poss!=undefined){
				if(i<poss.length){

	var image = ' url("'+poss[i].profilepictureURL+'") 50% 50% / cover no-repeat';
  $(this).find('.user-img').css('background',image);
  //Names
  $(this).find('.user-name').text(poss[i].postername);
  //Dates
  $(this).find('.post-date').text(poss[i].posttime);
				$(this).find('.post-id').text(poss[i].postid);
					$(this).find('.user-id').text(poss[j].userid);
				$(this).find('.content').text(poss[i].caption);
  if(poss[i].imageurl!=undefined){
  	$(this).append('<div class="media photo"><img src="'+poss[i].imageurl+'" alt="post-image"/></div>');
  }
 i++;}}
 else{
					var image = ' url("'+users[j].profilepictureURL+'") 50% 50% / cover no-repeat';
					$(this).find('.user-img').css('background',image);
					$(this).find('.user-name').text(users[j].fname+" "+users[j].lname);
					$(this).find('.post-date').text(users[j].hometown);
					$(this).find('.user-id').text(users[j].userid);
					$(this).find('.content').text("");
					$(this).find('.actions').find('.heart').remove();
					j++;
				}
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
			window.location.href = "../php/profiles.php"

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