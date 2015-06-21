<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Objects - 1</title>
</head>
<body>
	<?php

		function combatMessage( $str, $color='red' ) {
			echo '<p style="color: ' . $color . '">' . $str . '</p>';
		}

		class monster {
			public $name;
			public $hp;
			public $maxhp;

			function __construct( $name, $hp ) {
				$this->name = $name;
				$this->maxhp = $hp;
				$this->hp = $hp;
			}

			function getRemainingHP() {
				return $this->hp . '/' . $this->maxhp;
			}

			function doDamage( $amt ) {
				$this->hp = ($amt < $this->hp) ? $this->hp - $amt : 0;
				combatMessage( $amt . ' damage taken by ' . $this->name . ' - HP: ' . $this->getRemainingHP() );
				if( $this->hp == 0 ) {
					$this->death();
				}
			}

			function death() {
				$this->hp = 0;
				combatMessage( '-- ' . $this->name . ' has died. --', 'green' );
			}

		}

		$ogre = new monster( 'Ogre General', 1000 );
		$orc = new monster( 'Orc Grunt', 100 );

		echo $ogre->name , ' - HP: ' , $ogre->getRemainingHP() . '<br>';

		echo $ogre->doDamage(9999);
	?>
</body>
</html>