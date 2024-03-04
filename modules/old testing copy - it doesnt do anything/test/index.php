<?php 
$serverq = array(
    0 => array(
        'type' => 'csgo',
        'host' => '51.83.172.143',
		'port' => '23580',
        'fakename' => '',
        'fakeip' => ''
    ),
    1 => array(
        'type' => 'csgo',
        'host' => '51.83.172.143',
		'port' => '23520',
        'fakename' => '',
        'fakeip' => ''
	),
	2 => array(
        'type' => 'csgo',
        'host' => '91.224.117.232',
		'port' => '27015',
        'fakename' => '',
        'fakeip' => ''
    ),
	3 => array(
        'type' => 'csgo',
        'host' => '127.0.0.1',
		'port' => '27015',
        'fakename' => '',
        'fakeip' => ''
    )
);
	require 'scripts/SourceQuery/bootstrap.php';
	use xPaw\SourceQuery\SourceQuery;
	define( 'SQ_TIMEOUT',     1 );
	define( 'SQ_ENGINE',      SourceQuery::SOURCE ); 
	for($x = 0; $x <= count($serverq) - 1; $x++){
		$ip = $serverq[$x]['host'];
		$port = $serverq[$x]['port'];
		echo $ip . ":" . $port . " ";
		try
		{
				
			$Timer = microtime( true );
			$Query = new SourceQuery( );
			$Query->Connect( $ip, $port, SQ_TIMEOUT, SQ_ENGINE );
			echo is_array($Query->GetInfo());
			//$Query->SetUseOldGetChallengeMethod( true ); // Use this when players/rules retrieval fails on games like Starbound
			echo "<pre>";
			print_r( $Query->GetInfo( ) );
			print_r( $Query->GetPlayers( ) );
			//print_r( $Query->GetRules( ) );
			print_r($Query->GetInfo()['HostName']);
			echo "</pre>";
		}
		catch( Exception $e )
		{
			echo "chuj";
			$Exception = $e;
		}
		finally
		{
			$Query->Disconnect( );
		}
		
		$Timer = number_format( microtime( true ) - $Timer, 4, '.', '' );
	}