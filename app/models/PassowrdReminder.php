<?php
/**
 * Kích hoạt tài khoản
 */
class PassowrdReminder extends BaseModel {

	/**
     * Database table names (not including the prefix)
     * @var string
     */
    protected $table = 'password_reminders';

    /**
     * Soft delete
     * @var boolean
     */
    protected $softDelete = true;
}