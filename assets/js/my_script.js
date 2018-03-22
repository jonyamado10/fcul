

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


