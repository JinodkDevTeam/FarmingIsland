<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\utils;

use pocketmine\nbt\BigEndianNbtSerializer;
use pocketmine\nbt\TreeRoot;
use UnexpectedValueException;

class StringNBTParser{

	/**
	 * @param TreeRoot $data
	 * @param int      $compression
	 * @param int      $level
	 *
	 * @return string
	 */
	public function writeCompressed(TreeRoot $data, int $compression = ZLIB_ENCODING_GZIP, int $level = 7) : string{
		$stream = new BigEndianNbtSerializer();
		$write = $stream->write($data);

		return zlib_encode($write, $compression, $level);
	}

	public function readCompressed(string $data) : TreeRoot{
		$stream = new BigEndianNbtSerializer();
		$decompressed = zlib_decode($data);
		if($decompressed === false){
			throw new UnexpectedValueException("Failed to decompress data");
		}
		return $stream->read($decompressed);
	}
}