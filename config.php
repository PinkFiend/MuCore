<?
/*------------------------------------------*\
| Server Databases:                          |
|                                            |
|  0 : MuOnline [database]                   |
|  1 : MuOnline and Me_Muonline [databases]  |
\*------------------------------------------*/
/**
* @+===========================================================================+
* @� MuCore 1.0.8 English.       					       �
* @� Credits: Isumeru & MaryJo  					       �
* @� +=======================================================================+ �
* @� �  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  � �
* @� +=======================================================================+ �
* @� Official Site:   http://bizarre-networks.com                              �
* @+===========================================================================+
* @� Our Allied Site: http://chileplanet.org                                   �
* @+===========================================================================+
*/

$core['server_use_2_db'] = "0"; 

##############################################




/*-------------------------------------*\
| MUCore SQL Connection Type:           |
|                                       |
|  MSSQL : Connect using mssql_conect() |
|  ODBC : Connect using odbc            |
\*-------------------------------------*/

$core['connection_type'] = "ODBC";

#########################################




/*--------------------------------------------------*\
| MuOnline Database Connection Settings              |
|                                                    |
| $core['db_host'] : Database host address           |
| $core['db_name'] : Database name                   |
| $core['db_use'] : SQL Authentication user          |
| $core['db_password'] : SQL Authentication password |
\*--------------------------------------------------*/

$core['db_host'] = "127.0.0.1";
       
$core['db_name'] = "MuOnline";    
     
$core['db_user']= "sa";

$core['db_password'] = "SQL-Pass";

######################################################




/*------------------------------------------------------------------*\
| NOTE:                                                              |
| Edit this only if $core['server_use_2_db'] value is set to 1,      |
| this mean your server use MuOnline and Me_MuOnline databases.      |
|                                                                    |
| Me_MuOnline Database Connection Settings                           |
|                                                                    |
| $core['db_host2'] : Database host address                          |
| $core['db_name2'] : Database name                                  |
| $core['db_use2'] : SQL Authentication user                         |
| $core['db_password2'] : SQL Authentication password                |
\*------------------------------------------------------------------*/

$core['db_host2'] = "127.0.0.1";
       
$core['db_name2'] = "MuOnline";    
     
$core['db_user2']= "sa";

$core['db_password2'] = "SQL-Pass";

######################################################################




/*-------------------------------------------------*\
| MUCore Admin Control Panel:                       |
|                                                   |
|  $core['admin_username'] : Administrator user     |
|  $core['admin_password'] : Administrator password |
\*-------------------------------------------------*/

$core['admin_username'] = 'Admin';

$core['admin_password'] = 'test';

#####################################################




/*-----------------------------------------------------*\
| MUCore's MUCoins SQL Table Settings:                  |
|                                                       |
|  MU_COINS_TABLE : MUCoins table name                  |
|  MU_COINS_COLUMN : MUCoins (Credits) column name      |
|  MU_COINS_USERID_COLUMN : MUCoins User ID column name |
\*-----------------------------------------------------*/

define('MU_COINS_TABLE','memb_credits');

define('MU_COINS_COLUMN','credits');

define('MU_COINS_USERID_COLUMN','memb___id');

define('MU_SCOINS_TABLE','memb_scredits');

define('MU_SCOINS_COLUMN','scredits');

define('MU_SCOINS_USERID_COLUMN','memb___sid');

#########################################################




/*--------------------------------------*\
| MUCore Debug Settings:                 |
|                                        |
|  1 : Debug enabled                     |
|  0 : Debug disabled                    |
|                                        |
| Note: Enable debug only if necessary.  |
\*--------------------------------------*/

$core['debug'] = 0;

##########################################
/**
* @+===========================================================================+
* @� MuCore 1.0.8 English.       					       �
* @� Credits: Isumeru & MaryJo  					       �
* @� +=======================================================================+ �
* @� �  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  � �
* @� +=======================================================================+ �
* @� Official Site:   http://bizarre-networks.com                              �
* @+===========================================================================+
* @� Our Allied Site: http://chileplanet.org                                   �
* @+===========================================================================+
*/
?>
