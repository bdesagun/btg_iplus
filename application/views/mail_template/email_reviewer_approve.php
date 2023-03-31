<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#ffffff">
    <tr>
        <td align="center">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td align="center" bgcolor="#ffffff" style="padding: 20px;">
                        <img src="https://yourcompanylogo.com/logo.png" alt="Your Company Logo" style="display: block; max-width: 100%;">
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 20px;">
                        <p style="font-size: 16px; margin: 0;">Hi <?php echo $clientdetail['clientname']; ?></p>
                        <br>
                        <p style="font-size: 16px; margin: 0;">
                            Good news. The <?php echo $month; ?> - <?php echo $year; ?> BAS for <?php echo $clientdetail['clientname']; ?> / <?php echo $entityname; ?> is ready for your approval. Once approved, we will lodge the BAS immediately.
                        </p>
                        <br>
                        <p style="font-size: 16px; margin: 0;">
                            Regards
                        </p>
                        <p style="font-size: 16px; margin: 0;">
                            BTG
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 20px;">
                        <p style="font-size: 16px; margin: 0;"><?php echo $_SESSION["accountname"].' - '.date('m/d/Y h:i:s', time()); ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>