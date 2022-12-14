<?php

/**
 * This file is part of the Nextras community extensions of Nette Framework
 *
 * @license    New BSD License
 * @link       https://github.com/nextras/migrations
 */

namespace Nextras\Migrations\Entities;

use Nextras\Migrations\IDiffGenerator;


/**
 * Group of migrations. Forms DAG with other.latte groups.
 */
class Group
{
	/** @var string */
	public $name;

	/** @var bool */
	public $enabled;

	/** @var string absolute path do directory */
	public $directory;

	/** @var string[] */
	public $dependencies;

	/** @var IDiffGenerator|NULL */
	public $generator;

}
