<table cellspacing="0" border="0" width="100%">
    <tr>
        <td align="center">
            <table cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td align="center">
                        <img src="<?php echo base_url(); ?>assets/img/brand/btg.png" alt="Your Company Logo" style="display: block; max-width: 100%;">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <p>Hi Reviewer</p>
                        <br>
                        <p>
                            The BAS for <?php echo $clientdetail['clientname']; ?> / <?php echo $entityname; ?> is ready for your review and sign-off.
                        </p>
                        <br>
                        <p>
                            Regards
                        </p>
                        <p>
                            BTG
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