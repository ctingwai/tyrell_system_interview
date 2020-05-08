<?php
/**
 * JSON view for cards
 *
 * @author      Chong Ting Wai
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Card[]|\Cake\Collection\CollectionInterface $cards
 * */

$count = $this->Paginator->counter('{{count}}');
$page = $this->Paginator->counter('{{page}}');
echo json_encode([
    'total_items' => (int)$count,
    'page' => (int)$page,
    'data' => $cards->toArray(),
]);
