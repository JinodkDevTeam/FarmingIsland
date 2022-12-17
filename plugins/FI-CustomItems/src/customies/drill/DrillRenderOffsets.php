<?php
declare(strict_types=1);

namespace CustomItems\customies\drill;

use customiesdevs\customies\item\component\ItemComponent;

final class DrillRenderOffsets implements ItemComponent {
	public function getName(): string {
		return "minecraft:render_offsets";
	}

	public function getValue(): array {
		$perspectives = [
			"first_person" => [
			],
			"third_person" => [
				"position" => [0.65, 0.0, -0.9], //x=-z-0.25
				"rotation" => [0.0, -90.0, 0.0],
				"scale" => [0.075, 0.125, 0.075]
			]
		];
		return [
			"main_hand" => $perspectives,
			"off_hand" => $perspectives
		];
	}

	public function isProperty(): bool {
		return false;
	}
}