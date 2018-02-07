$("#post").click(function () {
	vex.dialog.open({
		message: "What's On your mind :",
		input: [
			'<form action="../php/uploadPost.php" method="post" enctype="multipart/form-data">',
			'<textarea name="post" type="text" placeholder="I am thinking ..." required id="content"/></textarea>', ,
			'<input name="image" type="file"/>',
			'<div style="text-align: left;"id="privacy">  <span class="fh-radio">',
				'<input type="radio" id="public" value="public" name="myradiogroup" checked>',
				'<label for="public">Public</label>',
		'</span>',
			'<br>',
		'<span class="fh-radio">',
		'<input type="radio" id="private" value="private" name="myradiogroup">',
		'<label for="private">Private</label>',
		'</span></div>  <input type="submit" value="Upload"></form>'
		].join(''),
		buttons: [

		],
		callback: function (data) {
			if (!data) {
				console.log('Cancelled')
			} else {
				console.log('Username', data.post, 'Password', data ,'select',data.myradiogroup);
			}
		}
	})
});
$("#notifier").click(function () {
	window.location.href = "../notifications/";
});
$(document).ready(function() {

	$.ajax({
		type: "POST",
		url: "../php/home.php",
		cache: false,
		success: function (res) {
			if(res=='returntoindex'){
				window.location.href = "../index.html"
				return;
			}
			var obj=$.parseJSON(res);
			var users=(obj.posts.user);
			var pp = obj.pp;
			var noti= obj.noti;
			for(var i =0 ; i< noti;i++) {
				incNoti();
			}
			var image = ' url("'+pp+'") 50% 50% / cover no-repeat';
			$(".profile").css('background',image);
			var $post = $('#main-window').html();



			var posts = '';
			users.forEach(function (user) {
				var single=$post;
				posts += single;
			});
			$('#main-window').html(posts);
var i =0;
			$.each($('.post'),function(el){
	//Profile Pictures

  //Names
  $(this).find('.user-name').text(users[i].postername);
  //Dates
  $(this).find('.post-date').text(users[i].posttime);
				$(this).find('.post-id').text(users[i].postid);
				$(this).find('.user-id').text(users[i].userid);
				$(this).find('.content').text(users[i].caption);
				var postsid = "postid="+users[i].postid;
				var thispost=$(this);
				$.ajax({
					type: "POST",
					data:postsid,
					url: "../php/isLiked.php",
					cache: false,
					success: function (res) {
						sexy=res;
						if(res=="liked"){
							console.log(postsid);
							$(thispost).find('.actions').find('.heart').addClass('hearted');
							 $(thispost).find('.actions').find('.heart').removeClass('heart');
						}

					},
					error: function (obj) {

					}


				});
				var userid = "postid="+users[i].userid;
				var posss=this;
				$.ajax({
					type: "POST",
					data:userid,
					url: "../php/getPP.php",
					cache: false,
					success: function (res) {
						console.log(res);
						var image = ' url("'+res+'") 50% 50% / cover no-repeat';
						$(posss).find('.user-img').css('background',image);

					},
					error: function (obj) {

					}


				});

  if(users[i].imageurl!=undefined&&users[i].imageurl!="imageurl"){
  	$(this).append('<div class="media photo"><img src="'+users[i].imageurl+'" alt="post-image"/></div>');
  }
 i++;
});
		},
		error: function (obj) {

		}


	});
});


function changeClass(element) {
	$(element).toggleClass('heart');
	$(element).toggleClass('hearted');
var postid ="postid="+$(element).parent().parent().find('.user-info').find('.post-id').text();
	if($(element).hasClass('heart')){
		$.ajax({
			type: "POST",
			data:postid,
			url: "../php/dislike.php",
			cache: false,
			success: function (res) {
			},
			error: function (obj) {

			}


		});
	}
	else{
		$.ajax({
			type: "POST",
			data:postid,
			url: "../php/like.php",
			cache: false,
			success: function (res) {

			},
			error: function (obj) {

			}


		});
	}
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
var el = document.querySelector('.notification');
 function incNoti() {
	var count = Number(el.getAttribute('data-count')) || 0;
	el.setAttribute('data-count', count + 1);
	el.classList.remove('notify');
	el.offsetWidth = el.offsetWidth;
	el.classList.add('notify');
	if(count === 0){
		el.classList.add('show-count');
	}
};


function goUser(element) {
	var uid="userid="+$(element).parent().find('.user-id').text();
	$.ajax({
		type: "POST",
		data:uid,
		url: "../php/parseuser.php",
		cache: false,
		success: function (res) {
			console.log("5alas")
			window.location.href = "../php/profiles.php";

		},
		error: function (obj) {
			console.log("5alasss")
		}


	});


}