<?php

namespace Drupal\Tests\performance_budget\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests performance budget .
 *
 * @group performance_budget
 */
class PerformanceBudgetEntityTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public $profile = 'minimal';

  /**
   * User.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $user;

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'performance_budget',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->user = $this->drupalCreateUser([
      'administer performance budget',
    ]);
  }

  /**
   * Functional test of performance budget entity.
   */
  public function testPerformanceBudgetEntity() {
    $assert = $this->assertSession();
    // Login.
    $this->drupalLogin($this->user);

    // Verify list exists with add button.
    $this->drupalGet('admin/config/development/performance_budget');
    $this->assertLinkByHref('/admin/config/development/performance_budget/add');
    // Add an entity using the entity form.
    $this->drupalGet('/admin/config/development/performance_budget/add');
    $this->drupalPostForm(
      NULL,
      [
        'label' => 'Test Budget',
        'id' => 'test_budget',
      ],
      t('Save')
    );
    $assert->pageTextContains('Created the Test Budget Performance Budget.');

    // Verify entity edit, disable, and delete buttons are present.
    // This is to ensure the entity config is correct for user operations.
    $this->assertLinkByHref('/admin/config/development/performance_budget/test_budget');
    $this->assertLinkByHref('/admin/config/development/performance_budget/test_budget/delete');

    // Update the new entity using the entity form.
    $this->drupalGet('/admin/config/development/performance_budget/test_budget');
    $this->drupalPostForm(
      NULL,
      [
        'label' => 'Test Budgeter',
      ],
      t('Save')
    );
    $assert->pageTextContains('Saved the Test Budgeter Performance Budget.');

    // Update the new entity using the entity form.
    // $this->drupalGet('admin/config/development/performance_budget/test_budget/disable');.
    // $assert->pageTextContains('The performance budget settings have been updated.');.
  }

}
