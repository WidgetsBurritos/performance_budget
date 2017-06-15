<?php

namespace Drupal\performance_budget\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of performance budgets.
 */
class PerformanceBudgetListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = [
      'data' => $this->t('Label'),
    ];
    $header['id'] = [
      'data' => $this->t('Machine name'),
    ];
    $header['status'] = [
      'data' => $this->t('Status'),
    ];
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $this->getLabel($entity);
    $row['id'] = $entity->id();
    if ($entity->status()) {
      $status = $this->t('Enabled');
    }
    else {
      $status = $this->t('Disabled');
    }
    $row['status'] = $status;

    return $row + parent::buildRow($entity);
  }

}
