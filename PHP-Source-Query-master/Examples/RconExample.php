<?php
	require __DIR__ . '/../SourceQuery/bootstrap.php';

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
	
	try
	{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
		
		$Query->SetRconPassword( 'Chaussure' );
		
		var_dump( $Query->Rcon( 'kill Cake_exploder' ) );
	}
	catch( Exception $e )
	{
		echo $e->getMessage( );
	}
	finally
	{
		$Query->Disconnect( );
	}
