<?php

namespace pocketmine\world\format {
final class LightArray
{
    public function __construct(string $payload) {}

    public static function fill(int $level): LightArray {}

    public function get(int $x, int $y, int $z): int {}

    public function set(int $x, int $y, int $z, int $level): void {}

    public function getData(): string {}

    public function collectGarbage(): void {}

    public function isUniform(int $level): bool {}
}
}

namespace pocketmine\world\format {
final class PalettedBlockArray
{
    public function __construct(int $fillEntry) {}

    public static function fromData(int $bitsPerBlock, string $wordArray, array $palette): PalettedBlockArray {}

    public function getWordArray(): string {}

    public function getPalette(): array {}

    public function getMaxPaletteSize(): int {}

    public function getBitsPerBlock(): int {}

    public function get(int $x, int $y, int $z): int {}

    public function set(int $x, int $y, int $z, int $val): void {}

    public function replaceAll(int $oldVal, int $newVal): void {}

    public function collectGarbage(bool $force = false): void {}

    public static function getExpectedWordArraySize(int $bitsPerBlock): int {}
}
}

namespace pocketmine\world\format\io {
final class SubChunkConverter
{
    public static function convertSubChunkXZY(string $idArray, string $metaArray): \pocketmine\world\format\PalettedBlockArray {}

    public static function convertSubChunkYZX(string $idArray, string $metaArray): \pocketmine\world\format\PalettedBlockArray {}

    public static function convertSubChunkFromLegacyColumn(string $idArray, string $metaArray, int $yOffset): \pocketmine\world\format\PalettedBlockArray {}

    private function __construct() {}
}
}
