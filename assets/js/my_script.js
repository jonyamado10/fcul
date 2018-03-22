
$(document).ready(function(){

    $("#navGraficos").click(function(){
     if ( $( "#collapseComponents" ).is( ":visible" )) {
      
  			sessionStorage.setItem("navGrafico", 0);
  			 

    }
    else{

		sessionStorage.setItem("navGrafico", 1);
		

    }
    });
   	var state = sessionStorage.getItem("navGrafico") ;
     if(state == 1 ){
    	$('#navGraficos').click();
    }


        $("#navTabelas").click(function(){
     if ( $( "#collapseComponents2" ).is( ":visible" )) {
      
  			sessionStorage.setItem("navTabela", 0);
  			 $( "#collapseComponents2" ).hide();

    }
    else{

		sessionStorage.setItem("navTabela", 1);
		$( "#collapseComponents2" ).show();

    }
    });
   	var state1 = sessionStorage.getItem("navTabela") ;
     if(state1 == 1 ){
    	$( "#collapseComponents2" ).show();
    }
    else{
    	$( "#collapseComponents2" ).hide();
    }


        $("#navFerramentas").click(function(){
     if ( $( "#collapseComponents3" ).is( ":visible" )) {
      
  			sessionStorage.setItem("navFerramenta", 0);
  			 $( "#collapseComponents3" ).hide();

    }
    else{

		sessionStorage.setItem("navFerramenta", 1);
		$( "#collapseComponents3" ).show();

    }
    });
   	var state2 = sessionStorage.getItem("navFerramenta") ;
     if(state2 == 1 ){
    	$( "#collapseComponents3" ).show();
    }
    else{
    	$( "#collapseComponents3" ).hide();
    }
});

