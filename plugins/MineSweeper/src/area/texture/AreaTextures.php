<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\area\texture;

use InvalidArgumentException;
use pocketmine\utils\RegistryTrait;

/**
 * @method static VanillaTexture VANILLA()
 * @method static ClassicTexture CLASSIC()
 */

class AreaTextures {
	use RegistryTrait;

	public static function register(string $textureName, AreaTexture $texture) : void{
		self::_registryRegister($textureName, $texture);
	}

	public static function getAll() : array{
		self::checkInit();
		/** @var AreaTexture[] $result */
		$result = self::$members;
		return $result;
	}

	public static function fromString(string $texture) : ?AreaTexture{
		try{
			/** @var AreaTexture $result */
			$result = self::_registryFromString($texture);
			return $result;
		} catch(InvalidArgumentException){
			return null;
		}
	}

	protected static function setup() : void{
		self::register("vanilla", new VanillaTexture());
		self::register("classic", new ClassicTexture());
		// TODO: Implement setup() method.
	}
}