<?php
/**
 * Class:             smtp.class.inc
 * Require:
 * Optional:
 * Beschreibung:      A Class to send an E-Mail via SMTP and/or generate header
 * Erstellt:          21. März 2003, 18:49:36
 * Letzte Änderung:   29. März 2003, 01:38:00
 * Author:            Jointy <hempcluster@gmx.net>
 * Copyright:         @GPL Jointy
 * Version:           1.00 (final)
 *
 * /////////////////////////////////////////////////////////////////////////////
 * /////////////////////////////////////////////////////////////////////////////
 * SMTP Variablen
 *
 * $smtp_server         - Smtp Server Address
 * optional:
 * $smtp_user           - Smtp Login User
 * $smtp_pass           - Smtp User Login Password
 *
 * /////////////////////////////////////////////////////////////////////////////
 *
 *
 * /////////////////////////////////////////////////////////////////////////////
 * Funktion Variablen
 *
 * function make_header($from, $mailto, $subject, $priority="3", $cc="", $bcc="", $gen_message_id="Y")
 *
 * $from                - Sender Address (z.B. mustermann@web.de )
 * $mailto              - To: Address (z.B. String(",") or Array ( 0 => mustermann@gmx.net;
 *                                                                 1 => hello@gmx.net; )
 * $subject             - E-Mail SubjectLine (string)
 *
 * optional:
 * $priority            - E-Mail Priority (default = "3")
 * $cc && $bcc          - CC and BCC Address (howto $mailto)
 * $gen_message_id      - (Y) Message-Id is generatet by function, (N) Message-Id must generate by your self or by SMTP-Server
 *
 *
 *
 * function &smtp_send($from, $mailto, $header, $message="", $cc=null, $bcc=null)
 * $from                - Sender Address (z.B. mustermann@web.de )
 * $mailto              - To: Addressen (z.B. String(",") or Array ( 0 => mustermann@gmx.net;
 *                                                                   1 => hello@gmx.net; )
 * $header              - E-Mail Header generate by "make_header" or you make your own header
 * optional:
 * $message             - Message Text
 * $cc && $bcc          - howto $mailto
 *
 *
 * /////////////////////////////////////////////////////////////////////////////
 * /////////////////////////////////////////////////////////////////////////////
**/

if (!isset($_SMTP_CLASS_INC)){
    $_SMTP_CLASS_INC = 1;
    class SMTP {

        // SMTP-Server Vars !!! //
        var $smtp_server;
        var $smtp_user=null;
        var $smtp_pass=null;


        //Header Var !! //
        var $header="";

        // Socket Var !! //
        var $smtp_socket;

        // Fehler Var !! //
        var $error="E-Mail send.";

        function SMTP($smtp_server,$smtp_user="",$smtp_pass=""){
            if(!trim($smtp_server)){
              $this->smtp_server="";
            }
            $this->smtp_server= trim($smtp_server);
            if($smtp_user!="" && $smtp_pass!=""){
                $this->smtp_user= trim($smtp_user);
                $this->smtp_pass= trim($smtp_pass);
            }


        }
        
        function &smtp_put($string){
            return fputs($this->smtp_socket, $string . "\r\n");
        }

        /*
          The function make_header()
        
        */
        function &make_header($from, $mailto, $subject, $priority="3", $cc="", $bcc="", $gen_message_id="Y"){

            if (!preg_match( '/.+@.+/',$from)){
                return $this->error="Sender Address is incorrekt";
            }



            // Message-ID: The message ID consists of Date+Time.Random.SenderAddress !!!
            if($gen_message_id=="Y"){

                $this->header = "Message-Id: <". date('YmdHis').".". md5(microtime()).".". strtoupper($from) ."> \r\n";
            }

            //From: Address
            $this->header .="From: <" . $from . "> \r\n";


            // To: Address
            if(!is_array($mailto)){
                $mailto=explode(",",$mailto);
            }

            while(list(,$mailto_address) = each( $mailto )){

                if($mailto_address!=""){
                    $mailto_address=trim($mailto_address);
                    if(!preg_match( '/.+@.+/',$mailto_address)){
                        return $this->error = "This To: Address is incorrekt.  Error: ".$mailto_address;
                    }
                }
                unset($mailto_address);
            }
            $mailto=implode(",",$mailto);
            $this->header .="To: <".$mailto."> \r\n";

            // Subject:
            $this->header .="Subject: ".$subject." \r\n";


            //Date: Standard Mail Format (z.B Sat, 22 Mar 2003 22:57:05 +0100 ) !!
            $this->header .="Date: ". date('D, d M Y H:i:s O') ." \r\n";

            // Check isset CC and/or BCC and check is it in right RFC format
            if($cc!=""){
                if(!is_array($cc)){
                    $cc=explode(",",$cc);
                }

                while(list(,$cc_address) = each ( $cc )){
                    if($cc_address!=""){
                        $cc_address = trim($cc_address);
                        if(!preg_match( '/.+@.+/',$cc_address)){
                            return $this->error="This CC Address is in correkt. Error: ".$cc_address;
                        }
                    }
                unset($cc_address);
                }

                $cc=implode(",",$cc);
                $this->header .= "CC: ".$cc." \r\n";
            }

            if($bcc!=""){
                if(!is_array($bcc)){
                    $bcc=explode(",",$bcc);
                }
                
                while(list(,$bcc_address) = each ( $bcc )){
                    if($bcc_address!=""){
                        $bcc_address = trim($bcc_address);
                        if(!preg_match( '/.+@.+/',$bcc_address)){
                            return $this->error="This BCC Address is incorrekt. Error: ".$bcc_address;
                        }
                    }
                unset($bcc_address);
                }
                $bcc=implode(",",$bcc);
                $this->header .= "BCC: ".$bcc." \r\n";
            }
            


            // Set Priority  default="3"!!!
            if($priority!="3"){
                $this->header .= "X-Priority: ".$priority." \r\n";
                if($priority=="1" || $priority=="2"){
                    $this->header .= "X-MSMail-Priority: High \r\n";
                }
                if($priority=="4" || $priority=="5"){
                    $this->header .= "X-MSMail-Priority: Low \r\n";
                }
            }


            
            return $this->header;
            
        }

        function &server_parse( $response )
        {
            $server_response = "";
            while ( substr( $server_response, 3, 1 ) != ' ')
            if ( !( $server_response = fgets($this->smtp_socket)))
                return $this->error = "Couldn't read Server Response Code !!";
            if ( substr( $server_response, 0, 3 ) != $response )
                return $this->error = "Couldn't send E-Mail. Server Response: \" $server_response \" !!!";
            return "";
        }


        /*
          Funktion smtp_send()
        */
        function &smtp_send($from, $mailto, $header, $message="", $cc="", $bcc=""){

            if($this->smtp_server=="") return $this->error = "Without SMTP Server you can't send an e-mail ;) !! ";
            

            if($message!=""){
                $message = preg_replace( "/(?<!\r)\n/si", "\r\n",$message);
            }
            

            if(!$this->smtp_socket=fsockopen($this->smtp_server, 25, $errno, $errstr, 30))
                return $this->error="Couldn't connect to Smtp Server ($this->smtp_server) $errno : $errstr !!";

            if($this->server_parse("220")){
                return $this->error;
            }
            if(!$this->smtp_put("EHLO $this->smtp_server")){
                return $this->error="Couldn't send EHLO Command !! ";
            }
            if($this->server_parse("250")){
                return $this->error;
            }
            if(!empty($this->smtp_user) && !empty($this->smtp_pass)){

                if(!$this->smtp_put("AUTH LOGIN")){
                    return $this->error =" Couldn't send \"AUTH LOGIN \" Command !!";
                }
                if($this->server_parse("334")){
                    return $this->error;
                }
                if(!$this->smtp_put(base64_encode($this->smtp_user))){
                    return $this->error="Couldn't send LOGIN USER !!";
                }
                if($this->server_parse("334")){
                    return $this->error;
                }
                if(!$this->smtp_put(base64_encode($this->smtp_pass))){
                    return $this->error="Couldn't send USER PASSWORD  !!";
                }
                if($this->server_parse("235")){
                    return $this->error;
                }
            }
            if(!$this->smtp_put("MAIL FROM: ".$from)){
                return $this->error="Couldn't send \" MAIL FROM: $from \" !!";
            }
            if($this->server_parse("250")){
                return $this->error;
            }

            if(!is_array($mailto)){
                $mailto=explode(",",$mailto);
            }
            while(list(,$mailto_address) = each( $mailto )){
                if($mailto_address!=""){
                    if(!preg_match( '/.+@.+/',$mailto_address)){
                        return $this->error = "This To: Address is in correkt. Error: ".$mailto_address;
                    }
                    if(!$this->smtp_put("RCPT TO: $mailto_address")){
                        return $this->error = "Couldn't send \" RCPT TO: $mailto_address \" !!";
                    }
                    if($this->server_parse("250")){
                        return $this->error;
                    }
                }
                unset($mailto_address);
            }
            
            if($cc!=""){
                if(!is_array($cc)){
                    $cc=explode(",",$cc);
                }

                while(list(,$cc_address) = each ( $cc )){
                    if($cc_address!=""){
                        $cc_address=trim($cc_address);
                        if(!preg_match( '/.+@.+/',$cc_address)){
                            return $this->error="This CC Address is in correkt. Error: ".$cc_address;
                        }
                        if(!$this->smtp_put("RCPT TO: $cc_address")){
                            return $this->error = "Couldn't send \" RCPT TO: $cc_address \" !!";
                        }
                        if($this->server_parse("250")){
                            return $this->error;
                        }
                    }
                }
                unset($cc_address);
            }

            if($bcc!=""){
                if(!is_array($bcc)){
                    $bcc=explode(",",$bcc);
                }

                while(list(,$bcc_address) = each ( $bcc )){
                    if($bcc_address!=""){
                        $bcc_address=trim($bcc_address);
                        if(!preg_match( '/.+@.+/',$bcc_address)){
                            return $this->error="This BCC Address is in correkt. Error: ".$bcc_address;
                        }
                        if(!$this->smtp_put("RCPT TO: $bcc_address")){
                            return $this->error = "Couldn't send \" RCPT TO: $bcc_address \" !!";
                        }
                        if($this->server_parse("250")){
                            return $this->error;
                        }
                    }
                }
                unset($bcc_address);
            }

            if(!$this->smtp_put("DATA")){
                return $this->error="Couldn't send \" DATA \" Command !!";
            }
            if($this->server_parse("354")){
                return $this->error;
            }
            if(!$this->smtp_put("$header")){
                return $this->error="Couldn't send Header !!";
            }
            $this->smtp_put("\r\n");
            
            if(!$this->smtp_put("$message")){
                return $this->error="Couldn't send Mail !!";
            }
            $this->smtp_put(".");
            if($this->server_parse("250")){
                return $this->error;
            }
            $this->smtp_put("QUIT");
            fclose($this->smtp_socket);
            
            return $this->error;


        }
            


    }
}

            







?>