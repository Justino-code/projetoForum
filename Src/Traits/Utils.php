<?php
namespace Src\Traits;

trait Utils{
	public function removeEmptyElements($array) {
		$filteredArray = [];
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$filteredValue = $this->removeEmptyElements($value);
				
				if (!empty($filteredValue)) {
					$filteredArray[$key] = $filteredValue;
				}
			}else {
				if (!empty($value)) {
					$filteredArray[$key] = $value;
				}
			}
		}
		
		return $filteredArray;
	}
}
