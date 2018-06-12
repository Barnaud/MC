<?php
	session_start();
	header('Location:Rcon.php#bouton');
	require __DIR__ . '/src/bootstrap.php';

	use xPaw\SourceQuery\SourceQuery;
	
	// For the sake of this example
	Header( 'Content-Type: text/plain' );
	Header( 'X-Content-Type-Options: nosniff' );
	
	// Edit this ->
	define( 'SQ_SERVER_ADDR', 'localhost' );
	define( 'SQ_SERVER_PORT', 25575 );
	define( 'SQ_TIMEOUT',     1 );
	define( 'SQ_ENGINE',      SourceQuery::SOURCE );
	// Edit this <-
	
	$Query = new SourceQuery( );
	var_dump($_POST["cmd"]);
	var_dump($_SESSION["sortie"][1]);
	if(isset($_POST["cmd"]) and isset($_SESSION["sortie"]) and $_SESSION["sortie"][1]==2){
		try
	{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
		
		$Query->SetRconPassword( 'Chaussure' );
		
		var_dump( $Query->Rcon( $_POST["cmd"] ) );
	}
	catch( Exception $e )
	{
		echo $e->getMessage( );
	}
	finally
	{
		$Query->Disconnect( );
	}
	}
	else{
		echo"fail";
	}
	

	
	
?>