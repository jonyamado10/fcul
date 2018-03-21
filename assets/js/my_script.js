
$(document).ready(function(){
    $("#navTabelas").click(function(){
     if ( $( "#collapseComponents2" ).is( ":visible" )) {
      
  			localStorage.setItem("navTabela", 0);
    }
    else{

		localStorage.setItem("navTabela", 1);

    }
    });
});
    if(localStorage.getItem("navTabela") == 1 ){
    	alert(´"esya");
    }