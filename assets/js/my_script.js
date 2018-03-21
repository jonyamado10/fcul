
$(document).ready(function(){
    $("#navTabelas").click(function(){
     if ( $( "#collapseComponents2" ).is( ":visible" )) {
      
      <?php 
      $data = array('mostra_tabela' => 0 );
      $this->session->set_userdata($data);
      echo "alert(" . $this->session->userdata(); . ")";
      ?>
    }
    else{

	
      alert("escondeu");

    }
    });
});
