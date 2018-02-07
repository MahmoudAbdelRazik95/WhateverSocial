function close(element,index){
  console.log(index);
  $("#"+index).remove();

  $.ajax({
    type: "POST",
    url: "../php/removeNoti.php",
    data:"noti="+index,
    cache: false,
    success:function (res) {
      $('#cont').append(res);



    },
    error:function (obj) {

    }




  });
};


function load() {
  $.ajax({
    type: "POST",
    url: "../php/notifications.php",
    cache: false,
    success:function (res) {
      if(res=='returntoindex'){
        window.location.href = "../index.html"
      }
      $('#cont').append(res);



    },
    error:function (obj) {

    }




  });

};