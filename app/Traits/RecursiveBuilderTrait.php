<?php

namespace App\Traits;

trait RecursiveBuilderTrait
{
	public function recursiveBuilder($array)
	{
		$result = [];
		foreach ($array as $i => $item) {
			if (!$item['parent_id']) {
				$result[$item['id']] = $item + ['children' => []];
			} else {
				$result = $this->recursionTree($result, $item);
			}
		}
		return $result;
	}

	private function recursionTree($comments, $comment)
	{
		if (isset($comments[$comment['parent_id']])) {
			$comments[$comment['parent_id']]['children'][$comment['id']] = $comment;
			return $comments;
		}

		if ($comments) {
			foreach ($comments as $i => $data) {
				$data['children'] = $this->recursionTree($data['children'], $comment);
				$comments[$i] = $data;
			}
			return $comments;
		}

	}
}