<?php
class vStats
{

	public function __construct()
	{
		//echo 'The class "', __CLASS__, '" was initiated!<br />';
	}

	public function __destruct()
	{
		//echo 'The class "', __CLASS__, '" was destroyed.<br />';
	}
	
	public function vCov($set1, $set2)
	{
		//check section
		// .... dodatne probe potrebne
		// .... jesu li sve numerièke vrijednosti i ima li null
		
		$x = 0; $xmean = 0; $y = 0; $ymean = 0; $xydis = 0; $cov = 0;
		$n = count($set1);
		
		// 1. srednja vrijednost prvog seta
		for ($i=0; $i<$n; $i++) $x += $set1[$i];
		$xmean = $x / $n;
				
		// srednja vrijednost drugog seta
		for ($i=0; $i<$n; $i++) $y += $set2[$i];
		$ymean = $y / $n;
		
		// suma umnožaka udaljenosti
		for ($i=0; $i<$n; $i++) {
			$xydist += ($set1[$i] - $xmean)*($set2[$i] - $ymean);
		}
		
		// kovarijanca
		$cov = 1/$n * $xydist;
		
		return $cov;
	}
	
	public function vStDev ($set)
	{

		$x = 0; $xmean = 0; $xdist = 0; $stdev = 0;
		$n = count($set);
		
		// 1. srednja vrijednost
		for ($i=0; $i<$n; $i++) $x += $set[$i];
		$xmean = $x / $n;
		
		// suma kvadriranih udaljenosti
		for ($i=0; $i<$n; $i++) $xdist += ($set[$i] - $xmean)*($set[$i] - $xmean);
		$stdev = sqrt($xdist / $n);
		
		return $stdev;
	}

	public function vCorrel($set1, $set2)
	{
		//check section
		$ok = 1;
		if (count($set1)<>count($set2)) $ok = -2;
		if (count($set1)==0) $ok = -3;
		$eql = 1;
		for ($i=0; $i<count($set1); $i++) {
			if ($set1[$i]<>$set2[$i]) $eql = 0;
		}
		if ($eql) $ok = -4;
		// .... dodatne probe potrebne
		// .... jesu li sve numeričke vrijednosti i ima li null

		if ($ok<0) return $ok;

		// ako je sve ok idemo na izračun
		$xy=0; $x=0; $y =0; $x2=0; $y2=0; $r=0;
		$n = count($set1);
		// 1. suma umnožaka elemenata
		for ($i=0; $i<$n; $i++) {
			$xy += $set1[$i]*$set2[$i];
		}
		// 2. suma elemenata prvog seta
		for ($i=0; $i<$n; $i++) {
			$x += $set1[$i];
		}
		// 3. suma elemenata drugog seta
		for ($i=0; $i<$n; $i++) {
			$y += $set2[$i];
		}
		// 4. suma umnožaka kvadrata elemenata prvog seta
		for ($i=0; $i<$n; $i++) {
			$x2 += $set1[$i]*$set1[$i];
		}
		// 5. suma umnožaka kvadrata elemenata drugog seta
		for ($i=0; $i<$n; $i++) {
			$y2 += $set2[$i]*$set2[$i];
		}

		$r = ($xy - $x*$y/$n)/sqrt(($x2-$x*$x/$n)*($y2-$y*$y/$n));

		return $r;
	}
}
?>