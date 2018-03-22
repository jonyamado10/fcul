

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
    $(document).ready(function(){
   	var state = sessionStorage.getItem("navTabela") ;
     if(state == 1 ){
    	$( "#collapseComponents2" ).show();
    }
    else{
    	$( "#collapseComponents2" ).hide();
    }
});

