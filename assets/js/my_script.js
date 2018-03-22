

    $("#navTabelas").click(function(){
     if ( $( "#collapseComponents2" ).is( ":visible" )) {
      
  			localStorage.setItem("navTabela", 0);
  			 $( "#collapseComponents2" ).hide();

    }
    else{

		localStorage.setItem("navTabela", 1);
		$( "#collapseComponents2" ).show();

    }
    });
    $(document).ready(function(){
   	var state = localStorage.getItem("navTabela") ;
     if(state == 1 ){
    	$( "#collapseComponents2" ).show();
    }
    else{
    	$( "#collapseComponents2" ).hide();
    }
});

