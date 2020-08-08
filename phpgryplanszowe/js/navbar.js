function showNotifId(idNotif, textNotif, idEvent){
  var actualURL = window.location.href;
  var modal = document.getElementById("notifModal");
  document.getElementById("notifId").value=idNotif;
  document.getElementById("viewAnEvent").id=idEvent;
  document.getElementById("notifText").innerHTML="<h4>"+textNotif+"</h4>";
  var span = document.getElementById("notifspan");
  modal.style.display = "block";
  $.ajax({
        url:'readNotif.php',
        method:'POST',
        data:{
          notifId:idNotif
            
        },
        success:function(response){
            $("#notifList").load("loadNotif.php");
        }
    });
  span.onclick = function() {
    modal.style.display = "none";
    document.getElementById(idEvent).id="viewAnEvent";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
      document.getElementById(idEvent).id="viewAnEvent";
    }
  }
}	

function viewEvent(evId){
  window.location.href = 'viewEvent.php?evid='+evId+'';
}

function loguj(){
  var forguest1= document.getElementById("forGuest1").remove();
  var forguest2= document.getElementById("forGuest2").remove();
}

function wyloguj(){
  var foruser1= document.getElementById("forUser1").remove();
  var foruser2= document.getElementById("forUser2").remove();
  var forAdmins= document.getElementById("foradm").remove();
  var createGame= document.getElementById("createGame").remove();
  var createEvent= document.getElementById("createEvent").remove();
  var withMeEvent= document.getElementById("withMeEvent").remove();
}

function forAdmins(){
}

function forUsers(){
  var forAdmins= document.getElementById("forAdmins").remove();
}

function showEventList(){
  document.getElementById("eventList").classList.toggle("show");

  if(document.getElementById("gameList").classList.toggle("show")){
    document.getElementById("gameList").classList.toggle("show");
  }
  if(document.getElementById("profileList")){
    if(document.getElementById("profileList").classList.toggle("show")){
      document.getElementById("profileList").classList.toggle("show");
    }
  }
  if(document.getElementById("userList")){
    if(document.getElementById("userList").classList.toggle("show")){
      document.getElementById("userList").classList.toggle("show");
    }
  }
  if(document.getElementById("userListAdmin")){
    if(document.getElementById("userListAdmin").classList.toggle("show")){
      document.getElementById("userListAdmin").classList.toggle("show");
    }
  }
  if(document.getElementById("notifList")){
    if(document.getElementById("notifList").classList.toggle("show")){
      document.getElementById("notifList").classList.toggle("show");
    }
  }
}
function showGameList(){
  document.getElementById("gameList").classList.toggle("show");

  if(document.getElementById("eventList").classList.toggle("show")){
    document.getElementById("eventList").classList.toggle("show");
  }
  if(document.getElementById("profileList")){
    if(document.getElementById("profileList").classList.toggle("show")){
      document.getElementById("profileList").classList.toggle("show");
    }
  }
  if(document.getElementById("userList")){
    if(document.getElementById("userList").classList.toggle("show")){
      document.getElementById("userList").classList.toggle("show");
    }
  }
  if(document.getElementById("userListAdmin")){
    if(document.getElementById("userListAdmin").classList.toggle("show")){
      document.getElementById("userListAdmin").classList.toggle("show");
    }
  }
  if(document.getElementById("notifList")){
    if(document.getElementById("notifList").classList.toggle("show")){
      document.getElementById("notifList").classList.toggle("show");
    }
  }
}
function showProfileList(){
  document.getElementById("profileList").classList.toggle("show");

  if(document.getElementById("eventList").classList.toggle("show")){
    document.getElementById("eventList").classList.toggle("show");
  }
  if(document.getElementById("gameList").classList.toggle("show")){
    document.getElementById("gameList").classList.toggle("show");
  }
  if(document.getElementById("userList")){
    if(document.getElementById("userList").classList.toggle("show")){
      document.getElementById("userList").classList.toggle("show");
    }
  }
  if(document.getElementById("userListAdmin")){
    if(document.getElementById("userListAdmin").classList.toggle("show")){
      document.getElementById("userListAdmin").classList.toggle("show");
    }
  }
  if(document.getElementById("notifList")){
    if(document.getElementById("notifList").classList.toggle("show")){
      document.getElementById("notifList").classList.toggle("show");
    }
  }
}
function showUserList(){
  document.getElementById("userList").classList.toggle("show");
  if(document.getElementById("eventList").classList.toggle("show")){
    document.getElementById("eventList").classList.toggle("show");
  }
  if(document.getElementById("gameList").classList.toggle("show")){
    document.getElementById("gameList").classList.toggle("show");
  }
  if(document.getElementById("profileList")){
    if(document.getElementById("profileList").classList.toggle("show")){
      document.getElementById("profileList").classList.toggle("show");
    }
  }
  if(document.getElementById("userListAdmin")){
    if(document.getElementById("userListAdmin").classList.toggle("show")){
      document.getElementById("userListAdmin").classList.toggle("show");
    }
  }
  if(document.getElementById("notifList")){
    if(document.getElementById("notifList").classList.toggle("show")){
      document.getElementById("notifList").classList.toggle("show");
    }
  }
}

function showUserListAdmin(){
  document.getElementById("userListAdmin").classList.toggle("show");
  if(document.getElementById("eventList").classList.toggle("show")){
    document.getElementById("eventList").classList.toggle("show");
  }
  if(document.getElementById("gameList").classList.toggle("show")){
    document.getElementById("gameList").classList.toggle("show");
  }
  if(document.getElementById("profileList")){
    if(document.getElementById("profileList").classList.toggle("show")){
      document.getElementById("profileList").classList.toggle("show");
    }
  }
  if(document.getElementById("userList")){
    if(document.getElementById("userList").classList.toggle("show")){
      document.getElementById("userList").classList.toggle("show");
    }
  }
  if(document.getElementById("notifList")){
    if(document.getElementById("notifList").classList.toggle("show")){
      document.getElementById("notifList").classList.toggle("show");
    }
  }
}

function showNotif(){

  document.getElementById("notifList").classList.toggle("show");
  if(document.getElementById("eventList").classList.toggle("show")){
    document.getElementById("eventList").classList.toggle("show");
    document.getElementById("notif").innerText="";
  }
  if(document.getElementById("gameList").classList.toggle("show")){
    document.getElementById("gameList").classList.toggle("show");
  }
  if(document.getElementById("profileList")){
    if(document.getElementById("profileList").classList.toggle("show")){
      document.getElementById("profileList").classList.toggle("show");
    }
  }
  if(document.getElementById("userList")){
    if(document.getElementById("userList").classList.toggle("show")){
      document.getElementById("userList").classList.toggle("show");
    }
  }
  if(document.getElementById("userListAdmin")){
    if(document.getElementById("userListAdmin").classList.toggle("show")){
      document.getElementById("userListAdmin").classList.toggle("show");
    }
  }

}