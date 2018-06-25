<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/20/2018
 * Time: 3:51 PM
 */

namespace App\Commons;


class CConstant
{
	/*const status*/
	const STATUS_SUCCESS   = 'success';
	const STATUS_FAIL      = 'fail';
	const STATUS_ERROR     = 'error';
	const STATUS_NOT_FOUND = 'Not found';
	/*const status*/

	/*const state*/
	const STATE_ACTIVE   = 1;
	const STATE_INACTIVE = 0;
	/*const state*/

	/*const number*/
	const NUMBER_ZERO = 0;
	const NUMBER_ONE  = 1;
	/*const number*/

	/*const ROLE*/
	const ROLE_ADMIN   = 30;
	const ROLE_USER    = 10;
	const ROLE_MANAGER = 20;
	/*const ROLE*/
}