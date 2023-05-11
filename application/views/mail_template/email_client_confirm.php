<table cellspacing="0" border="0" width="100%">
    <tr>
        <td align="center">
            <table cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td align="center">
                        <img src="<?php echo base_url(); ?>assets/img/brand/btg.png" alt="Company Logo" width="150">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <p>I confirm that:</p>
                        <p>
                            <p>1. I am authorised to provide this information on behalf of <?php echo $clientdetail['clientname']; ?> - <?php echo $entityname; ?>.</p>
                            <p>2. All relevant data has been uploaded for the BAS period.</p>
                            <p>3. To the best of my knowledge, the data is complete and accurate.</p>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <p><?php echo $_SESSION["accountname"].' - '.date('m/d/Y h:i:s', time()); ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>