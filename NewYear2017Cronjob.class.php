<?php

/*
 *  This file is part of the Lizenzstatus plugin.
 * 
 *  Copyright (c) 2016 data-quest <info@data-quest.de>
 *
 *  This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License as
 *  published by the Free Software Foundation; either version 2 of
 *  the License, or (at your option) any later version.
 */

require_once 'lib/classes/CronJob.class.php';

class NewYear2017Cronjob extends CronJob
{
    
    /**
     * @return string The name of the cronjob.
     */
    public static function getName()
    {
        return _('Lizenzstatus');
    }
    
    
    /**
     * @return string The description of the cronjob.
     */
    public static function getDescription()
    {
        return _('�ndert den Download-Status bestimmter Lizenzen zum 1.1.2017, um den neuen Anforderungen der VG Wort gerecht zu werden.');
    }
    
    
    /**
     * Setup method that loads all required classes and stuff.
     *
     * @throws Exception Throws an exception if something went wrong.
     */
    public function setUp()
    {
        global $STUDIP_BASE_PATH;
        require_once($STUDIP_BASE_PATH . '/lib/classes/Config.class.php');
        require_once($STUDIP_BASE_PATH . '/config/config_local.inc.php');
    }
    
    
    /**
     * @return Array The parameters for this cronjob.
     */
    public static function getParameters()
    {
        return array();
    }
    
    
    /**
     * Executes the cronjob.
     */
    public function execute($last_result, $parameters = array())
    {
        
        //get db connection:
        $db = DBManager::get();
        
        
        $license_changes = Config::Get()->DOCUMENT_LICENSE_CHANGES_2017;
        
        if(!is_array($license_changes)) {
            //Configuration parameter wasn't set in config_local.inc.php:
            //Use default settings:
            
            $license_changes = array(
                '7' => '3' //Documents with License-ID 7 can't be downloaded anymore (protected = 3)
            );
        }
        
        //execute queries:
        $statement = $db->prepare(
            "UPDATE document_licenses set protected = :protection_state
            WHERE license_id = :license_id"
        );
        
        foreach($license_changes as $license_id => $protection_state) {
            echo 'Updating license with ID ' . $license_id . "...\n";
            $result = $statement->execute(
                array(
                    'protection_state' => $protection_state,
                    'license_id' => $license_id
                )
            );
            
            if($result === false) {
                //error while updating:
                echo 'ERROR while updating license-ID ' . $license_id . ' to protection state ' . $protection_state . "!\n";
            } else {
                echo 'Updated license-ID ' . $license_id . ' to protection state ' . $protection_state . "!\n";
            }
        }
        
        //close db connection:
        $db = null;
    }
}
