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
                        <p>Hi <?php echo $clientdetail['clientname']; ?></p>
                        <br>
                        <p>
                            Good news. The <?php echo $month; ?> - <?php echo $year; ?> BAS for <?php echo $clientdetail['clientname']; ?> / <?php echo $entityname; ?> is ready for your approval. Once approved, we will lodge the BAS immediately.
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