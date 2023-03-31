<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#ffffff">
    <tr>
        <td align="center">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td align="center" bgcolor="#ffffff" style="padding: 20px;">
                        <img src="<?php echo base_url(); ?>assets/img/brand/btg.png" alt="Your Company Logo" style="display: block; max-width: 100%;">
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 20px;">
                        <p style="font-size: 16px; margin: 0;">I confirm that:</p>
                        <p style="font-size: 16px; margin: 0;">
                            <ol>
                                <li>I am authorised to provide this information on behalf of <?php echo $clientdetail['clientname']; ?> - <?php echo $entityname; ?>.</li>
                                <li>All relevant data has been uploaded for the BAS period.</li>
                                <li>To the best of my knowledge, the data is complete and accurate.</li>
                            </ol>
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