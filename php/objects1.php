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

		abstract class Living {
			public $name;
			public $hp;
			public $maxhp;

			public function __construct( $name, $hp ) {
				$this->name = $name;
				$this->maxhp = $hp;
				$this->hp = $hp;
			}

			public function getRemainingHP() {
				return $this->hp . '/' . $this->maxhp;
			}

			public function doDamage( $amt ) {
				$this->hp = ($amt < $this->hp) ? $this->hp - $amt : 0;
				combatMessage( $amt . ' damage taken by ' . $this->name . ' - HP: ' . $this->getRemainingHP() );
				if( $this->hp == 0 ) {
					$this->death();
				}
			}

			abstract protected function death();

		}

		class Monster extends Living {
			public function roar( $text ) {
				if( $this->hp === 0 ) {
					return $this->name . ' mutters something in its sleep.';
				}
				return $this->name . ' roars, "' . $text . '"';
			}

			protected function death() {
				$this->hp = 0;
				combatMessage( '-- ' . $this->name . ' has fallen unconscious. --', 'green' );
			}
		}

		$ogre = new Monster( 'Ogre General', 1000 );
		$orc = new Monster( 'Orc Grunt', 100 );

		echo '<p>' . $orc->roar( "Momma said knock you out!" ) . '</p>';

		echo $ogre->name , ' - HP: ' , $ogre->getRemainingHP() . '<br>';

		echo $ogre->doDamage(9999);

		echo '<p>' . $ogre->roar( "You won't actually hear this but I'm mad!" ) . '</p>';
	?>
</body>
</html>