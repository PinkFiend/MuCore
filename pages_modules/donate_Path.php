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
if (!isset($_GET['op2'])) {
    echo '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="15">
    <tr>
     <td align="center"><font size="4">Choose Your Path:<BR><font><BR><a href="index.php?page_id=donated"><img src="payments/daopay_logo.png" border="0" alt="Donate via DaoPay"></a></td>
    </tr>
     <tr>
     <td align="center">---------------------<BR><a href="index.php?page_id=donate"><img src="payments/paypal.png" border="0" alt="Donate via PayPal"></a></td>
    </tr>
     <tr>
     <td align="center">---------------------<BR><a href="index.php?page_id=donatewu"><img src="payments/1228429904_western_union.jpg" border="0" alt="Donate via Western Union"></a></td>
    </tr>
    </table>';
    
} else {
    switch ($_GET['op2']) {
        
        //DAOPAY PAYMENTS
        case 'DaoPay':
            require('daopay_config.php');
            echo '
            <div align="center" class="normal_text">
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="5" class="rankings-table">
            <thead>
    Make Sure You Are Logged In Before Donating From Daopay              <tr>
                   <td align="left">Pay Amount</td>
                   <td align="left">Credits</td>

                   <td align="left" width="100">Checkout</td>
                  </tr>
            </thead>
                  ';
            $payments = file('payments_list_daopay.txt');
            foreach ($payments as $daopay) {
                $daopay = explode("|", $daopay);
                echo '<tr>
                      <td align="left">' . $daopay[2] . '</td>
                      <td align="left">' . $daopay[1] . '</td>
                      <td align="left"><a href="http://daopay.com/payment/?appcode=' . $daopay_appcode . '&prodcode=' . $daopay[0] . '"><img src="payments/daopay_logo_little.png" border="0"></a></td>
                     </tr>';
            }
            echo '</table>
                  </div>';
            break;
        
        //PAYPAL PAYMENTS
        case 'DaoPay':
            
            break;
        
        //PAYPAL PAYMENTS
        case 'DaoPay':
            
            break;
    }
}
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
?> 