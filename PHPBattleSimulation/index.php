<?php
	// GET integer size of two armies from URL	
	// ?army1=50&army2=48 is the suffix used at the end of URL
	$army1Size = $_GET['army1'];
	$army2Size = $_GET['army2'];
	
	// Show the size of two armies
	echo "This is a battle simulation between two armies. <br/><br/>";
	echo "Army 1 has $army1Size soldiers. <br/>";
	echo "Army 2 has $army2Size soldiers. <br/><br/>";

	// ----------------------------------------

	/*
		ARMY RATIO
		Infantry: 50%
		Cavalry: 10%
		Artillery: 40%
	*/

	/*
		SOLDIER TYPE DATA
		INFANTRY: Health & Damage: 1
		CAVALRY: Health & Damage: 2
		ARTILLERY: Health & Damage: 3
	*/

	// ----------------UNUSED CODE------------------

	/*
		The initial idea was to use the classes for soldier types.
		This was abandoned due to deadline constraints.
	*/

	// An Infantry class
	/*
		class infantry {
			public $health = 1;
			public $damage = 1;
			public $type = "infantry";
		}

		// A Cavalry class
		class cavalry {
			public $health = 2;
			public $damage = 2;
			public $type = "cavalry";
		}

		// An Artillery class
		class artillery {
			public $health = 3;
			public $damage = 3;
			public $type = "artillery";
		}
	*/
	// ............END OF UNUSED CODE...................

	// Initialize two armies with artillery. Integers represent Health.
	$army1Array = array_fill(0, $army1Size, 3); // Army 1
	$army2Array = array_fill(0, $army2Size, 3); // Army 2
	
	// Calculate approximate percentages of armies (rounded down to integers)
	// 50% Infantry, 10% Cavalry, 40% Artillery
		// Army 1
	$army1Infantry = floor((50*$army1Size)/100);
	$army1Cavalry = floor((10*$army1Size)/100);
	$army1Artillery = floor((40*$army1Size)/100);
	$army1FloorDiff = $army1Size-($army1Infantry+$army1Cavalry+$army1Artillery);
	$army1Infantry += $army1FloorDiff; // Add the difference to infantry
		// Army 2
	$army2Infantry = floor((50*$army2Size)/100);
	$army2Cavalry = floor((10*$army2Size)/100);
	$army2Artillery = floor((40*$army2Size)/100);
	$army2FloorDiff = $army2Size-($army2Infantry+$army2Cavalry+$army2Artillery);
	$army2Infantry += $army2FloorDiff; // Add the difference to infantry
	
	// Echo the percentages
	echo "ARMY 1<br/>";
	echo "~50%: $army1Infantry Infantry <br/>";
	echo "~10%: $army1Cavalry Cavalry <br/>";
	echo "~40%: $army1Artillery Artillery <br/><br/>";
	
	echo "ARMY 2<br/>";
	echo "~50%: $army2Infantry Infantry <br/>";
	echo "~10%: $army2Cavalry Cavalry <br/>";
	echo "~40%: $army2Artillery Artillery <br/><br/>";

	// Fill the array 1 with respective soldier type ratios
	// Add Army 1 Infantry
	for ($i = 0; $i < $army1Infantry; $i++)
		{
			$army1Array[$i] = 1;
		}

	// Add Army 1 Cavalry
	for ($i = $army1Infantry; $i < ($army1Infantry + $army1Cavalry); $i++)
		{
			$army1Array[$i] = 2;
		}
		
	// Add Army 2 Infantry
	for ($i = 0; $i < $army2Infantry; $i++)
		{
			$army2Array[$i] = 1;
		}
		
	// Add Army 2 Cavalry
	for ($i = $army2Infantry; $i < ($army2Infantry + $army2Cavalry); $i++)
		{
			$army2Array[$i] = 2;
		}

	// Show the structure of two armies, next to each other

	// Show Army 1 to the left
	echo "<table>";
		echo "<tr>";
			echo "<th>ARMY 1<br/>";
				echo "<pre>";
				print_r ($army1Array);
				echo "</pre>";
			echo "</th>";

			// Show Army 2 to the right
			echo "<th> ARMY 2 <br/>";
				echo "<pre>";
				print_r ($army2Array);
				echo "</pre>";
			echo "</th>";
		echo "</tr>";
	echo "</table><br/><br/>";
	
	// -------------------------------------------
	// MAY THE BATTLE BEGIN!
	
	fight:
	// Choose the Army at random to attack
	$attackingArmyNo = rand(1, 2);
	$attackingArmy = []; // Unassigned attacking army
	$defendingArmy = []; // Unassigned defending army
	
	if ($attackingArmyNo == 1)
	{
		$attackingArmy = $army1Array;
		$defendingArmy = $army2Array;
		echo "Army 1 attacking! <br/>";
	}
	else
	{
		$attackingArmy = $army2Array;
		$defendingArmy = $army1Array;
		echo " Army 2 attacking! <br/>";
	}
	
	// Choose the soldier at random to attack
	$attackingSoldier = rand(0, count($attackingArmy)-1); // Index at attacking soldier
	while ($attackingArmy[$attackingSoldier] <= 0)
	{
		echo "Soldier $attackingSoldier is dead. Cannot attack. <br/>";
		$attackingSoldier = rand(0, count($attackingArmy)-1);
	}
	
	// Determine the attacking side TYPE
	
	/*
	Unassigned attacker type and damage indicator
	1 - infantry, also does 1 damage
	2 - cavalry, also does 2 damage
	3 - artillery, also does 3 damage
	*/
	$attackerType = 0;
	
	if ($attackingArmyNo == 1) // If Army 1 is attacking
	{
		if ($attackingSoldier <= $army1Infantry-1)
		{
			echo "Infantry attacking! <br/>";
			$attackerType = 1;
			
			// Echo who is attacking from which army
			echo "Soldier with number ", $attackingSoldier, " is attacking! <br/>";
		}
		else if ($attackingSoldier >= $army1Infantry && $attackingSoldier < ($army1Infantry + $army1Cavalry))
		{
			echo "Cavalry attacking! <br/>";
			$attackerType = 2;
			
			// Echo who is attacking from which army
			echo "Soldier with number ", $attackingSoldier, " is attacking! <br/>";
		}
		else
		{
			echo "Artillery attacking! <br/>";
			$attackerType = 3;
			
			// Echo who is attacking from which army
			echo "Soldier with number ", $attackingSoldier, " is attacking! <br/>";
		}
	}
	else // If Army 2 is attacking
	{
		if ($attackingSoldier <= $army2Infantry-1)
		{
			echo "Infantry attacking! <br/>";
			$attackerType = 1;
			
			// Echo who is attacking from which army
			echo "Soldier with number ", $attackingSoldier, " is attacking! <br/>";
		}
		else if ($attackingSoldier >= $army2Infantry && $attackingSoldier < ($army2Infantry + $army2Cavalry))
		{
			echo "Cavalry attacking! <br/>";
			$attackerType = 2;
			
			// Echo who is attacking from which army
			echo "Soldier with number ", $attackingSoldier, " is attacking! <br/>";
		}
		else
		{
			echo "Artillery attacking! <br/>";
			$attackerType = 3;
			
			// Echo who is attacking from which army
			echo "Soldier with number ", $attackingSoldier, " is attacking! <br/>";
		}
	}
	
	// Choose the soldier at random to get shot (morbid, I know...)
	$shotSoldier = rand(0, count($defendingArmy)-1); // Index at soldier being shot at

	while ($defendingArmy[$shotSoldier] <= 0)
	{
		echo "Soldier $shotSoldier from the opposing army is already dead. <br/>";
		$shotSoldier = rand(0, count($defendingArmy)-1);
	}

	$defendingArmy[$shotSoldier] -= $attackerType; // Defending soldier sustains damage
	$attackerName = "";
	
		if ($attackerType == 1)
		{
			$attackerName = "Infantry";
		}
		else if ($attackerType == 2)
		{
			$attackerName = "Cavalry";
		}
		else 
		{
			$attackerName = "Artillery";
		}
		
	echo "<br/> Soldier with number ", $shotSoldier, " from the opposing army was shot by $attackerName and sustained ", $attackerType, " damage! <br/><br/>";
	
	// Temporarily save the armies' states for future fight iterations
	if ($attackingArmyNo == 1)
	{
		$army1Array = $attackingArmy;
		$army2Array = $defendingArmy;
	}
	else
	{
		$army1Array = $defendingArmy;
		$army2Array = $attackingArmy;
	}

	// Initial attack COMPLETE
	
	// LOOPING the attack until one army is defeated!
	// Constantly fight as long as both armies have some soldiers alive.
	while (max($defendingArmy) > 0 && max($attackingArmy) > 0)
	{
		goto fight;
	}

	// -------------------------
	// This part executes only if one of the armies has all soldiers dead
	
	// Check which army has all soldiers dead - which one is defeated
	if (max($army1Array) <= 0)
	{
		$i = 0;

		foreach ($army2Array as $element)
		{
			if ($element > 0)
			{
				$i += 1;
			}
		}
		
		echo "<br/><br/> ARMY 2 has won with $i soldiers!";
	}
	else if (max($army2Array) <= 0)
	{
		$i = 0;

		foreach ($army1Array as $element)
		{
			if ($element > 0)
			{
				$i += 1;
			}
		}

		echo "<br/><br/> ARMY 1 has won with $i soldiers!";
	}

	/*
		--------------
			THE END
		--------------
		Credits to myself - Boris Jakovljevic!

		Possible future upgrades	- do not randomly choose a dead attacker, he can't shoot.
									- do not randomly choose a dead person to kill, he's already dead.
	*/
?>
