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
				"position" => [3.5, 4.5, 2.4],
				"rotation" => [5.0, 40.0, 0.0],
				"scale" => [0.05, 0.05, 0.05],
			],
			"third_person" => [
				"position" => [0.0, 3.25, -0.5],
				"rotation" => [0.0, -90.0, 45.0],
				"scale" => [0.08, 0.08, 0.08]
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