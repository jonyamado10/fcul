

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


