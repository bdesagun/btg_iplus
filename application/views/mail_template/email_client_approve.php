<table cellspacing="0" border="0" width="100%" bgcolor="#ffffff">
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
                        <p>
                            I authorise BTG International Services Pty Ltd to submit this activity statement to the Commissioner of
                            Taxation for <?php echo $clientdetail['clientname']; ?> / <?php echo $entityname; ?>. I declare that I am authorised to make this declaration, and the
                            information provided to prepare this activity statement is true and correct.
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