<?
/**
* @+===========================================================================+
* @¦ MuCore 1.0.8 English.       					       ¦
* @¦ Credits: Isumeru & MaryJo  					       ¦
* @¦ +=======================================================================+ ¦
* @¦ ¦  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  ¦ ¦
* @¦ +=======================================================================+ ¦
* @¦ Official Site:   http://bizarre-networks.net                              ¦
* @+===========================================================================+
* @¦ Our Allied Site: http://chileplanet.org                                   ¦
* @+===========================================================================+
*/
require("../VoteLottery_Config.php");

$num = mssql_num_rows(mssql_query("Select * from VoteBag"));
if($num <= 0) { echo notice_message_admin("The Lottery Bag its already clean."); }
else
{$query = mssql_query("Delete from VoteBag");
if(!$query)
{
echo notice_message_admin("The Lottery Bag cant be cleaned.");
}
else
{
echo notice_message_admin("The Lottery Bag is now clean!");
}
}
?>