<?php

final class DataDecodeException extends \RuntimeException{
}

final class ByteBuffer{

	public function readUnsignedByte(?int &$offset = null) : int{}

	public function writeUnsignedByte(int $value, ?int &$offset = null) : void{}

	public function readSignedByte(?int &$offset = null) : int{}

	public function writeSignedByte(int $value, ?int &$offset = null) : void{}

	public function readUnsignedShortLE(?int &$offset = null) : int{}

	public function readUnsignedShortBE(?int &$offset = null) : int{}

	public function readSignedShortLE(?int &$offset = null) : int{}

	public function readSignedShortBE(?int &$offset = null) : int{}

	public function writeUnsignedShortLE(int $value, ?int &$offset = null) : void{}

	public function writeUnsignedShortBE(int $value, ?int &$offset = null) : void{}

	public function writeSignedShortLE(int $value, ?int &$offset = null) : void{}

	public function writeSignedShortBE(int $value, ?int &$offset = null) : void{}

	public function readUnsignedIntLE(?int &$offset = null) : int{}

	public function readUnsignedIntBE(?int &$offset = null) : int{}

	public function readSignedIntLE(?int &$offset = null) : int{}

	public function readSignedIntBE(?int &$offset = null) : int{}

	public function writeUnsignedIntLE(int $value, ?int &$offset = null) : void{}

	public function writeUnsignedIntBE(int $value, ?int &$offset = null) : void{}

	public function writeSignedIntLE(int $value, ?int &$offset = null) : void{}

	public function writeSignedIntBE(int $value, ?int &$offset = null) : void{}

	public function readUnsignedLongLE(?int &$offset = null) : int{}

	public function readUnsignedLongBE(?int &$offset = null) : int{}

	public function readSignedLongLE(?int &$offset = null) : int{}

	public function readSignedLongBE(?int &$offset = null) : int{}

	public function writeUnsignedLongLE(int $value, ?int &$offset = null) : void{}

	public function writeUnsignedLongBE(int $value, ?int &$offset = null) : void{}

	public function writeSignedLongLE(int $value, ?int &$offset = null) : void{}

	public function writeSignedLongBE(int $value, ?int &$offset = null) : void{}

	public function readFloatLE(?int &$offset = null) : float{}

	public function readFloatBE(?int &$offset = null) : float{}

	public function writeFloatLE(float $value, ?int &$offset = null) : void{}

	public function writeFloatBE(float $value, ?int &$offset = null) : void{}

	public function readDoubleLE(?int &$offset = null) : float{}

	public function readDoubleBE(?int &$offset = null) : float{}

	public function writeDoubleLE(float $value, ?int &$offset = null) : void{}

	public function writeDoubleBE(float $value, ?int &$offset = null) : void{}

	public function readUnsignedVarInt(?int &$offset = null) : int{}

	public function readSignedVarInt(?int &$offset = null) : int{}

	public function writeUnsignedVarInt(int $value, ?int &$offset = null) : void{}

	public function writeSignedVarInt(int $value, ?int &$offset = null) : void{}

	public function readUnsignedVarLong(?int &$offset = null) : int{}

	public function readSignedVarLong(?int &$offset = null) : int{}

	public function writeUnsignedVarLong(int $value, ?int &$offset = null) : void{}

	public function writeSignedVarLong(int $value, ?int &$offset = null) : void{}

	public function __construct(string $buffer){}

	public function toString() : string{}

	public function readByteArray(int $length, ?int &$offset = null) : string{}

	public function writeByteArray(string $value, ?int &$offset = null) : void{}

	public function getOffset() : int{}

	public function setOffset(int $offset) : void{}

	public function getReserved() : int{}

	public function reserve(int $length) : void{}

	public function trim() : void{}

	public function rewind() : void{}

	public function __serialize() : array{}

	public function __unserialize(array $data) : void{}

	public function __debugInfo() : array{}
}