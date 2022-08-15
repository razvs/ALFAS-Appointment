function work_update() {
  // Get the checkbox
  var checkBox = document.getElementById("box1");
  var checkBox2 = document.getElementById("box2");
  var checkBox3 = document.getElementById("box3"); 
  var checkBox4 = document.getElementById("box4"); 
  var checkBox5 = document.getElementById("box5"); 
  var checkBox6 = document.getElementById("box6"); 
  var checkBox7 = document.getElementById("box7");   
  // Get the output text
  var text = document.getElementsByClassName("text");
   var text2 = document.getElementsByClassName("text2"); 
   var text3 = document.getElementsByClassName("text3"); 
   var text4 = document.getElementsByClassName("text4");
   var text5 = document.getElementsByClassName("text5"); 
   var text6 = document.getElementsByClassName("text6"); 
   var text7 = document.getElementsByClassName("text7");    
for(i=0;i<4;i++){
  // If the checkbox is checked, display the output text
  if (checkBox.checked == false){
    text[i].style.display = "block";
  } else {
    text[i].style.display = "none";
  }

//next checkbox
    if (checkBox2.checked == false){
    text2[i].style.display = "block";
  } else {
    text2[i].style.display = "none";
  }
//next checkbox
    if (checkBox3.checked == false){
    text3[i].style.display = "block";
  } else {
    text3[i].style.display = "none";
  }
//next checkbox
    if (checkBox4.checked == false){
    text4[i].style.display = "block";
  } else {
    text4[i].style.display = "none";
  }
//next checkbox
    if (checkBox5.checked == false){
    text5[i].style.display = "block";
  } else {
    text5[i].style.display = "none";
  }
//next checkbox
    if (checkBox6.checked == false){
    text6[i].style.display = "block";
  } else {
    text6[i].style.display = "none";
  }
//next checkbox
    if (checkBox7.checked == false){
    text7[i].style.display = "block";
  } else {
    text7[i].style.display = "none";
  }  
  
}
} 