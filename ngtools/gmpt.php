<?php
declare(strict_types=1);
class test{
	private function getOffsetSeed(int $x, int $y, int $z) : int{
		$p1 = gmp_mul($z, 0x6ebfff5);
		$p2 = gmp_mul($x, 0x2fc20f);
		$p3 = $y;

		$xord = gmp_xor(gmp_xor($p1, $p2), $p3);

		$fullResult = gmp_mul(gmp_add(gmp_mul($xord, 0x285b825), 0xb), $xord);
		return gmp_intval(gmp_and($fullResult, 0xffffffff));
	}

	public function getMaxHeight(int $x, int $z) : int{
		return 12 + ($this->getOffsetSeed($x, 0, $z) % 5);
	}
}

$a = new test();

echo $a->getMaxHeight(-12, -223);